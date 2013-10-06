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

