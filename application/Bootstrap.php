<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
        protected function _initDoctrine()
        {
                $options = $this->getOptions();

                $doctrinePath = $options['includePaths']['library'];
                
                require_once $doctrinePath . '/Doctrine/Common/ClassLoader.php';
                $autoloader = Zend_Loader_Autoloader::getInstance();

                $doctrineAutoloader = array(new \Doctrine\Common\ClassLoader(), 'loadClass');
                $autoloader->pushAutoloader($doctrineAutoloader, 'Doctrine');

                $classLoader = new \Doctrine\Common\ClassLoader('Entities', realpath(__DIR__ . '/models/'), 'loadClass');
                $autoloader->pushAutoloader(array($classLoader, 'loadClass'), 'Entities');
                $classLoader = new \Doctrine\Common\ClassLoader('Symfony', realpath(__DIR__ . '/../library/Doctrine/'), 'loadClass');
                $autoloader->pushAutoloader(array($classLoader, 'loadClass'), 'Symfony');

                if (APPLICATION_ENV == "development") {
                        $cache = new \Doctrine\Common\Cache\ArrayCache();
                } else {
                        $cacheOptions = $options['cache']['backendOptions'];
                        $cache = new \Doctrine\Common\Cache\MemcacheCache();
                        $memcache = new Memcache;
                        $memcache->connect($cacheOptions['servers']['host'], $cacheOptions['servers']['port']);
                        $cache->setMemcache($memcache);
                }

                $config = new \Doctrine\ORM\Configuration();
                $config->setMetadataCacheImpl($cache);
                $driverImpl = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/models/Entities');
                $config->setMetadataDriverImpl($driverImpl);
                $config->setQueryCacheImpl($cache);
                $config->setProxyDir(APPLICATION_PATH . '/models/Proxies');
                $config->setProxyNamespace('Proxies');


                if (APPLICATION_ENV == "development") {
                        $config->setAutoGenerateProxyClasses(true);
                } else {
                        $config->setAutoGenerateProxyClasses(false);
                }

                $em = \Doctrine\ORM\EntityManager::create($options['db'], $config);

/*echo "<pre>";
var_dump($em);
die();*/

                Zend_Registry::set('em', $em);

                return $em;
        }
}

