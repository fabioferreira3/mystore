<?php



use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator as Paginator;

/**
 * Order
 *
 * @Table(name="orders")
 * @Entity
 */
class DB_Orders
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $orderCod
     *
     * @Column(name="order_cod", type="string", length=50, nullable=false)
     */
    private $orderCod;

    /**
     * @var datetime $dateCreate
     *
     * @Column(name="date_create", type="datetime", nullable=false)
     */
    private $dateCreate;

    /**
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=true)
     */
    private $dateUpd;

    /**
     * @var boolean $emailSent
     *
     * @Column(name="email_sent", type="boolean", nullable=true)
     */
    private $emailSent;

    /**
     * @var Store
     *
     * @ManyToOne(targetEntity="DB_Store")
     * @JoinColumns({
     *   @JoinColumn(name="store_id", referencedColumnName="id")
     * })
     */
    private $store;

    /**
     * @var OrderStatus
     *
     * @ManyToOne(targetEntity="DB_OrderStatus")
     * @JoinColumns({
     *   @JoinColumn(name="order_status_id", referencedColumnName="id")
     * })
     */
    private $orderStatus;

    /**
     * @var Client
     *
     * @ManyToOne(targetEntity="DB_Client")
     * @JoinColumns({
     *   @JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;
    
    /**
     * @var string $productPrice
     *
     * @Column(name="products_price", type="string", nullable=true)
     */
    private $productPrice;
    
    /**
     * @var string $freightCost
     *
     * @Column(name="freight_cost", type="string", nullable=true)
     */
    private $freightCost;
    
    /**
     * @var string $totalPrice
     *
     * @Column(name="total_price", type="string", nullable=true)
     */
    private $totalPrice;
    
    /**
     * @var ShippingType
     *
     * @ManyToOne(targetEntity="DB_ShippingType")
     * @JoinColumns({
     *   @JoinColumn(name="shipping_type", referencedColumnName="id")
     * })
     */
    private $shippingType;
    
    /**
     * @var PaymentType
     *
     * @ManyToOne(targetEntity="DB_PaymentTypes")
     * @JoinColumns({
     *   @JoinColumn(name="payment_type", referencedColumnName="id")
     * })
     */
    private $paymentType;
    
    /**
     * @var integer $gift
     *
     * @Column(name="gift", type="integer", nullable=true)
     */
    private $gift;
    
    /**
     * @var string $giftMsg
     *
     * @Column(name="gift_msg", type="string", nullable=true)
     */
    private $giftMsg;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderCod
     *
     * @param string $orderCod
     * @return Orders
     */
    public function setOrderCod($orderCod)
    {
        $this->orderCod = $orderCod;
        return $this;
    }

    /**
     * Get orderCod
     *
     * @return string 
     */
    public function getOrderCod()
    {
        return $this->orderCod;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Orders
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return datetime 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateUpd
     *
     * @param datetime $dateUpd
     * @return Orders
     */
    public function setDateUpd($dateUpd)
    {
        $this->dateUpd = $dateUpd;
        return $this;
    }

    /**
     * Get dateUpd
     *
     * @return datetime 
     */
    public function getDateUpd()
    {
        return $this->dateUpd;
    }

    /**
     * Set emailSent
     *
     * @param boolean $emailSent
     * @return Orders
     */
    public function setEmailSent($emailSent)
    {
        $this->emailSent = $emailSent;
        return $this;
    }

    /**
     * Get emailSent
     *
     * @return boolean 
     */
    public function getEmailSent()
    {
        return $this->emailSent;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return Orders
     */
    public function setStore(\DB_Store $store = null)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * Get store
     *
     * @return DB_Store 
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set orderStatus
     *
     * @param DB_OrdersStatus $orderStatus
     * @return Orders
     */
    public function setOrderStatus(\DB_OrderStatus $orderStatus = null)
    {
        $this->orderStatus = $orderStatus;
        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return DB_Orders 
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set client
     *
     * @param DB_Client $client
     * @return Orders
     */
    public function setClient(\DB_Client $client = null)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get client
     *
     * @return DB_Client 
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /**
     * Set productPrice
     *
     * @param string $productPrice
     * @return Orders
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
        return $this;
    }

    /**
     * Get productPrice
     *
     * @return string 
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }
    
    /**
     * Set freightCost
     *
     * @param string $freightCost
     * @return Orders
     */
    public function setFreightCost($freightCost)
    {
    	$this->freightCost = $freightCost;
    	return $this;
    }
    
    /**
     * Get freightCost
     *
     * @return string
     */
    public function getFreightCost()
    {
    	return $this->freightCost;
    }
    
    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     * @return Orders
     */
    public function setTotalPrice($totalPrice)
    {
    	$this->totalPrice = $totalPrice;
    	return $this;
    }
    
    /**
     * Get totalPrice
     *
     * @return string
     */
    public function getTotalPrice()
    {
    	return $this->totalPrice;
    }
    
    /**
     * Set shippingType
     *
     * @param DB_ShippingType $shippingType
     * @return Orders
     */
    public function setShippingType(\DB_ShippingType $shippingType = null)
    {
    	$this->shippingType = $shippingType;
    	return $this;
    }
    
    /**
     * Get shippingType
     *
     * @return DB_Client
     */
    public function getShippingType()
    {
    	return $this->shippingType;
    }
    
    /**
     * Set paymentType
     *
     * @param DB_PaymentTypes $paymentType
     * @return Orders
     */
    public function setPaymentType(\DB_PaymentTypes $paymentType = null)
    {
    	$this->paymentType = $paymentType;
    	return $this;
    }
    
    /**
     * Get paymentType
     *
     * @return DB_Client
     */
    public function getPaymentType()
    {
    	return $this->paymentType;
    }
    
    /**
     * Set gift
     *
     * @param integer $gift
     * @return Orders
     */
    public function setGift($gift)
    {
        $this->gift = $gift;
        return $this;
    }

    /**
     * Get gift
     *
     * @return integer
     */
    public function getGift()
    {
        return $this->gift;
    }
    
    /**
     * Set giftMsg
     *
     * @param string $giftMsg
     * @return Orders
     */
    public function setGiftMsg($giftMsg)
    {
        $this->giftMsg = $giftMsg;
        return $this;
    }

    /**
     * Get giftMsg
     *
     * @return string 
     */
    public function getGiftMsg()
    {
        return $this->giftMsg;
    }
    
    
    public function getOrders(array $params = null){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$query = $em->createQueryBuilder();
    	$query->select('o')->from('DB_Orders','o');
    	
    	if(isset($params['orderId']) && $params['orderId'] != ''){
    		$query->where('o.id > 0');
    	}
    	if(isset($params['perPage'])){
    		$perPage = $params['perPage'];
    	}else{
    		$perPage = 100;
    	}
    	if(isset($params['currentPage'])){
    		$currentPage = $params['currentPage'];
    	}else{
    		$currentPage = 1;
    	}
    	
    	$paginator = new Paginator($query);
    	$paginator_iter = $paginator->getIterator();
    	$adapter =  new \Zend_Paginator_Adapter_Iterator($paginator_iter);
    	$data = new \Zend_Paginator($adapter);
    	$data->setItemCountPerPage($perPage)->setCurrentPageNumber($currentPage);
    	
    	return $data;
    	
    }
    
    public function generateTable($data){
    	
    	$html = '';
    	$html .='<tbody>';
    	foreach($data as $order){
    		$status = $order->getOrderStatus()->getId();
    		$orderId = $order->getId();
    		if($order->getClient() !== null ){;
    			$name = $order->getClient()->getFirstName() . ' ' . $order->getClient()->getLastName();
    		}else{
    			$name = '';
    		}
    		$actions = '';
    		if($status === 1 || $status === 2 || $status === 4){
    			if($status === 1 || $status === 4){
    				$actions .= '<button value="'. $orderId . '" class="btn span12 confirm">Aprovar</button>';
    			}
    			if($status === 2){
    				$actions .= '<button value="'. $orderId . '" class="btn span12 send">Enviar</button>';
    			}
    			$actions .= '<button value="'. $orderId . '" class="btn span12 cancel">Cancelar</button>';
    		}
    		if($status === 3 || $status === 5){
    			$actions .= '<button value="'. $orderId . '" class="btn span12 rebuy">Recomprar</button>';
    		}
    		if($status === 7){
    			$actions .= '<button value="'. $orderId . '" class="btn span12 edit">Editar</button>';
    			$actions .= '<button value="'. $orderId . '" class="btn span12 remove">Excluir</button>';
    		}
    		$html.=			'<tr>
    						<td><input type="checkbox" value="'. $order->getId() .'"/></td>';
    		$html.=			'<td>'. $order->getId() .'</td>';
    		$html.=			'<td>#'. $order->getOrderCod() .'</td>';
    		$html.=			'<td>'. $name .'</td>';
    		$html.=			'<td>'. $order->getDateCreate()->format('d/m/Y - H:i') .'</td>';
    		$html.=			'<td>'. $order->getDateUpd()->format('d/m/Y - H:i') .'</td>';    		
    		$html.=			'<td>R$ '. $order->getValue() .'</td>';
    		$html.=			'<td>'. $order->getOrderStatus()->getName() .'</td>';
    		$html.=			'<td>'. $actions .'</td>';
    		$html.=			'</tr>';
    		$html.=			'</tbody>';    					 
    	}
    	
    	return $html;
    				
    }
    
    public function getLastOrderCod(){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$query = $em->createQueryBuilder();
    	$query->select('o')->from('DB_Orders','o');
    	$query->orderBy('o.id', 'DESC');
    	$query->setMaxResults('1');
    	
    	return $query->getQuery()->getSingleResult()->getOrderCod();
    }
    
    public function saveOrder($params){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$order = $em->getRepository('DB_Orders')->find($params['orderId']);    	
    	$client = $em->getRepository('DB_Client')->find($params['clientId']);
    	
    	if($params['paymentType'] == 'pagseguro'){
    		$paymentType = $em->getRepository('DB_PaymentTypes')->find(1);
    	}else if($params['paymentType'] == 'transfer'){
    		$paymentType = $em->getRepository('DB_PaymentTypes')->find(2);
    	}else if($params['paymentType'] == 'money'){
    		$paymentType = $em->getRepository('DB_PaymentTypes')->find(3);
    	}
    	
    	if($params['shippingType'] == 'sedex'){
    		$shippingType = $em->getRepository('DB_ShippingType')->find(1);
    	}else if($params['shippingType'] == 'pac'){
    		$shippingType = $em->getRepository('DB_ShippingType')->find(3);
    	}else if($params['shippingType'] == 'custom'){
    		$shippingType = $em->getRepository('DB_ShippingType')->find(2);
    	}    	
    	
    	$order->setClient($client);
    	$order->setProductPrice($params['productPrice']);
    	$order->setFreightCost($params['freightCost']);
    	$order->setTotalPrice($params['totalPrice']);
    	$order->setShippingType($shippingType);
    	$order->setPaymentType($paymentType);
    	
    	if($params['gift'] == 1){
    		$order->setGift(1);
    		$order->setGiftMsg($params['giftMsg']);
    	}else{
    		$order->setGift(0);
    	}
    	
    	$em->persist($order);
    	$em->flush($order);
    }
    
    public function destroy($orderId){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$order = $em->getRepository('DB_Orders')->find($orderId);
    	
    	if($order->getOrderStatus()->getId() === 7){    		
	    	$em->remove($order);
	    	$em->flush();
	    	return true;
    	}else{
    		return false;
    	}	
    	
    }
    
    
}