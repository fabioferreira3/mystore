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
    			$tbAddress = new DB_Client();
    			
    			$tbClient->setFirstName($postvars['name']);
    			$tbClient->setLastName($postvars['lastname']);
    			
    		}	
    	}
    	catch(Exception $e){echo $e->getMessage();} 
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