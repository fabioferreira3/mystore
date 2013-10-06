<?php 

class Front_IndexController extends Zend_Controller_Action
{
	
	protected $cart;
	
	public function init(){
		try{
			$this->cart = new Zend_Session_Namespace('shopping_cart');
		}
		catch(Exception $e){echo $e->getMessage();}
		
	}
	
	public function indexAction(){
		
	}
	
	
	
	
	
	
}

?>