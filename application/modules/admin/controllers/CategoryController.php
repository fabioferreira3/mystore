<?php 

class Admin_CategoryController extends Zend_Controller_Action
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
		
		$this->view->categoryPage = true;
	}
	
	public function indexAction(){
		$tbCategory = new DB_Category();
        $categories = $tbCategory->getAllDependencies();
        
        $this->view->categories = $categories;
		
	}
	
	public function addAction(){
		
		$tbCategory = new DB_Category();
		$categories = $tbCategory->getAllDependencies();
		$this->view->categories = $categories;
				
		$stores = $this->repo->db('Store')->findAll();
		$this->view->stores = $stores;
		try{
		if ($this->getRequest()->isPost()){
			$postvars = $this->getRequest()->getPost();
			$checkCategory = $this->repo->db('Category')->findOneByName($postvars['name']);
			
			// Verifica se já existe uma categoria com o mesmo nome e mesma categoria pai
			if($checkCategory != NULL){
			    if ($checkCategory->getParent() == $postvars['parent']){
				    $allowCategory = false;
			    }else{
				    $allowCategory = true;
			    }
            }else{
                $allowCategory = true;
            }			
			if ($allowCategory == true){
				$tbCategory = new DB_Category();
				$tbCategory->setName($postvars['name']);
				$tbCategory->setSlug($postvars['slug']);
				if (isset($postvars['parent']) && $postvars['parent'] != ''){
					$tbCategory->setParent($postvars['parent']);
				}
				$store = $this->repo->db('Store')->find(1);
				$tbCategory->setStore($store);			
				$dtNow = new DateTime();
				$tbCategory->setDateCreate($dtNow);
				$tbCategory->setDateUpd($dtNow);
				$this->em->persist($tbCategory);
				$this->em->flush();
				$this->_helper->flashMessenger->addMessage('Categoria criada com sucesso!','success');
				$this->getHelper('Redirector')->gotoUrl('/admin238/category');
			}else{
				$this->_helper->flashMessenger->addMessage('Já existe uma categoria com este nome e vinculada a esta categora pai!','error');
				$this->getHelper('Redirector')->gotoUrl('/admin238/category/add');
			}
		}
		}
		catch(Exception $e){
			$this->_helper->flashMessenger->addMessage('Erro ao criar categoria!','error');
			$this->_helper->flashMessenger->addMessage($e->getMessage(),'error');
			$this->getHelper('Redirector')->gotoUrl('/admin238/category/add');
		}
	}
	
	public function editAction(){
		
		$params = $this->getRequest()->getParams();	
		$category = $this->repo->db('Category')->find($params['value']);
		$tbCategory = new DB_Category();
		$categories = $tbCategory->getAllDependencies();
		
		$this->view->category = $category;
		$this->view->categories = $categories;
		
		$stores = $this->repo->db('Store')->findAll();
		$this->view->stores = $stores;
		
	}
}