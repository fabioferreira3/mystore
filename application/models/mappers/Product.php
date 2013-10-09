<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @Table(name="product")
 * @Entity
 */
class DB_Product
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
     * @var string $sku
     *
     * @Column(name="sku", type="string", length=50, nullable=true)
     */
    private $sku;

    /**
     * @var string $desc1
     *
     * @Column(name="desc1", type="string", length=255, nullable=true)
     */
    private $desc1;

    /**
     * @var text $desc2
     *
     * @Column(name="desc2", type="text", nullable=true)
     */
    private $desc2;

    /**
     * @var string $weight
     *
     * @Column(name="weight", type="string", length=10, nullable=true)
     */
    private $weight;

    /**
     * @var string $height
     *
     * @Column(name="height", type="string", length=10, nullable=true)
     */
    private $height;

    /**
     * @var string $length
     *
     * @Column(name="length", type="string", length=10, nullable=true)
     */
    private $length;

    /**
     * @var string $thickness
     *
     * @Column(name="thickness", type="string", length=10, nullable=true)
     */
    private $thickness;

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
     * @var string $width
     *
     * @Column(name="width", type="string", length=10, nullable=true)
     */
    private $width;

    /**
     * @var string $slug
     *
     * @Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

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
     * @var ProductType
     *
     * @ManyToOne(targetEntity="DB_ProductType")
     * @JoinColumns({
     *   @JoinColumn(name="product_type_id", referencedColumnName="id")
     * })
     */
    private $productType;

    /**
     * @var ProductConditions
     *
     * @ManyToOne(targetEntity="DB_ProductConditions")
     * @JoinColumns({
     *   @JoinColumn(name="condition_id", referencedColumnName="id")
     * })
     */
    private $condition;



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
     * @return Product
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
     * Set sku
     *
     * @param string $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * Get sku
     *
     * @return string 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set desc1
     *
     * @param string $desc1
     * @return Product
     */
    public function setDesc1($desc1)
    {
        $this->desc1 = $desc1;
        return $this;
    }

    /**
     * Get desc1
     *
     * @return string 
     */
    public function getDesc1()
    {
        return $this->desc1;
    }

    /**
     * Set desc2
     *
     * @param text $desc2
     * @return Product
     */
    public function setDesc2($desc2)
    {
        $this->desc2 = $desc2;
        return $this;
    }

    /**
     * Get desc2
     *
     * @return text 
     */
    public function getDesc2()
    {
        return $this->desc2;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return Product
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Get height
     *
     * @return string 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Product
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set thickness
     *
     * @param string $thickness
     * @return Product
     */
    public function setThickness($thickness)
    {
        $this->thickness = $thickness;
        return $this;
    }

    /**
     * Get thickness
     *
     * @return string 
     */
    public function getThickness()
    {
        return $this->thickness;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Product
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
     * @return Product
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
     * Set width
     *
     * @param string $width
     * @return Product
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return Product
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
     * Set productType
     *
     * @param DB_ProductType $productType
     * @return Product
     */
    public function setProductType(\DB_ProductType $productType = null)
    {
        $this->productType = $productType;
        return $this;
    }

    /**
     * Get productType
     *
     * @return DB_ProductType 
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set condition
     *
     * @param DB_ProductConditions $condition
     * @return Product
     */
    public function setCondition(\DB_ProductConditions $condition = null)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * Get condition
     *
     * @return DB_ProductConditions 
     */
    public function getCondition()
    {
        return $this->condition;
    }
}