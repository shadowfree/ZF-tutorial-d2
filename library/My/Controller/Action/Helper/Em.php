<?php
class My_Controller_Action_Helper_Em extends Zend_Controller_Action_Helper_Abstract
{

	/**
	* Entity manager
	* @var \Doctrine\ORM\EntityManager
	*/
	private $_em = null;

	/**
	* Return entity manager
	* Could be overriden to support custom entity manager
	*
	* @return \Doctrine\ORM\EntityManager
	*/
	public function getEntityManager() 
	{
		if ( $this->_em == null) {
			$this->_em = Zend_Registry::get('em');
		}

		return $this->_em;
	}

	/**
	* @return \Doctrine\ORM\EntityManager
	*/
	public function direct() 
	{
		return $this->getEntityManager();
	}
}