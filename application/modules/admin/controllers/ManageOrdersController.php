<?php 

class Admin_ManageOrdersController extends Zend_Controller_Action
{
	private $layout;
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
		
		$this->view->manageOrdersPage = true;
	}
	
	public function indexAction(){
		
		$this->view->status = $this->repo->db('OrderStatus')->findAll();
		$tbOrders = new DB_Orders();
		
		//Zend_Debug::dump($tbOrders->getOrders());exit;
		
		$this->view->orders = $tbOrders->getOrders();
		
	}
}