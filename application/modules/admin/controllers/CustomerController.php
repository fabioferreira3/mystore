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
    }
    
}

?>