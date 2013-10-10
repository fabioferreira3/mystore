<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @Table(name="order")
 * @Entity
 */
class DB_Order
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
     * @var Order
     *
     * @ManyToOne(targetEntity="DB_Order")
     * @JoinColumns({
     *   @JoinColumn(name="order_status_id", referencedColumnName="order_status_id")
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
     * @var PaymentType
     *
     * @ManyToOne(targetEntity="DB_PaymentTypes")
     * @JoinColumns({
     *   @JoinColumn(name="payment_type_id", referencedColumnName="id")
     * })
     */
    private $paymentType;



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
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * @param DB_Order $orderStatus
     * @return Order
     */
    public function setOrderStatus(\DB_Order $orderStatus = null)
    {
        $this->orderStatus = $orderStatus;
        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return DB_Order 
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set client
     *
     * @param DB_Client $client
     * @return Order
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
     * Set paymentType
     *
     * @param DB_PaymentTypes $paymentType
     * @return 
     */
    public function setPaymentType(\DB_PaymentTypes $paymentType = null)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * Get paymentType
     *
     * @return DB_PaymentTypes 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }
}