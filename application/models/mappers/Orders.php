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
     * @var string $value
     *
     * @Column(name="value", type="string", nullable=true)
     */
    private $value;
    
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
     * @param DB_Orders $orderStatus
     * @return Orders
     */
    public function setOrderStatus(\DB_Orders $orderStatus = null)
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
     * Set value
     *
     * @param string $value
     * @return Orders
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    public function getOrders(array $params = null){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$query = $em->createQueryBuilder();
    	$query->select('o')->from('DB_Orders','o');
    	return $query->getQuery()->getResult();
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
    	
    }
    
    
}