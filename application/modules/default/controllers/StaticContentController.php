<?php
class StaticContentController extends Zend_Controller_Action
{
    public function init()
    {
    }

    // display static views
    public function displayAction()
    {
      $page = $this->getRequest()->getParam('page');

	  if (file_exists($this->view->getScriptPath(null) . "/" . $this->getRequest()->getControllerName() . "/$page." . $this->viewSuffix))
	  {
        $this->render($page);
      } else {
        throw new Zend_Controller_Action_Exception('Page not found', 404);
      }
    }    
}

