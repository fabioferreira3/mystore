<?php 

class Admin_CustomerController extends Zend_Controller_Action
{
    private $layout;
    private $em;
    private $repo;
    
    public function init(){
    	
    	$auth = Zend_Auth::getInstance();
    		
    	if (!$auth->hasIdentity()) {
    	
    		$this->getHelper('Redirector')->gotoUrl('/admin238/index/login');
    			
    	}else{
        
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
    }
    
    public function indexAction(){
        try{   

        	$params = $this->getRequest()->getParams();
        	if(isset($params['page'])){$curPage = $params['page'];}
        	else{$curPage = 1;}
        	
        	$tbClient = new DB_Client();            
            $maxItemsPerPage = 20;
            $clients = $tbClient->getClient($maxItemsPerPage,$curPage);
            $totalItems = $clients->getTotalItemCount();
            $maxPages = ceil($totalItems / $maxItemsPerPage);
            $this->view->pagination = $this->_helper->Paginator->generate($curPage,$maxPages,$totalItems);
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
                if(isset($postvars['billingstate']) || isset($postvars['shippingstate'])){
                    $goAddress = true;
                }else{
                    $goAddress = false;
                }
                
                $tbClient->addOrUpdate($postvars,false,true);
                $this->getHelper('Redirector')->gotoUrl('/admin238/customer/add');
                exit;    			   			
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
                $tbClient = new DB_Client();
                $tbClient->addOrUpdate($postvars,$clientId,true);
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
    
    public function filterAction(){
    	
    	try{
    		$params = $this->getRequest()->getParams();
    		$tbClient = new DB_Client();
    
    		$results = $tbClient->getClientsByFilter($params);
    		$conditions = array();
    		if(isset($params['actions'])){
    			$conditions['actions'] = false;
    		}
    		if(isset($params['dates'])){
    			$conditions['dates'] = false;
    		}
    		if(isset($params['selectType'])){
    			$conditions['selectType'] = $params['selectType'];
    		}
    	
    //	    Zend_Debug::dump($conditions);exit;
    		
    		if($results != null){
    			$data = array();    			
    			$data['maker'] = $tbClient->generateTable($results,$conditions);
    			$data['pagination'] = $this->_helper->Paginator->generate(false,false,$results->getTotalItemCount());
    			echo json_encode($data);
    		}else{
    			$maker = $this->_helper->ClientTableMaker->create(false,true,false);
    			echo json_encode($maker);
    		}
    		exit;
    	}
    	catch(Exception $e){echo json_encode($e->getMessage());exit;}
    }
    
    public function getAddressesAction(){
    	try{
	    	$params = $this->getRequest()->getParams();
	    	$tbAddress = new DB_Address();    	
    		echo json_encode($tbAddress->getAddressesByClient($params['clientid']));
    		exit;
    	}
    	catch(Exception $e){echo json_encode($e->getMessage());exit;}
    }
    
    
    
}

?>