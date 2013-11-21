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
         $clients = $tbClient->getClient();
      //   Zend_Debug::dump($clients);exit;
         $this->view->clients = $clients;
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
                    $this->getHelper('Redirector')->gotoUrl('/admin238/customer/add');
                	
    			}else{
    				$this->_helper->flashMessenger->addMessage('Já existe um usuário com este Email e/ou CPF/CNPJ','error');
    				$this->getHelper('Redirector')->gotoUrl('/admin238/customer/add');
    			}   			
    		}	
    	}
    	catch(Exception $e){    	    
    	    $this->_helper->flashMessenger->addMessage('Erro ao adicionar usuário!','error');
            $this->_helper->flashMessenger->addMessage($e->getMessage(),'error');
            $this->getHelper('Redirector')->gotoUrl('/admin238/customer/add');
        } 
    }

    public function enableAction(){
        
        $params = $this->getRequest()->getParams();
        $clientId = $params['value'];
        $tbClient = $this->repo->db('Client')->find($clientId);
        $tbClient->setStatus(1);
        $this->em->flush();
        $this->_helper->flashMessenger->addMessage('Usuário Ativado','success');
        $this->getHelper('Redirector')->gotoUrl('/admin238/customer/');
    }

    public function disableAction(){
        
        $params = $this->getRequest()->getParams();
        $clientId = $params['value'];
        $tbClient = $this->repo->db('Client')->find($clientId);
        $tbClient->setStatus(0);
        $this->em->flush();
        $this->_helper->flashMessenger->addMessage('Usuário Desativado','success');
        $this->getHelper('Redirector')->gotoUrl('/admin238/customer/');
    }
    
    public function editAction(){
        
        $params = $this->getRequest()->getParams();
        $clientId = $params['value'];
        $tbClient = new DB_Client();
        $client = $this->repo->db('Client')->find($clientId);
        $this->view->entity = $client;    
        foreach($client->getAddress() as $address){            
            if($address->getAddressType()->getId() == 2){
                $shippingAddress = $address;
            }else if($address->getAddressType()->getId() == 3){
                $billingAddress = $address;
            }
        }
        if(isset($shippingAddress) && $shippingAddress){
            $this->view->shipping = $shippingAddress;
        }
        if(isset($billingAddress) && $billingAddress){
            $this->view->billing = $billingAddress;
        }
      
        $countries = $this->repo->db('Country')->findAll();
        $this->view->countries = $countries;
        try{
        if ($this->getRequest()->isPost()){
        	$postvars = $this->getRequest()->getPost();
        	$clientEntity = $this->repo->db('Client')->find($clientId);
        	$clientEntity->setFirstName($postvars['name']);
        	$clientEntity->setLastName($postvars['lastname']);
        	$clientEntity->setCpf($postvars['cpf']);
        	$birth = new DateTime(str_replace('/', '-',$postvars['birth']));
        	$clientEntity->setDateBirth($birth);
        	$clientEntity->setGender($postvars['gender']);
        	$clientEntity->setEmail($postvars['email']);
        	if($postvars['password'] != ''){
        		$clientEntity->setPassword(hash('sha256',$postvars['password']));
        	}        	
        	$billingAddress = $tbClient(checkAddressTypeExist(3));
        	
        	if($billingAddress != false){
        		$billingAddress->setStreet($postvars['billing-address']);
        		$billingAddress->setNumber($postvars['billing-number']);
        		$billingAddress->setComplement($postvars['billing-complement']);
        		$billingCountry = $this->repo->db('Country')->find($postvars['billing-country']);
        		$billingAddress->setCountry($billingCountry);
        		$billingState = $this->repo->db('State')->find($postvars['billing-state']);
        		$billingAddress->setState($billingState);
        		$billingAddress->setCity($postvars['billing-city']);
        		$this->em->persist($billingAddress);
        	}
        	        	
        	$shippingAddress = $tbClient->getDataAddress($clientId,2);
        	
        	if($shippingAddress != null){
        		$shippingAddress->setStreet($postvars['shipping-address']);
        		$shippingAddress->setNumber($postvars['shipping-number']);
        		$shippingAddress->setComplement($postvars['shipping-complement']);
        		$shippingCountry = $this->repo->db('Country')->find($postvars['shipping-country']);
        		$shippingAddress->setCountry($billingCountry);
        		$shippingState = $this->repo->db('State')->find($postvars['shipping-state']);
        		$shippingAddress->setState($shippingState);
        		$shippingAddress->setCity($postvars['shipping-city']);
        		$this->em->persist($shippingAddress);
        	}else{
        		if(isset($postvars['shipping-address']) && $postvars['shipping-address'] != ''){
        			$shippingAddress = new DB_Address();
        			$shippingAddress->setStreet($postvars['shipping-address']);
        			$shippingAddress->setNumber($postvars['shipping-number']);
        			$shippingAddress->setComplement($postvars['shipping-complement']);
        			$shippingAddress->setZip($postvars['shipping-zip']);
        			$shippingCountry = $this->repo->db('Country')->find($postvars['shipping-country']);
        			$shippingAddress->setCountry($shippingCountry);
        			$shippingState = $this->repo->db('State')->find($postvars['shipping-state']);
        			$shippingAddress->setState($shippingState);
        			$shippingAddress->setCity($postvars['shipping-city']);
        			$addressType = $this->repo->db('AddressType')->find(2);
        			$shippingAddress->setAddressType($addressType);
        			$shippingAddress->setClient($clientEntity);
        			$dtNow = new DateTime();
        			$shippingAddress->setDateCreate($dtNow);
        			
        			$this->em->persist($shippingAddress);
        		}
        	}
        	        	
        	$this->em->persist($clientEntity);        	
        	
        	$this->em->flush();
        	
        	$this->getHelper('Redirector')->gotoUrl('/admin238/customer/edit/id/' . $clientId);
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