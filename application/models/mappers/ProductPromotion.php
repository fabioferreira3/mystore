<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPromotion
 *
 * @Table(name="product_promotion")
 * @Entity
 */
class DB_ProductPromotion
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
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=true)
     */
    private $dateUpd;
    
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Set dateUpd
     *
     * @param datetime $dateUpd
     * @return ProductPromotion
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
     * Set dateFrom
     *
     * @param datetime $dateFrom
     * @return ProductPromotion
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
     * @return ProductPromotion
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
     * Set product
     *
     * @param DB_Product $product
     * @return ProductPromotion
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
     * Set price
     *
     * @param string $price
     * @return ProductPromotion
     */
    public function setPrice($price)
    {
    	$this->price = $price;
    	return $this;
    }
    
    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
    	return $this->price;
    }

}