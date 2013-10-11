<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	/**
	 * Inicializa o Local e Tradutor
	 *
	 * @return void
	 */
	public function _initLocale() {
	
		$localeValue = 'pt-BR';
	
		$locale = new Zend_Locale($localeValue);
		Zend_Registry::set('Zend_Locale', $locale);
		$config = $this->getOptions();
		$langDir = $config['resources']['frontController']['langDirectory'];
		$translationFile = $langDir . DIRECTORY_SEPARATOR . $localeValue . '.inc.php';
	
		$translate = new Zend_Translate('array', $translationFile, $localeValue);
		Zend_Registry::set('Zend_Translate', $translate);
	
		$teste = $translate->getAdapter();
	
	}
	
	
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
                'admin_controller',
                new Zend_Controller_Router_Route('/admin238/:controller',
                        array(  'module' => 'admin',
                                'controller' => ':controller'
                        ))
        );
        $router->addRoute(
                'admin_action',
                new Zend_Controller_Router_Route('/admin238/:controller/:action',
                        array(  'module' => 'admin',
                                'controller' => ':controller'
                        ))
        );
		$router->addRoute(
				'admin_root',
				new Zend_Controller_Router_Route('/admin238',
						array(	'module' => 'admin',
								'controller' => 'index'
						))
		);
		
	}
	
	/**
	 * Inicializa as Variáveis de Sessão e Adaptador do Banco de Dados
	 *
	 * @return void
	 */
	protected function _initAccess(){
	
		$auth = Zend_Auth::getInstance();
	
		if ($auth->hasIdentity()) {
	
			$this->bootstrap('db');
			$db = $this->getResource('db');
	
			$userInfo = Zend_Auth::getInstance()->getStorage()->read();
	
		}
	}
	
	/**
	 * generate registry
	 * @return Zend_Registry
	 */
	protected function _initRegistry(){
		$registry = Zend_Registry::getInstance();
		return $registry;
	}
	
	/**
	 * Register namespace Default_
	 * @return Zend_Application_Module_Autoloader
	 */
	protected function _initResourceLoader()
	{
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'namespace' => '',
				'basePath'  => APPLICATION_PATH,
		));
		$resourceLoader->addResourceType('db', 'models/mappers', 'DB');
		$resourceLoader->addResourceType('model', 'models/', 'Model');
		$resourceLoader->addResourceType('form', 'forms/', 'Form');
		$resourceLoader->addResourceType('service', 'services/', 'Service');
	
		return $resourceLoader;
	}
	
	/**
	 * Initialize Doctrine
	 * @return Doctrine_Manager
	 */
	public function _initDoctrine() {
		// include and register Doctrine's class loader
		require_once('Doctrine/Common/ClassLoader.php');
		$classLoader = new \Doctrine\Common\ClassLoader(
				'Doctrine',
				APPLICATION_PATH . '/../library/'
		);
		$classLoader->register();
			
		// create the Doctrine configuration
		$config = new \Doctrine\ORM\Configuration();
	
		// setting the cache ( to ArrayCache. Take a look at
		// the Doctrine manual for different options ! )
		$cache = new \Doctrine\Common\Cache\ArrayCache;
		$config->setMetadataCacheImpl($cache);
		$config->setQueryCacheImpl($cache);
	
		// choosing the driver for our database schema
		// we'll use annotations
		$driver = $config->newDefaultAnnotationDriver(
				APPLICATION_PATH . '/models'
		);
		$config->setMetadataDriverImpl($driver);
	
		// set the proxy dir and set some options
		$config->setProxyDir(APPLICATION_PATH . '/models/Proxies');
		$config->setAutoGenerateProxyClasses(true);
		$config->setProxyNamespace('App\Proxies');
	
		// now create the entity manager and use the connection
		// settings we defined in our application.ini
		$connectionSettings = $this->getOption('doctrine');
		$conn = array(
		'driver'    => $connectionSettings['conn']['driv'],
		'user'      => $connectionSettings['conn']['user'],
		'password'  => $connectionSettings['conn']['pass'],
				'dbname'    => $connectionSettings['conn']['dbname'],
						'host'      => $connectionSettings['conn']['host'],
						'charset' => 'utf8'
		);
		$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
	
		// push the entity manager into our registry for later use
				$registry = Zend_Registry::getInstance();
				$registry->entitymanager = $entityManager;
	
				return $entityManager;
	}
	
	protected function _initCustomHelpers(){		 
		Zend_Controller_Action_HelperBroker::addPath(
		APPLICATION_PATH . '/controllers/helpers');
	}

}