<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @Table(name="invoice")
 * @Entity
 */
class DB_Invoice
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
     * @var string $invoiceCod
     *
     * @Column(name="invoice_cod", type="string", length=50, nullable=false)
     */
    private $invoiceCod;

    /**
     * @var string $nf
     *
     * @Column(name="nf", type="string", length=255, nullable=true)
     */
    private $nf;

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
     * @var integer $status
     *
     * @Column(name="status", type="integer", nullable=false)
     */
    private $status;

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
     *   @JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;

    /**
     * @var Address
     *
     * @ManyToOne(targetEntity="DB_Address")
     * @JoinColumns({
     *   @JoinColumn(name="billing_address_id", referencedColumnName="id")
     * })
     */
    private $billingAddress;

    /**
     * @var Address
     *
     * @ManyToOne(targetEntity="DB_Address")
     * @JoinColumns({
     *   @JoinColumn(name="shipping_address_id", referencedColumnName="id")
     * })
     */
    private $shippingAddress;



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
     * Set invoiceCod
     *
     * @param string $invoiceCod
     * @return Invoice
     */
    public function setInvoiceCod($invoiceCod)
    {
        $this->invoiceCod = $invoiceCod;
        return $this;
    }

    /**
     * Get invoiceCod
     *
     * @return string 
     */
    public function getInvoiceCod()
    {
        return $this->invoiceCod;
    }

    /**
     * Set nf
     *
     * @param string $nf
     * @return Invoice
     */
    public function setNf($nf)
    {
        $this->nf = $nf;
        return $this;
    }

    /**
     * Get nf
     *
     * @return string 
     */
    public function getNf()
    {
        return $this->nf;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Invoice
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
     * @return Invoice
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
     * Set status
     *
     * @param integer $status
     * @return Invoice
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set emailSent
     *
     * @param boolean $emailSent
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * Set billingAddress
     *
     * @param DB_Address $billingAddress
     * @return Invoice
     */
    public function setBillingAddress(\DB_Address $billingAddress = null)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return DB_Address 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set shippingAddress
     *
     * @param DB_Address $shippingAddress
     * @return Invoice
     */
    public function setShippingAddress(\DB_Address $shippingAddress = null)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * Get shippingAddress
     *
     * @return DB_Address 
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }
}