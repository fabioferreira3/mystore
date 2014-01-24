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
	
	public function emailSend($body, $to, $from, $subject){
		
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
	
	public function sendOrderConfirmation($orderid){
		
		try{
			
			$html = '';
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
}

?>