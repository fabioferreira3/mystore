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
            echo 'pagseguro';exit;
            $items = array();
            
            $items[0]['itemId'] = '123';
            $items[0]['itemDescription'] = 'Capa de iPhone 4 do Bob Esponja';
            $items[0]['itemAmount'] = '19.90';
            $items[0]['itemQuantity'] = '3';
            $items[0]['itemWeight'] = '100';
            
            $items[1]['itemId'] = '456';
            $items[1]['itemDescription'] = 'Capa de iPhone 5 Silicone Preto';
            $items[1]['itemAmount'] = '24.90';
            $items[1]['itemQuantity'] = '2';
            $items[1]['itemWeight'] = '100';
            
            $items[2]['itemId'] = '64';
            $items[2]['itemDescription'] = 'Capa do iPad Air Branco';
            $items[2]['itemAmount'] = '49.90';
            $items[2]['itemQuantity'] = '4';
            $items[2]['itemWeight'] = '150';
            
            $payment = new Application_Model_Pagseguro();
            
            $payment->setToken('FBF98ADDD22C4D919A7AA1F9F808D1E1');
            $payment->setEmail('financeiro@linkideias.com.br');
            $payment->setItems($items);     
            $payment->setCurrency('BRL');
            $payment->setReference('100272134');
            $payment->setSenderName('Fabio Ferreira');
            $payment->setSenderAreaCode('11');
            $payment->setSenderPhone('953210896');
            $payment->setSenderEmail('fabio.ferreira3@outlook.com');
            $payment->setShippingType('3');
            $payment->setShippingCost('9.90');
            $payment->setShippingAddressStreet('Rua Doutor Abelardo Vergueiro Cesar');
            $payment->setShippingAddressNumber('234');
            $payment->setShippingAddressComplement('');
            $payment->setShippingAddressDistrict('Vila Mascote');
            $payment->setShippingAddressPostalCode('04635080');
            $payment->setShippingAddressCity('Sao Paulo');
            $payment->setShippingAddressState('SP');
            $payment->setShippingAddressCountry('BRA');
            
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
                    'shippingType' => 3,
                    'shippingCost' => $payment->getShippingCost(),
                    'shippingAddressStreet' => $payment->getShippingAddressStreet(),
                    'shippingAddressNumber' => $payment->getShippingAddressNumber(),
                    'shippingAddressPostalCode' => $payment->getShippingAddressPostalCode(),
                    'shippingAddressDistrict' => $payment->getShippingAddressDistrict(),
                    'shippingAddressCity' => $payment->getShippingAddressCity(),
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
        //  $this->getHelper('Redirector')->gotoUrl('https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code);
            exit;
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