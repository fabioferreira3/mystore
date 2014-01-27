<?php

class Application_Model_Email{
	
	protected $body;
	protected $to;
	protected $from;
	protected $subject;
	protected $lang;
	
	public function __construct() 

    {
    	$this->lang = Zend_Registry::get('Zend_Translate');
	}
	
	public function sendEmail($body, $to, $from, $subject){
		
		$this->to = $to;
		$this->from = $from;
		$this->subject = $subject;
		$this->body = $body;
		
		if ($from == false){
			$this->from = 'fabio@applemax.com.br';
		}
		      
        $config = array('auth' => 'login',
            'username' => 'fabio@applemax.com.br',
            'password' => 'ogBcpd521',
			'port' => '587');
     
        $transport = new Zend_Mail_Transport_Smtp('mail.applemax.com.br', $config);
     
        $mail = new Zend_Mail('UTF-8');
        $mail->setBodyHtml($this->body);
        $mail->setFrom($this->from, 'MyStore');
        $mail->setDate();
        
        $mail->addTo($this->to);
        $mail->setSubject($this->subject);
        try{$mail->send($transport);}
        catch(Exception $e){echo $e->getMessage();}
		
	}
	
	public function sendOrderConfirmation($orderObject){
		
		try{		
		//	Zend_Debug::dump($orderObject->getAddresses()[0]->getName());
		//	exit;	
			$view = $this->prepareTemplate();
			$view->assign('order',$orderObject);
			$body = $view->render('order_confirmation.phtml');
			$this->sendEmail($body,'fabio.ferreira3@outlook.com',false,'confirmação de seu pedido');		
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	protected function prepareTemplate(){
		
		$view = new Zend_View();
		$view->setScriptPath(APPLICATION_PATH . '/modules/front/views/emails/');
		
		return $view;
	}
	
}

?>