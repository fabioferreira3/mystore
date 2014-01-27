<?php 

class Admin_ShippingController extends Zend_Controller_Action{
	
	private $layout;
	private $em;
	private $repo;
	
	public function init(){
		
		$auth = Zend_Auth::getInstance();
			
		if (!$auth->hasIdentity()) {
		
			$this->getHelper('Redirector')->gotoUrl('/admin238/index/login');
				
		}else{			
		
			$this->layout = Zend_Layout::getMvcInstance();
			$this->layout->setLayout('adminLayout');
			$this->em = $this->_helper->EM->em();
			$this->repo = $this->_helper->EM;
		
			if ($this->_helper->FlashMessenger->hasMessages('success')) {
				$this->view->msgSuccess = $this->_helper->FlashMessenger->getMessages('success');
			}
			if ($this->_helper->FlashMessenger->hasMessages('error')) {
				$this->view->msgError = $this->_helper->FlashMessenger->getMessages('error');
			}	
		}
		
	}
	
	public function indexAction(){
		try{			
			
			foreach($payment->getItems() as $item){
				$client->setParameterPost(array('itemId' . $i => $item['itemId' . $i],
												'itemDescription' . $i => $item['itemDescription' . $i],
												'itemAmount' . $i => $item['itemAmount' . $i],
												'itemQuantity' . $i => $item['itemQuantity' . $i],
												'itemWeight' . $i => $item['itemWeight' . $i]
				));				
				$i++;
			}
			
			$response = $client->request();
			if($response->getStatus() == '200'){
			$data = simplexml_load_string($response->getBody());
			$code = $data->code;			
			$this->getHelper('Redirector')->gotoUrl('https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code);
			exit;
			}else{
				Zend_Debug::dump($response);exit;
			}
		}
		catch(Exception $e){echo $e->getMessage();exit;}	
		
	}
	
	public function correiosAction(){

		try{			
			$params = $this->getRequest()->getParams();
			$correios = new Application_Model_Correios();
			
			if(isset($params['json'])){
				echo json_encode($correios->getPrecoPrazo('09655000',$params['cepDestino']));
				exit;
			}		
		}
		catch(Exception $e){echo $e->getMessage();exit;}		
	}
	
	public function returnAction(){
		
		
	}
}

?>