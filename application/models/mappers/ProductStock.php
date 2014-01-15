<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductStock
 *
 * @Table(name="product_stock")
 * @Entity
 */
class DB_ProductStock
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
     * @var Product
     *
     * @OneToOne(targetEntity="DB_Product", inversedBy="stock")
     * @JoinColumns({
     *   @JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;
    
    /**
     * @var integer $currentQty
     *
     * @Column(name="current_qty", type="integer", nullable=true)
     */
    private $currentQty;
    
    /**
     * @var integer $minimumQty
     *
     * @Column(name="minimum_qty", type="integer", nullable=true)
     */
    private $minimumQty;
    
    /**
     * @var integer $availability
     *
     * @Column(name="availability", type="integer", nullable=false)
     */
    private $availability;
    
    /**
     * @var integer $qtyOutOfStock
     *
     * @Column(name="qty_out_of_stock", type="integer", nullable=true)
     */
    private $qtyOutOfStock;
    
    /**
     * @var integer $emailWarning
     *
     * @Column(name="email_warning", type="integer", nullable=true)
     */
    private $emailWarning;
    
    /**
     * @var integer $minimumCartQty
     *
     * @Column(name="minimum_cart_qty", type="integer", nullable=true)
     */
    private $minimumCartQty;
    
    /**
     * @var integer $maximumCartQty
     *
     * @Column(name="maximum_cart_qty", type="integer", nullable=true)
     */
    private $maximumCartQty;
    
    /**
     * @var integer $isDecimal
     *
     * @Column(name="is_decimal", type="integer", nullable=true)
     */
    private $isDecimal;
    
  



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
     * @return ProductStock
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
     * @return ProductStock
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
     * Set current_qty
     *
     * @param integer $currentQty
     * @return ProductStock
     */
    public function setCurrentQty($currentQty)
    {
    	$this->currentQty = $currentQty;
    	return $this;
    }
    
    /**
     * Get current_qty
     *
     * @return integer
     */
    public function getCurrentQty()
    {
    	return $this->currentQty;
    }
    
    /**
     * Set minimum_qty
     *
     * @param integer $minimumQty
     * @return ProductStock
     */
    public function setMinimumQty($minimumQty)
    {
    	$this->minimumQty = $minimumQty;
    	return $this;
    }
    
    /**
     * Get minimum_qty
     *
     * @return integer
     */
    public function getMinimumQty()
    {
    	return $this->minimumQty;
    }
    
    /**
     * Set availability
     *
     * @param integer $availability
     * @return ProductStock
     */
    public function setAvailability($availability)
    {
    	$this->availability = $availability;
    	return $this;
    }
    
    /**
     * Get availability
     *
     * @return integer
     */
    public function getAvailability()
    {
    	return $this->availability;
    }
    
    /**
     * Set qty_out_of_stock
     *
     * @param integer $qtyOutOfStock
     * @return ProductStock
     */
    public function setQtyOutOfStock($qtyOutOfStock)
    {
    	$this->qtyOutOfStock = $qtyOutOfStock;
    	return $this;
    }
    
    /**
     * Get qty_out_of_stock
     *
     * @return integer
     */
    public function getQtyOutOfStock()
    {
    	return $this->qtyOutOfStock;
    }
    
    /**
     * Set email_warning
     *
     * @param integer $emailWarning
     * @return ProductStock
     */
    public function setEmailWarning($emailWarning)
    {
    	$this->emailWarning = $emailWarning;
    	return $this;
    }
    
    /**
     * Get email_warning
     *
     * @return integer
     */
    public function getEmailWarning()
    {
    	return $this->emailWarning;
    }
    
    /**
     * Set minimum_cart_qty
     *
     * @param integer $minimumCartQty
     * @return ProductStock
     */
    public function setMinimumCartQty($minimumCartQty)
    {
    	$this->minimumCartQty = $minimumCartQty;
    	return $this;
    }
    
    /**
     * Get minimum_cart_qty
     *
     * @return integer
     */
    public function getMinimumCartQty()
    {
    	return $this->minimumCartQty;
    }
    
    /**
     * Set maximum_cart_qty
     *
     * @param integer $maximumCartQty
     * @return ProductStock
     */
    public function setMaximumCartQty($maximumCartQty)
    {
    	$this->maximumCartQty = $maximumCartQty;
    	return $this;
    }
    
    /**
     * Get maximum_cart_qty
     *
     * @return integer
     */
    public function getMaximumCartQty()
    {
    	return $this->maximumCartQty;
    }
    
    /**
     * Set is_decimal
     *
     * @param integer $isDecimal
     * @return ProductStock
     */
    public function setDecimal($isDecimal)
    {
    	$this->isDecimal = $isDecimal;
    	return $this;
    }
    
    /**
     * Get is_decimal
     *
     * @return integer
     */
    public function getDecimal()
    {
    	return $this->isDecimal;
    }
    
    public function subQty($productId, $qty){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$stock = $em->getRepository('DB_ProductStock')->findOneByProduct($productId);
    	$currentQty = $stock->getCurrentQty();
    	$newQty = $currentQty - $qty;
    	$stock->setCurrentQty($newQty);
    	$em->persist($stock);
    	$em->flush();
    	
    }
    
    public function sumQty($productId, $qty){
    	
    }

}