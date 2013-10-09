<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * SaleDiscountOffer
 *
 * @Table(name="sale_discount_offer")
 * @Entity
 */
class DB_SaleDiscountOffer
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
     * @var string $name
     *
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string $valueType
     *
     * @Column(name="value_type", type="string", length=50, nullable=false)
     */
    private $valueType;

    /**
     * @var string $value
     *
     * @Column(name="value", type="string", length=50, nullable=false)
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
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=true)
     */
    private $dateUpd;

    /**
     * @var boolean $status
     *
     * @Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var string $shortName
     *
     * @Column(name="short_name", type="string", length=30, nullable=true)
     */
    private $shortName;

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
     * @var Product
     *
     * @ManyToOne(targetEntity="DB_Product")
     * @JoinColumns({
     *   @JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var Category
     *
     * @ManyToOne(targetEntity="DB_Category")
     * @JoinColumns({
     *   @JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SaleDiscountOffer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set valueType
     *
     * @param string $valueType
     * @return SaleDiscountOffer
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;
        return $this;
    }

    /**
     * Get valueType
     *
     * @return string 
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return SaleDiscountOffer
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

    /**
     * Set dateFrom
     *
     * @param datetime $dateFrom
     * @return SaleDiscountOffer
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
     * @return SaleDiscountOffer
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
     * @return SaleDiscountOffer
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
     * @return SaleDiscountOffer
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
     * @param boolean $status
     * @return SaleDiscountOffer
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
     * Set shortName
     *
     * @param string $shortName
     * @return SaleDiscountOffer
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return SaleDiscountOffer
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
     * Set product
     *
     * @param DB_Product $product
     * @return SaleDiscountOffer
     */
    public function setProduct(\DB_Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return DB_Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set category
     *
     * @param DB_Category $category
     * @return SaleDiscountOffer
     */
    public function setCategory(\DB_Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return DB_Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set admin
     *
     * @param DB_Admin $admin
     * @return SaleDiscountOffer
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
}