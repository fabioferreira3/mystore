<?php 

class Application_Model_Pagseguro{
	
	protected $token;	
	protected $email;
	protected $currency;
	protected $items = array();	
	protected $reference;
	protected $senderName;
	protected $senderAreaCode;
	protected $senderPhone;
	protected $senderEmail;
	protected $shippingType;
	protected $shippingCost;
	protected $shippingAddressStreet;
	protected $shippingAddressNumber;
	protected $shippingAddressComplement;
	protected $shippingAddressDistrict;
	protected $shippingAddressPostalCode;
	protected $shippingAddressCity;
	protected $shippingAddressState;
	protected $shippingAddressCountry;
	
	
	/* Setters */
	
	public function setToken($token){
		$this->token = $token;
		return $this;
	}
	
	public function setItems(array $items){
		$this->items = $items;
		return $this;
	}
	
	public function setEmail($email){
		$this->email = $email;
		return $this;
	}
	
	public function setCurrency($currency){
		$this->currency = $currency;
		return $this;
	}
	
	public function setReference($reference){
		$this->reference = $reference;
		return $this;
	}
	
	public function setSenderName($senderName){
		$this->senderName = $senderName;
		return $this;
	}
	
	public function setSenderAreaCode($senderAreaCode){
		$this->senderAreaCode = $senderAreaCode;
		return $this;
	}
	
	public function setSenderPhone($senderPhone){
		$this->senderPhone = $senderPhone;
		return $this;
	}
	
	public function setSenderEmail($senderEmail){
		$this->senderEmail = $senderEmail;
		return $this;
	}
	
	public function setShippingType($shippingType){
		$this->shippingType = $shippingType;
		return $this;
	}
	
	public function setShippingCost($shippingCost){
		$this->shippingCost = $shippingCost;
		return $this;
	}
	
	public function setShippingAddressStreet($shippingAddressStreet){
		$this->shippingAddressStreet = $shippingAddressStreet;
		return $this;
	}
	
	public function setShippingAddressNumber($shippingAddressNumber){
		$this->shippingAddressNumber = $shippingAddressNumber;
		return $this;
	}
	
	public function setShippingAddressComplement($shippingAddressComplement){
		$this->shippingAddressComplement = $shippingAddressComplement;
		return $this;
	}
	
	public function setShippingAddressDistrict($shippingAddressDistrict){
		$this->shippingAddressDistrict = $shippingAddressDistrict;
		return $this;
	}
	
	public function setShippingAddressPostalCode($shippingAddressPostalCode){
		$this->shippingAddressPostalCode = $shippingAddressPostalCode;
		return $this;
	}
	
	public function setShippingAddressCity($shippingAddressCity){
		$this->shippingAddressCity = $shippingAddressCity;
		return $this;
	}
	
	public function setShippingAddressState($shippingAddressState){
		$this->shippingAddressState = $shippingAddressState;
		return $this;
	}
	
	public function setShippingAddressCountry($shippingAddressCountry){
		$this->shippingAddressCountry = $shippingAddressCountry;
		return $this;
	}
	
	/* Getters */
	
	public function getToken(){
		return $this->token;		
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getItems(){
		$k = 0;
		$i = 1;
		$items = '';
		foreach ($this->items as $item){
			$items[$k]['itemId' . $i] = $item['itemId'];
			$items[$k]['itemDescription' . $i] = $item['itemDescription'];
			$items[$k]['itemAmount' . $i] = $item['itemAmount'];
			$items[$k]['itemQuantity' . $i] = $item['itemQuantity'];
			$items[$k]['itemWeight' . $i] = $item['itemWeight'];
			$i++;
			$k++;
		}
		return $items;
	}
	
	public function getCurrency(){
		return $this->currency;		
	}
	
	public function getReference(){
		return $this->reference;		
	}
	
	public function getSenderName(){
		return $this->senderName;		
	}
	
	public function getSenderAreaCode(){
		return $this->senderAreaCode;		
	}
	
	public function getSenderPhone(){
		return $this->senderPhone;		
	}
	
	public function getSenderEmail(){
		return $this->senderEmail;		
	}
	
	public function getShippingType(){
		return $this->shippingType;		
	}
	
	public function getShippingCost(){
		return $this->shippingCost;
	}
	
	public function getShippingAddressStreet(){
		return $this->shippingAddressStreet;		
	}
	
	public function getShippingAddressNumber(){
		return $this->shippingAddressNumber;		
	}
	
	public function getShippingAddressComplement(){
		return $this->shippingAddressComplement;		
	}
	
	public function getShippingAddressDistrict(){
		return $this->shippingAddressDistrict;		
	}
	
	public function getShippingAddressPostalCode(){
		return $this->shippingAddressPostalCode;		
	}
	
	public function getShippingAddressCity(){
		return $this->shippingAddressCity;		
	}
	
	public function getShippingAddressState(){
		return $this->shippingAddressState;		
	}
	
	public function getShippingAddressCountry(){
		return $this->shippingAddressCountry;		
	}
}

?>