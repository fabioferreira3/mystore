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
		
		$auth = Zend_Auth::getInstance();
		
		if($auth->hasIdentity()){
			$storage = $auth->getStorage()->read();
			$this->view->username = $storage->username;
			$this->view->lastLogin = $storage->last_login;
		}
		
	}
	
	public function indexAction(){
		
		try{
			$auth = Zend_Auth::getInstance();
			
			if (!$auth->hasIdentity()) {
									
				$this->getHelper('Redirector')->gotoUrl('/admin238/index/login');
			}
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function testeAction(){
		
		try{
			$order = $this->repo->db('Orders')->find(21);
		//	Zend_Debug::dump($order->getProducts());
		//	exit;
			$email = new Application_Model_Email();
			$email->sendOrderConfirmation($order);
			
				
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function loginAction(){
		
		$this->layout->setLayout('adminBlank');
		
		try{
			if($this->getRequest()->isPost()){				
			    
				$params = $this->getRequest()->getPost();
				$password = hash('sha256',$params['password']);
				
				$db = Zend_Db_Table::getDefaultAdapter();
				$authAdapter = new Zend_Auth_Adapter_DbTable($db);
				 
				$authAdapter->setTableName('admin');
				$authAdapter->setIdentityColumn('username');
				$authAdapter->setCredentialColumn('password');
				$authAdapter->setCredentialTreatment('status = 1');
				$authAdapter->setIdentity($params['username']);
				$authAdapter->setCredential($password);
				
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				
				if ($result->isValid()) {
				
					$storage = $auth->getStorage();
						
					$info = $authAdapter->getResultRowObject(array(
							'id',
							'username',
							'last_login'
					));			
						
					$storage->write($info);
				
					$this->getHelper('Redirector')->gotoUrl('/admin238/');
						
				}else{
					$this->_helper->flashMessenger->addMessage('Acesso Negado','error');
					$this->getHelper('Redirector')->gotoUrl('/admin238/index/login');
				}
			}
		}
		catch(Exception $e){echo $e->getMessage();exit;}
		
	}
	
	public function logoutAction(){
		
		$session = new Zend_Auth_Storage_Session();
		$session->clear();
		Zend_Registry::_unsetInstance();
		$this->getHelper('Redirector')->gotoUrl('/admin238/index/login');
		exit;
		
	}
	
	
	
}

?>