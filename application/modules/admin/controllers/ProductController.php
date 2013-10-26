<?php 

class Admin_ProductController extends Zend_Controller_Action
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
	
		$this->view->productPage = true;
	}
	
	public function indexAction(){
		
	}
	
	public function addAction(){
		$contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/add-content/';
		$this->view->content = new Zend_View();
		$this->view->content->setScriptPath($contentPath);
		
	}
	
	public function editAction(){
		
	}
	
	
}

?>