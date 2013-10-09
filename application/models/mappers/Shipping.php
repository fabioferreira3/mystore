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
     * @var string $trackingNumber
     *
     * @Column(name="tracking_number", type="string", length=255, nullable=true)
     */
    private $trackingNumber;

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
     * @ManyToOne(targetEntity="DB_Order")
     * @JoinColumns({
     *   @JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;

    /**
     * @var Invoice
     *
     * @ManyToOne(targetEntity="DB_Invoice")
     * @JoinColumns({
     *   @JoinColumn(name="invoice_id", referencedColumnName="id")
     * })
     */
    private $invoice;

    /**
     * @var ShippingType
     *
     * @ManyToOne(targetEntity="DB_ShippingType")
     * @JoinColumns({
     *   @JoinColumn(name="shipping_type_id", referencedColumnName="id")
     * })
     */
    private $shippingType;



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
     * Set trackingNumber
     *
     * @param string $trackingNumber
     * @return Shipping
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * Get trackingNumber
     *
     * @return string 
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
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
     * @param DB_Order $order
     * @return Shipping
     */
    public function setOrder(\DB_Order $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return DB_Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set invoice
     *
     * @param DB_Invoice $invoice
     * @return Shipping
     */
    public function setInvoice(\DB_Invoice $invoice = null)
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     * Get invoice
     *
     * @return DB_Invoice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set shippingType
     *
     * @param DB_ShippingType $shippingType
     * @return Shipping
     */
    public function setShippingType(\DB_ShippingType $shippingType = null)
    {
        $this->shippingType = $shippingType;
        return $this;
    }

    /**
     * Get shippingType
     *
     * @return DB_ShippingType 
     */
    public function getShippingType()
    {
        return $this->shippingType;
    }
}