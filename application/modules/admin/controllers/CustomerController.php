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
        
        if ($this->_helper->FlashMessenger->hasMessages('success')) {
        	$this->view->msgSuccess = $this->_helper->FlashMessenger->getMessages('success');
        }
        if ($this->_helper->FlashMessenger->hasMessages('error')) {
        	$this->view->msgError = $this->_helper->FlashMessenger->getMessages('error');
        }
    }
    
    public function indexAction(){
        try{
         $tbClient = new DB_Client();         
         $this->view->clients = $tbClient->getDataAddress();
        }
        catch(Exception $e){echo $e->getMessage();exit;}
    }
    
    public function addAction(){

    	$countries = $this->repo->db('Country')->findAll();    	
    	$this->view->countries = $countries;    	
    	
    	try{
    		if ($this->getRequest()->isPost()){
    			$postvars = $this->getRequest()->getPost();
                
    			$tbClient = new DB_Client();
    	     	    			
    			$checkEmail = $this->repo->db('Client')->findOneByEmail($postvars['email']);
    			
    			// Se cliente for pessoa física (CPF)
    			if (isset($postvars['cpf']) && $postvars['cpf'] != ''){
    				$cpf = str_replace(array('.','-'),'',$postvars['cpf']);
    				$checkCpf = $this->repo->db('Client')->findOneByCpf($cpf);
    			}
                
                // Se cliente for pessoa jurídica (CNPJ)
                if (isset($postvars['cnpj']) && $postvars['cnpj'] != ''){
                    $cnpj = str_replace(array('.','-','/'),'',$postvars['cnpj']);
                    $checkCnpj = $this->repo->db('Client')->findOneByCnpj($cnpj);
                }    			
    			
    			if ($checkEmail == NULL && $checkCpf == NULL){
    				
    				$tbClient->setFirstName($postvars['name']);
    				$tbClient->setLastName($postvars['lastname']);
    				$tbClient->setEmail($postvars['email']);
    				
    				$birth = new DateTime(str_replace('/', '-',$postvars['birth']));
    				$dtNow = new DateTime();
    				
    				$tbClient->setDateBirth($birth);
    				$tbClient->setClientType('1');
    				$tbClient->setGender($postvars['gender']);
                    if($cpf){
                        $tbClient->setCpf($cpf);
                    }
    				if($cnpj){
                        $tbClient->setCnpj($cpf);
                    }
    				$tbClient->setPassword(hash('sha256',$postvars['password']));
    				$tbClient->setKeyConfirm(md5(rand(5,15)));
    				$tbClient->setDateCreate($dtNow);
    				$tbClient->setDateUpd($dtNow);    				
    				$tbClient->setStatus('0');
    				
    				$currentStore = $this->repo->db('Store')->findOneById('1');
    				$tbClient->setStore($currentStore);
                    $this->em->persist($tbClient); // Track da tabela
					
    				// Endereço de Cobrança
    				if(isset($postvars['billing-address']) && $postvars['billing-address'] != ''){
    					$tbAddress = new DB_Address();
    					$tbAddress->setClient($tbClient);
    					$billingAddress = $this->repo->db('AddressType')->findOneByName('Cobrança');
    					$tbAddress->setAddressType($billingAddress);
    					$tbAddress->setStreet($postvars['billing-address']);
    					$tbAddress->setNumber($postvars['billing-number']);
    					if(isset($postvars['billing-complement']) && $postvars['billing-complement'] != ''){
    						$tbAddress->setComplement($postvars['billing-complement']);
    					}
    					$tbAddress->setZip($postvars['billing-zip']);
    					$billingCountry = $this->repo->db('Country')->find($postvars['billing-country']);
    					$tbAddress->setCountry($billingCountry);
    					$tbAddress->setState($postvars['billing-state']);
    					$tbAddress->setCity($postvars['billing-city']);
    					$tbAddress->setDateCreate($dtNow);
                        $tbAddress->setDateUpd($dtNow);
                        $this->em->persist($tbAddress); // Track da tabela
    				}
    				
    				// Endereço de Entrega
    				if(isset($postvars['shipping-address']) && $postvars['shipping-address'] != ''){
    					$tbShippingAddress = new DB_Address();
    					$tbShippingAddress->setClient($tbClient);
    					$shippingAddress = $this->repo->db('AddressType')->findOneByName('Entrega');
    					$tbShippingAddress->setAddressType($shippingAddress);
    					$tbShippingAddress->setStreet($postvars['shipping-address']);
    					$tbShippingAddress->setNumber($postvars['shipping-number']);
    					if(isset($postvars['shipping-complement']) && $postvars['shipping-complement'] != ''){
    						$tbShippingAddress->setComplement($postvars['shipping-complement']);
    					}
    					$tbShippingAddress->setZip($postvars['shipping-zip']);
    					$shippingCountry = $this->repo->db('Country')->find($postvars['shipping-country']);
    					$tbShippingAddress->setCountry($shippingCountry);
    					$tbShippingAddress->setState($postvars['shipping-state']);
    					$tbShippingAddress->setCity($postvars['shipping-city']);
    					$tbShippingAddress->setDateCreate($dtNow);
                        $tbShippingAddress->setDateUpd($dtNow);
                        $this->em->persist($tbShippingAddress); // Track da tabela
    				}
    				
    				// Insere no banco
                    $this->em->flush();  	                   
                    $this->_helper->flashMessenger->addMessage('Usuário Adicionado com Sucesso!','success');
                    $this->getHelper('Redirector')->gotoUrl('/admin/customer/add');
                	
    			}else{
    				$this->_helper->flashMessenger->addMessage('Já existe um usuário com este Email e/ou CPF/CNPJ','error');
    				$this->getHelper('Redirector')->gotoUrl('/admin/customer/add');
    			}   			
    		}	
    	}
    	catch(Exception $e){    	    
    	    $this->_helper->flashMessenger->addMessage('Erro ao adicionar usuário!','error');
            $this->_helper->flashMessenger->addMessage($e->getMessage(),'error');
            $this->getHelper('Redirector')->gotoUrl('/admin/customer/add');
        } 
    }

    public function enableAction(){
        
        $params = $this->getRequest()->getParams();
        $clientId = $params['id'];
        $tbClient = $this->repo->db('Client')->find($clientId);
        $tbClient->setStatus(1);
        $this->em->flush();
        $this->_helper->flashMessenger->addMessage('Usuário Ativado','success');
        $this->getHelper('Redirector')->gotoUrl('/admin/customer/');
    }

    public function disableAction(){
        
        $params = $this->getRequest()->getParams();
        $clientId = $params['id'];
        $tbClient = $this->repo->db('Client')->find($clientId);
        $tbClient->setStatus(0);
        $this->em->flush();
        $this->_helper->flashMessenger->addMessage('Usuário Desativado','success');
        $this->getHelper('Redirector')->gotoUrl('/admin/customer/');
    }
    
    public function editAction(){
        $params = $this->getRequest()->getParams();
        $clientId = $params['value'];        
        $tbClient = new DB_Client();        
        $this->view->entity = $tbClient->getDataAddress($clientId);
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