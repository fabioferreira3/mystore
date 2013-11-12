<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductMeta
 *
 * @Table(name="product_meta")
 * @Entity
 */
class DB_ProductMeta
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
     * @var string $metaTitle
     *
     * @Column(name="meta_title", type="string", length=255, nullable=true)
     */
    private $metaTitle;
    
    /**
     * @var string $metaDescription
     *
     * @Column(name="meta_description", type="string", length=255, nullable=true)
     */
    private $metaDescription;
    
    /**
     * @var integer $metaSearch
     *
     * @Column(name="meta_search", type="integer", nullable=true)
     */
    private $metaSearch;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set product
     *
     * @param DB_Product $product
     * @return ProductMeta
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
     * Set meta_title
     *
     * @param string $metaTitle
     * @return ProductMeta
     */
    public function setMetaTitle($metaTitle)
    {
    	$this->metaTitle = $metaTitle;
    	return $this;
    }
    
    /**
     * Get meta_title
     *
     * @return string
     */
    public function getMetaTitle()
    {
    	return $this->metaTitle;
    }
    
    /**
     * Set meta_description
     *
     * @param string $metaDescription
     * @return ProductMeta
     */
    public function setMetaDescription($metaDescription)
    {
    	$this->metaDescription = $metaDescription;
    	return $this;
    }
    
    /**
     * Get meta_description
     *
     * @return string
     */
    public function getMetaDescription()
    {
    	return $this->metaDescription;
    }
    
    /**
     * Set meta_search
     *
     * @param string $metaSearch
     * @return ProductMeta
     */
    public function setMetaSearch($metaSearch)
    {
    	$this->metaSearch = $metaSearch;
    	return $this;
    }
    
    /**
     * Get meta_search
     *
     * @return string
     */
    public function getMetaSearch()
    {
    	return $this->metaSearch;
    }
}