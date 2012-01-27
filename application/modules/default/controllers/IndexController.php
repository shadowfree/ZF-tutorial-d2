<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

		// Doctrine 
		$user = new \Entities\User();
		$user->name = 'test';
		$user->login = 'test';
		$user->password = md5('123456');

		$em = $this->_helper->Em();
		$em->persist($user);
		$em->flush();
    }


}

