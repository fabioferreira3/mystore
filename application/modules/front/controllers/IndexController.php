<?php 


class Front_IndexController extends Zend_Controller_Action
{
	
	protected $cart;
	protected $paginator;
	protected $em;
	
	public function init(){
		
		$this->em = $this->_helper->EM->em();
        $this->repo = $this->_helper->EM; 
        
        $this->paginator = $this->_helper->Paginator; 
       
		$this->cart = new Zend_Session_Namespace('shopping_cart');
		
	}
	
	public function indexAction(){
		
		
		
	}
	
	
	
	
	
	
}

?>