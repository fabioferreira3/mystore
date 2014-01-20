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
     * @var Orders
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

   }