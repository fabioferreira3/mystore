<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPriceRange
 *
 * @Table(name="product_promotion")
 * @Entity
 */
class DB_ProductPriceRange
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
     * @var datetime $dateCreate
     *
     * @Column(name="date_create", type="datetime", nullable=false)
     */
    private $dateCreate;

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
     * @var datetime $price
     *
     * @Column(name="price", type="string", nullable=false)
     */
    private $price;
    
    /**
     * @var integer $qty_from
     *
     * @Column(name="qty_from", type="integer", nullable=false)
     */
    private $qtyFrom;
    
    /**
     * @var integer $qty_to
     *
     * @Column(name="qty_to", type="integer", nullable=false)
     */
    private $qtyTo;



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
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return ProductPriceRange
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
     * Set product
     *
     * @param DB_Product $product
     * @return ProductPriceRange
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
     * Get price
     *
     * @return DB_Product
     */
    public function getPrice()
    {
    	return $this->price;
    }
    
    /**
     * Set price
     *
     * @param string $price
     * @return ProductPriceRange
     */
    public function setPrice($price)
    {
    	$this->price = $price;
    	return $this;
    }
    
    /**
     * Get qtyFrom
     *
     * @return string
     */
    public function getQtyFrom()
    {
    	return $this->qtyFrom;
    }
    
    /**
     * Set qtyFrom
     *
     * @param integer $qty_from
     * @return ProductPriceRange
     */
    public function setQtyFrom($qtyFrom)
    {
    	$this->qtyFrom = $qtyFrom;
    	return $this;
    }
    
    /**
     * Get qtyTo
     *
     * @return string
     */
    public function getQtyTo()
    {
    	return $this->qtyTo;
    }
    
    /**
     * Set qtyTo
     *
     * @param integer $qty_to
     * @return ProductPriceRange
     */
    public function setQtyTo($qtyTo)
    {
    	$this->qtyTo = $qtyTo;
    	return $this;
    }  
    
}