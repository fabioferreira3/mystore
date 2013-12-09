<?php 

class Admin_ShippingController extends Zend_Controller_Action{
	
	private $layout;
	private $em;
	private $repo;
	
	public function init(){
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
		$shipping = new Application_Model_Correios();
		$shipping->setConfig();
		$wsdlCorreios = 'ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL';
		$client = new SoapClient($wsdlCorreios);
		exit;
		}
		catch(Exception $e){echo $e->getMessage();exit;}
		$request = array(
				'nCdEmpresa'  => $shipping->getCdEmpresa(),
				'sDsSenha'  => $shipping->getDsSenha(),
				'nCdServico'  => $shipping->getCdServico(),
				'sCepOrigem'  => $shipping->getCepOrigem(),
				'sCepDestino'  => $shipping->getCepDestino(),
				'nVlPeso'  => $shipping->getVlPeso(),
				'nCdFormato'  => $shipping->getCdFormato(),
				'nVlComprimento'  => $shipping->getVlComprimento(),
				'nVlAltura'  => $shipping->getVlAltura(),
				'nVlLargura'  => $shipping->getVlLargura(),
				'nVlDiametro'  => $shipping->getVlDiametro(),
				'sCdMaoPropria'  => $shipping->getCdMaoPropria(),
				'nVlValorDeclarado'  => $shipping->getVlValorDeclarado(),
				'sCdAvisoRecebimento'  => $shipping->getCdAvisoRecebimento(),
				'StrRetorno'  => $shipping->getStrRetorno(),
				'nIndicaCalculo'  => $shipping->getIndicaCalculo()					
		);
		
	/*	$client = new Zend_Http_Client('http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx');
		$client->setMethod(Zend_Http_Client::POST);
	//	$client->setHeaders('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
		$client->setParameterPost(array(
				'nCdEmpresa'  => $shipping->getCdEmpresa(),
				'sDsSenha'  => $shipping->getDsSenha(),
				'nCdServico'  => $shipping->getCdServico(),
				'sCepOrigem'  => $shipping->getCepOrigem(),
				'sCepDestino'  => $shipping->getCepDestino(),
				'nVlPeso'  => $shipping->getVlPeso(),
				'nCdFormato'  => $shipping->getCdFormato(),
				'nVlComprimento'  => $shipping->getVlComprimento(),
				'nVlAltura'  => $shipping->getVlAltura(),
				'nVlLargura'  => $shipping->getVlLargura(),
				'nVlDiametro'  => $shipping->getVlDiametro(),
				'sCdMaoPropria'  => $shipping->getCdMaoPropria(),
				'nVlValorDeclarado'  => $shipping->getVlValorDeclarado(),
				'sCdAvisoRecebimento'  => $shipping->getCdAvisoRecebimento(),
				'StrRetorno'  => $shipping->getStrRetorno(),
				'nIndicaCalculo'  => $shipping->getIndicaCalculo()					
		));
		$response = $client->request();
		$data = simplexml_load_string($response->getBody());
		Zend_Debug::dump($response);exit;*/
		
	}
	
	public function returnAction(){
		
		
	}
}

?>