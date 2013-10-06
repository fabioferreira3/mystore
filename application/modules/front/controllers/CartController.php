<?php 

class Front_CartController extends Zend_Controller_Action
{
	protected $cart;
	
	public function init(){
		try{
			
			$this->cart = new Zend_Session_Namespace('shopping_cart');
		
		}
		catch(Exception $e){echo $e->getMessage();}
	}
	
	public function indexAction(){
		try{
			$this->view->produtos = $this->cart->product;			
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function addAction(){
		
		$getvars = $this->getRequest()->getParams();
		if (!isset($getvars['product_id']) || empty($getvars['product_id'])){
			$this->_redirect('/carrinho');
		}else{
			
			// Verifica se o produto já consta no carrinho
			if (!array_key_exists($getvars['product_id'],$this->cart->product)){		
				$this->cart->product[$getvars['product_id']]->product_id = $getvars['product_id'];
				$this->cart->product[$getvars['product_id']]->qty = $getvars['qty'];
				$this->cart->product[$getvars['product_id']]->name = $getvars['name'];
				$this->cart->product[$getvars['product_id']]->price = $getvars['price'];
				$this->_redirect('/carrinho');
				
			// Se já existir, apenas atualiza a quantidade
			}else{
				$this->cart->product[$getvars['product_id']]->qty += $getvars['qty'];
				$this->_redirect('/carrinho');
			}
		}		
	}
	
	public function emptyCartAction(){
		try{
			Zend_Session::namespaceUnset('shopping_cart');
			$this->_redirect('/carrinho');
		}
		catch(Exception $e){echo $e->getMessage();}
	}
	
	
	
	
}

?>