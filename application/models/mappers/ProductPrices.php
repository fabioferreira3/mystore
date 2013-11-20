<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPrices
 *
 * @Table(name="product_prices")
 * @Entity
 */
class DB_ProductPrices
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
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=true)
     */
    private $dateUpd;

    /**
     * @var Product
     *
     * @OneToOne(targetEntity="DB_Product", inversedBy="price")
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
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return ProductPrices
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
     * @return ProductPrices
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
     * Set product
     *
     * @param DB_Product $product
     * @return ProductPrices
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
     * @return ProductPrices
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