<?php 

class Admin_IndexController extends Zend_Controller_Action
{
	protected $layout;
	
	public function init(){
		$this->layout = Zend_Layout::getMvcInstance();
		$this->layout->setLayout('adminLayout');
	}
	
	public function indexAction(){
		
	}
	
}

?>