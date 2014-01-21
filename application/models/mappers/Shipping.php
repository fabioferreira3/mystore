<?php


use Doctrine\ORM\Mapping as ORM;

/**
 * Shipping
 *
 * @Table(name="shipping")
 * @Entity
 */
class DB_Shipping
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
     * @var string $shippingCod
     *
     * @Column(name="shipping_cod", type="string", length=50, nullable=false)
     */
    private $shippingCod;    

    /**
     * @var boolean $emailSent
     *
     * @Column(name="email_sent", type="boolean", nullable=true)
     */
    private $emailSent;

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
     * @var Store
     *
     * @ManyToOne(targetEntity="DB_Store")
     * @JoinColumns({
     *   @JoinColumn(name="store_id", referencedColumnName="id")
     * })
     */
    private $store;

    /**
     * @var Order
     *
     * @ManyToOne(targetEntity="DB_Orders")
     * @JoinColumns({
     *   @JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;
    
    
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
     * Set shippingCod
     *
     * @param string $shippingCod
     * @return Shipping
     */
    public function setShippingCod($shippingCod)
    {
        $this->shippingCod = $shippingCod;
        return $this;
    }

    /**
     * Get shippingCod
     *
     * @return string 
     */
    public function getShippingCod()
    {
        return $this->shippingCod;
    }    

    /**
     * Set emailSent
     *
     * @param boolean $emailSent
     * @return Shipping
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
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Shipping
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
     * @return Shipping
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
     * Set store
     *
     * @param DB_Store $store
     * @return Shipping
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
     * Set order
     *
     * @param DB_Orders $order
     * @return Shipping
     */
    public function setOrder(\DB_Orders $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return DB_Orders 
     */
    public function getOrder()
    {
        return $this->order;
    }
    
    public function getLastShipping($orderId){
        
        $em = Zend_Registry::getInstance()->entitymanager;
        $query = $em->createQueryBuilder()->select('s')->from('DB_Shipping','s');
        $query->where('s.order = :orderId');
        $query->setParameter('orderId',$orderId);
        $query->orderBy('s.id','DESC');
        return $query->getQuery()->getSingleResult();
    }
    
    public function createShipping($params){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$order = $em->getRepository('DB_Orders')->find($params['orderid']);
    	$store = $em->getRepository('DB_Store')->find(1);    	
    	
    	$dtNow = new DateTime();
    	
    	$random = '';
    	for($i=0; $i <= 10; $i++){
    		$random .= mt_rand(1,9);
    	}
        $tbShipping = new DB_Shipping();
    	$tbShipping->setShippingCod($random);
    	$tbShipping->setOrder($order);
    	$tbShipping->setEmailSent($params['sendemail']);
    	$tbShipping->setDateCreate($dtNow);
    	$tbShipping->setDateUpd($dtNow);
    	$tbShipping->setStore($store);
        
        $em->persist($tbShipping);
        
        // Grava os códigos de rastreio
        
        if(isset($params['tracking'])){
            $i = 0;
            
            foreach($params['tracking'] as $tracking){
                $tbShippingTracking = new DB_ShippingTracking();
                $shippingType = $em->getRepository('DB_ShippingType')->find($params['shippingType'][$i]);
                $tbShippingTracking->setShipping($tbShipping);
                $tbShippingTracking->setTrackingNumber($tracking);
                $tbShippingTracking->setShippingType($shippingType);
                $tbShippingTracking->setDateCreate($dtNow);
                $tbShippingTracking->setDateUpd($dtNow);
                $em->persist($tbShippingTracking);
                $i++;
            }
        }
        
        // Altera o status do pedido para 'Enviado'
        
        $sentStatus = $em->getRepository('DB_OrderStatus')->find(6);
        $order->setOrderStatus($sentStatus);
        $order->setDateUpd($dtNow);
        $em->persist($order);
        
        
        // Altera o status de cada item do pedido para 'Enviado'
        
        $orderProducts = $em->getRepository('DB_OrderProducts')->findByOrder($order);
        foreach ($orderProducts as $product){
            $product->setStatus(2);
            $em->persist($product);
        }
        
        $em->flush();
        
          	
    }

   }