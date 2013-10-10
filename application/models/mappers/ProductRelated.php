<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductRelated
 *
 * @Table(name="product_related")
 * @Entity
 */
class DB_ProductRelated
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
     * @var Product
     *
     * @ManyToOne(targetEntity="DB_Product")
     * @JoinColumns({
     *   @JoinColumn(name="main_product_id", referencedColumnName="id")
     * })
     */
    private $mainProduct;

    /**
     * @var Product
     *
     * @ManyToOne(targetEntity="DB_Product")
     * @JoinColumns({
     *   @JoinColumn(name="related_product_id", referencedColumnName="id")
     * })
     */
    private $relatedProduct;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mainProduct
     *
     * @param DB_Product $mainProduct
     * @return ProductRelated
     */
    public function setMainProduct(\DB_Product $mainProduct = null)
    {
        $this->mainProduct = $mainProduct;
        return $this;
    }

    /**
     * Get mainProduct
     *
     * @return DB_Product 
     */
    public function getMainProduct()
    {
        return $this->mainProduct;
    }

    /**
     * Set relatedProduct
     *
     * @param DB_Product $relatedProduct
     * @return ProductRelated
     */
    public function setRelatedProduct(\DB_Product $relatedProduct = null)
    {
        $this->relatedProduct = $relatedProduct;
        return $this;
    }

    /**
     * Get relatedProduct
     *
     * @return DB_Product 
     */
    public function getRelatedProduct()
    {
        return $this->relatedProduct;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return ProductRelated
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
}