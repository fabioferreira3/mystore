<?php


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator as Paginator;

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
     * @var Tracking
     *
     * @OneToMany(targetEntity="DB_ShippingTracking", mappedBy="shipping")
      
     */
    private $tracking;

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
     * Get trackingNumber
     *
     * @return string
     */
    public function getTracking()
    {
    	return $this->tracking;
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
    
    public function getShippings($params = null,$perPage = null, $curPage = null){
    	
    	if(!$perPage){
    		$perPage = 1000;
    	}
    	if(!$curPage){
    		$curPage = 1;
    	}
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$query = $em->createQueryBuilder();
    	$query->select('s')->from('DB_Shipping','s');
        $query->where('s.id > 0');
       
        if(isset($params['ordercod']) && $params['ordercod'] != ''){           
            $query->innerjoin('s.order','ord','WITH','ord.orderCod LIKE :orderCod');            
            $query->setParameter(':orderCod','%'.$params['ordercod'].'%');            
        } 
        if(isset($params['shippingcod']) && $params['shippingcod'] != ''){           
            $query->andWhere('s.shippingCod LIKE :shippingcod');        
            $query->setParameter(':shippingcod','%'.$params['shippingcod'].'%');            
        } 
        if(isset($params['shippingtype']) && $params['shippingtype'] != ''){           
            $query->innerjoin('s.order','frg','WITH','frg.shippingType = :shippingtype');       
            $query->setParameter(':shippingtype',$params['shippingtype']);            
        }
        if(isset($params['dateship']) && $params['dateship'] != ''){
            $dateShip = new DateTime(str_replace('/', '-',$params['dateship']));           
            $query->andWhere('s.dateCreate >= :dateship1 AND s.dateCreate <= :dateship2');
            $query->setParameter(':dateship1',$dateShip->format('Y-m-d') .' 00:00:00');
            $query->setParameter(':dateship2',$dateShip->format('Y-m-d') .' 23:59:59');
        } 
    	
    	$paginator = new Paginator($query);
    	$paginator_iter = $paginator->getIterator();
    	$adapter =  new \Zend_Paginator_Adapter_Iterator($paginator_iter);
    	$data = new \Zend_Paginator($adapter);
    	$data->setItemCountPerPage($perPage)->setCurrentPageNumber($curPage);
    	
    	return $data;
    	
    }
    
    public function generateTable($data){
    	 
    	$html = '';
    	$html .='<tbody>';
    	foreach($data as $shipping){
    		
    		
    		$html.=			'<tr class="record"><td><a href="/admin238/manage-orders/details?orderid='. $shipping->getOrder()->getId() .'">' . $shipping->getOrder()->getOrderCod().'</a></td>';
    		$html.=			'<td><a href="/admin238/manage-orders/shipping?orderid='. $shipping->getOrder()->getId() .'&shippingid='. $shipping->getId() . '">' . $shipping->getShippingCod().'</a></td>';
    		$html.=			'<td>'. $shipping->getOrder()->getShippingType()->getName() .'</td>';
    		$html.=			'<td>'. $shipping->getDateCreate()->format('d/m/Y') .'</td>';    		
    		$html.=			'</tr>';
    		$html.=			'</tbody>';
    	}
    	 
    	return $html;
    
    }

   }