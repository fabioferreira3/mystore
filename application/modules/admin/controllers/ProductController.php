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
		try{
	//	$tbProduct = new DB_Product;		
	//	$this->em->persist($tbProduct);
	//	$this->em->flush();	
		$product = $this->repo->db('Product')->find('9');
		$session = new Zend_Session_Namespace('product');
		$session->productId = '8';
		$this->view->productId = $session->productId;
		
		}
		catch(Exception $e){echo $e->getMessage();}
		
		
		
		
		$contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/add-content/';
		$this->view->content = new Zend_View();
		$this->view->content->setScriptPath($contentPath);        
        $this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
		
		if($this->getRequest()->isPost()){
			Zend_Debug::dump($this->getRequest()->getPost());
		}		
	}
	
	public function addImageAction(){		
		
		$postvars = $this->getRequest()->getParams();
		if($postvars['name'] != ''){
			$image = $this->repo->db('ProductImages')->findByName($postvars['name']);
			if ($image != null){
				echo json_encode(false);
				exit;
			}else{
				$productImage = new DB_ProductImages();
				$product = $this->repo->db('Product')->find($postvars['productid']);
				$productImage->setProduct($product);
				$productImage->setName($postvars['name']);
				$store = $this->repo->db('Store')->find('1');
				$productImage->setStore($store);
				$this->em->persist($productImage);
				$this->em->flush();
				echo json_encode(true);
				exit;
			}
		}
		
			
		
	}
	
	public function editAction(){
		
	}
	
	
}

?>