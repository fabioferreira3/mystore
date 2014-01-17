<?php 

class Front_PaymentController extends Zend_Controller_Action{
    
    private $em;
    private $repo;
    
    public function init(){
        
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
            echo 'oi';exit;
        }
        catch(Exception $e){echo $e->getMessage();exit;}    
        
    }

    public function pagseguroAction(){
        try{
        	$params = $this->getRequest()->getParams();
        	if(isset($params['orderid'])){
        		$order = $this->repo->db('Orders')->find($params['orderid']);
        		$orderProducts = $this->repo->db('OrderProducts')->findByOrder($params['orderid']);
        		$orderAddresses = $this->repo->db('OrderAddresses')->findByOrder($params['orderid']);     		
        	}
        	foreach($orderAddresses as $row){
        		if($row->getAddressType()->getId() == 2){
        			$address['shipping'] = $row;
        		}else{
        			$address['billing'] = $row;
        		}
        	}
        	
        	$items = array();
        	$i = 0;
        	foreach($orderProducts as $item){
        		 $items[$i]['itemId'] = $item->getProduct()->getId();
        		 $items[$i]['itemDescription'] = $item->getProduct()->getName();
        		 $items[$i]['itemAmount'] = $item->getUnitPrice();
        		 $items[$i]['itemQuantity'] = $item->getQty();
        		 $items[$i]['itemWeight'] = $this->repo->db('Product')->find($item->getProduct()->getId())->getWeight() * 1000;
        		 $i++;
        	}
        	
            $payment = new Application_Model_Pagseguro();
            
            $payment->setToken('FBF98ADDD22C4D919A7AA1F9F808D1E1');
            $payment->setEmail('financeiro@linkideias.com.br');
            $payment->setItems($items);     
            $payment->setCurrency('BRL');
            $payment->setReference($order->getOrderCod());
            $payment->setSenderName($address['shipping']->getName());
            $payment->setSenderAreaCode('11');
            $payment->setSenderPhone('953210896');
            $payment->setSenderEmail($order->getClient()->getEmail());
            $payment->setShippingType($order->getShippingType()->getId());
            $payment->setShippingCost($order->getFreightCost());
            $payment->setShippingAddressStreet($address['shipping']->getAddress());
            $payment->setShippingAddressNumber($address['shipping']->getNumber());
            $payment->setShippingAddressComplement($address['shipping']->getComplement());
            $payment->setShippingAddressDistrict($address['shipping']->getDistrict());
            $payment->setShippingAddressPostalCode($address['shipping']->getZipcode());
            $payment->setShippingAddressCity($address['shipping']->getCity());
            $payment->setShippingAddressState($address['shipping']->getState()->getUf());
            $payment->setShippingAddressCountry($address['shipping']->getCountry()->getIso3());
           
            
            $client = new Zend_Http_Client('https://ws.pagseguro.uol.com.br/v2/checkout');
            $client->setMethod(Zend_Http_Client::POST);
            $client->setHeaders('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
            $client->setParameterPost(array(
                    'token'  => $payment->getToken(),
                    'email'  => $payment->getEmail(),
                    'currency'   => $payment->getCurrency(),
                    'reference' => $payment->getReference(),
                    'senderName' => $payment->getSenderName(),
                    'senderEmail' => $payment->getSenderEmail(),
                    'senderAreaCode' => $payment->getSenderAreaCode(),
                    'senderPhone' => $payment->getSenderPhone(),
                    'shippingType' => $payment->getShippingType(),
                    'shippingCost' => $payment->getShippingCost(),
                    'shippingAddressStreet' => $payment->getShippingAddressStreet(),
                    'shippingAddressNumber' => $payment->getShippingAddressNumber(),
                    'shippingAddressPostalCode' => $payment->getShippingAddressPostalCode(),
                    'shippingAddressDistrict' => $payment->getShippingAddressDistrict(),
                    'shippingAddressCity' => $payment->getShippingAddressCity(),
            		'shippingAddressState' => $payment->getShippingAddressState(),
                    'shippingAddressCountry' => $payment->getShippingAddressCountry(),
                    'maxuse' => 1
                                    
            ));
            $i = 1;
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
            if(isset($params['redirect']) && $params['redirect'] == 1){
            	$this->getHelper('Redirector')->gotoUrl('https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code);
            }else{
            	echo json_encode('https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code);
            	exit;
            }           
            
            }else{
                Zend_Debug::dump($response);exit;
            }
        }
        catch(Exception $e){echo $e->getMessage();exit;}   
    }
    
    public function returnAction(){
        try{
    //  $params = $this->getRequest()->getPost();
        
        $notificacao = 'E4A66EC1-15E7-4AB4-9E62-B32E3DD4A348';
        $token = 'FBF98ADDD22C4D919A7AA1F9F808D1E1';
        $email = 'financeiro@linkideias.com.br';
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $notificacao;     
        $client = new Zend_Http_Client($url);
        $client->setMethod(Zend_Http_Client::GET);
        $client->setHeaders('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
        $client->setParameterPost(array('email' => $email, 'token' => $token));
    //  $client->request();
        Zend_Debug::dump($client->request());
        exit;
        $response = $client->request();
        if($response->getStatus() == '200'){
            $data = simplexml_load_string($response->getBody());
            $reference = $data->reference;
            $status = $data->status;
            $tbOrder = new DB_Orders();
        }
        exit;
        }
        catch(Exception $e){echo $e->getMessage();exit;}
        
    }
}

?>