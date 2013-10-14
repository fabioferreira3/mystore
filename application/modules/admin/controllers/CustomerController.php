<?php 

class Admin_CustomerController extends Zend_Controller_Action
{
    private $layout;
    private $em;
    private $repo;
    
    public function init(){
        $this->layout = Zend_Layout::getMvcInstance();
        $this->layout->setLayout('adminLayout');
        $this->em = $this->_helper->EM->em();
        $this->repo = $this->_helper->EM;
    }
    
    public function indexAction(){
         
    }
    
    public function addAction(){

    	$countries = $this->repo->db('Country')->findAll();
    	$users = $this->repo->db('Client')->findAll();
    	$this->view->countries = $countries;
    	$this->view->users = $users;
    	
    	try{
    		if ($this->getRequest()->isPost()){
    			$postvars = $this->getRequest()->getPost();
    			$tbClient = new DB_Client();
    	     	$tbAddress = new DB_Address();
    			
    			$checkEmail = $this->repo->db('Client')->findOneByEmail($postvars['email']);
    			$checkCpf = $this->repo->db('Client')->findOneByCpf($postvars['cpf']);
    			
    			if ($checkEmail == NULL && $checkCpf == NULL){
    				
    				$tbClient->setFirstName($postvars['name']);
    				$tbClient->setLastName($postvars['lastname']);
    				$tbClient->setEmail($postvars['email']);
    				
    				$birth = new DateTime(str_replace('/', '-',$postvars['birth']));
    				$dtNow = new DateTime();
    				$cpf = str_replace(array('.','-'),'',$postvars['vat']);
    				
    				$tbClient->setDateBirth($birth);
    				$tbClient->setClientType('1');
    				$tbClient->setGender($postvars['gender']);
    				$tbClient->setCpf($cpf);
    				$tbClient->setCnpj('07913647000153');
    				$tbClient->setPassword(hash('sha256',$postvars['password']));
    				$tbClient->setKeyConfirm(md5(rand(5,15)));
    				$tbClient->setDateCreate($dtNow);
    				$tbClient->setDateUpd($dtNow);
    				$tbClient->setLastLogin($dtNow);
    				$tbClient->setStatus('0');
    				
    				$currentStore = $this->repo->db('Store')->findOneById('1');
    				$tbClient->setStore($currentStore);    		 
    				$this->em->persist($tbClient);
    				$this->em->flush();
    			}else{
    				$this->_helper->flashMessenger->addMessage('Já existe um usuário com este email e/ou CPF/CNPJ');
    				$this->getHelper('Redirector')->gotoUrl('/admin/customer/add');
    			}   			
    		}	
    	}
    	catch(Exception $e){echo $e->getMessage();exit;} 
    }
    
    public function callStatesAction(){
    	$params = $this->getRequest()->getParams();
    	$countryId = $params['country'];
   	try{
    	$states = $this->repo->db('State')->findByCountry($countryId);
    	foreach ($states as $state){
    		echo '<option value=' . $state->getId() . '>' . $state->getName() . '</option>';
    	}
    	exit;    	
   	}
    catch(Exception $e){echo $e->getMessage();}
    }
    
    
    
}

?>