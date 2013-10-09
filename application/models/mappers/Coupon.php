<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Coupon
 *
 * @Table(name="coupon")
 * @Entity
 */
class DB_Coupon
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
     * @var string $couponCod
     *
     * @Column(name="coupon_cod", type="string", length=255, nullable=false)
     */
    private $couponCod;

    /**
     * @var integer $valueType
     *
     * @Column(name="value_type", type="integer", nullable=false)
     */
    private $valueType;

    /**
     * @var integer $value
     *
     * @Column(name="value", type="integer", nullable=false)
     */
    private $value;

    /**
     * @var datetime $dateFrom
     *
     * @Column(name="date_from", type="datetime", nullable=true)
     */
    private $dateFrom;

    /**
     * @var datetime $dateTo
     *
     * @Column(name="date_to", type="datetime", nullable=true)
     */
    private $dateTo;

    /**
     * @var datetime $dateCreate
     *
     * @Column(name="date_create", type="datetime", nullable=false)
     */
    private $dateCreate;

    /**
     * @var boolean $status
     *
     * @Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var Store
     *
     * @ManyToOne(targetEntity="Store")
     * @JoinColumns({
     *   @JoinColumn(name="store_id", referencedColumnName="id")
     * })
     */
    private $store;

    /**
     * @var CouponType
     *
     * @ManyToOne(targetEntity="DB_CouponType")
     * @JoinColumns({
     *   @JoinColumn(name="coupon_type_id", referencedColumnName="id")
     * })
     */
    private $couponType;

    /**
     * @var Admin
     *
     * @ManyToOne(targetEntity="DB_Admin")
     * @JoinColumns({
     *   @JoinColumn(name="admin_id", referencedColumnName="id")
     * })
     */
    private $admin;

    /**
     * @var DB_Client
     *
     * @ManyToOne(targetEntity="DB_Client")
     * @JoinColumns({
     *   @JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;



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
     * Set couponCod
     *
     * @param string $couponCod
     * @return Coupon
     */
    public function setCouponCod($couponCod)
    {
        $this->couponCod = $couponCod;
        return $this;
    }

    /**
     * Get couponCod
     *
     * @return string 
     */
    public function getCouponCod()
    {
        return $this->couponCod;
    }

    /**
     * Set valueType
     *
     * @param integer $valueType
     * @return Coupon
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;
        return $this;
    }

    /**
     * Get valueType
     *
     * @return integer 
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Coupon
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set dateFrom
     *
     * @param datetime $dateFrom
     * @return Coupon
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return datetime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param datetime $dateTo
     * @return Coupon
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * Get dateTo
     *
     * @return datetime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Coupon
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
     * Set status
     *
     * @param boolean $status
     * @return Coupon
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set store
     *
     * @param Store $store
     * @return Coupon
     */
    public function setStore(\Store $store = null)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * Get store
     *
     * @return Store 
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set couponType
     *
     * @param DB_CouponType $couponType
     * @return Coupon
     */
    public function setCouponType(\DB_CouponType $couponType = null)
    {
        $this->couponType = $couponType;
        return $this;
    }

    /**
     * Get couponType
     *
     * @return DB_CouponType 
     */
    public function getCouponType()
    {
        return $this->couponType;
    }

    /**
     * Set admin
     *
     * @param DB_Admin $admin
     * @return Coupon
     */
    public function setAdmin(\DB_Admin $admin = null)
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * Get admin
     *
     * @return DB_Admin 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set client
     *
     * @param DB_Client $client
     * @return Coupon
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
}