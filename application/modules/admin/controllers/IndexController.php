<?php 

class Admin_IndexController extends Zend_Controller_Action
{
	protected $layout;
	
	public function init(){
		$this->layout = Zend_Layout::getMvcInstance();
		$this->layout->setLayout('adminLayout');
		
	}
	
	public function indexAction(){
		
		try{
			$email = new Application_Model_Email();
			$msg = '';
			$from = false;
			$to = 'fabio.ferreira3@outlook.com';
			$subject = 'teste do caraio';
			$email->emailSend($msg,$to,$from,$subject);
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	
	
}

?>