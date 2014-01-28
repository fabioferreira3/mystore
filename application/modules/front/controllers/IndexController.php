<?php 


class Front_IndexController extends Zend_Controller_Action
{
	
	protected $cart;
	protected $em;
	private $repo;
	protected $layout;
	
	public function init(){
		
		$this->em = $this->_helper->EM->em();
        $this->repo = $this->_helper->EM; 
        
        $this->layout = Zend_Layout::getMvcInstance();
        $this->layout->setLayout('frontLayout');   
       
		$this->cart = new Zend_Session_Namespace('shopping_cart');
		
	}
	
	public function indexAction(){
		
		
	}
	
	
	
	
	
	
}

?>