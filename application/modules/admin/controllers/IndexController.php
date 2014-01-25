<?php 

class Admin_IndexController extends Zend_Controller_Action
{
	protected $layout;
	private $em;
	private $repo;
	
	public function init(){
		
		$this->layout = Zend_Layout::getMvcInstance();
		$this->layout->setLayout('adminLayout');
		$this->em = $this->_helper->EM->em();
		$this->repo = $this->_helper->EM;
		
		if ($this->_helper->FlashMessenger->hasMessages('success')) {
			$this->view->msgSuccess = $this->_helper->FlashMessenger->getMessages('success');
		}
		if ($this->_helper->FlashMessenger->hasMessages('error')) {
			$this->view->msgError = $this->_helper->FlashMessenger->getMessages('error');
		}
		
	}
	
	public function indexAction(){
		
		try{
			
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function testeAction(){
		try{
			$email = new Application_Model_Email();
			$email->sendOrderConfirmation(21);
			
				
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	
	
}

?>