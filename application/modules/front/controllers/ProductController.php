<?php 

class Front_ProductController extends Zend_Controller_Action
{
	public function init(){
		
	}
	
	public function indexAction(){
		try{
			$teste = new DB_Address();
			$teste->setStreet('Rua Vergueiro');
			echo $teste->getStreet();
			exit;
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
}

?>