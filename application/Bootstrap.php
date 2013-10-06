<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initRoute(){
		$ctrl = Zend_Controller_Front::getInstance();
		$router = $ctrl->getRouter();
		$router->addRoute(
				'front_root',
				new Zend_Controller_Router_Route('/',
						array(	'module' => 'front',
								'controller' => 'index'							
								))
		);
		$router->addRoute(
				'shopping_cart',
				new Zend_Controller_Router_Route('/carrinho/:action',
						array(	'module' => 'front',
								'controller' => 'cart',
								'action' => ':action'
						))
		);
		$router->addRoute(
				'shopping_cart_add',
				new Zend_Controller_Router_Route('/carrinho/adicionar',
						array(	'module' => 'front',
								'controller' => 'cart',
								'action' => 'add'
						))
		);
		$router->addRoute(
				'shopping_cart_empty',
				new Zend_Controller_Router_Route('/carrinho/esvaziar',
						array(	'module' => 'front',
								'controller' => 'cart',
								'action' => 'empty-cart'
						))
		);
		$router->addRoute(
				'shopping_cart_root',
				new Zend_Controller_Router_Route('/carrinho/',
						array(	'module' => 'front',
								'controller' => 'cart',
								'action' => 'index'
						))
		);
		$router->addRoute(
				'product_root',
				new Zend_Controller_Router_Route('/produto/',
						array(	'module' => 'front',
								'controller' => 'product',
								'action' => 'index'
						))
		);
		$router->addRoute(
				'product_action',
				new Zend_Controller_Router_Route('/produto/:action',
						array(	'module' => 'front',
								'controller' => 'product'
						))
		);
		$router->addRoute(
				'admin_root',
				new Zend_Controller_Router_Route('/admin238',
						array(	'module' => 'admin',
								'controller' => 'index'
						))
		);
		$router->addRoute(
				'admin_security',
				new Zend_Controller_Router_Route('/admin',
						array(	'module' => 'front',
								'controller' => 'index'
						))
		);
		
		
	}

}

