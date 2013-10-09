<?php



use Doctrine\Mapping as ORM;

/**
 * ProductAttributesValue
 *
 * @Table(name="product_attributes_value")
 * @Entity
 */
class ProductAttributesValue
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
     * @var string $value
     *
     * @Column(name="value", type="string", length=50, nullable=false)
     */
    private $value;

    /**
     * @var ProductAttributes
     *
     * @ManyToOne(targetEntity="ProductAttributes")
     * @JoinColumns({
     *   @JoinColumn(name="product_attribute_id", referencedColumnName="id")
     * })
     */
    private $productAttribute;

    /**
     * @var Product
     *
     * @ManyToOne(targetEntity="Product")
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
     * Set value
     *
     * @param string $value
     * @return ProductAttributesValue
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
     * Set productAttribute
     *
     * @param ProductAttributes $productAttribute
     * @return ProductAttributesValue
     */
    public function setProductAttribute(\ProductAttributes $productAttribute = null)
    {
        $this->productAttribute = $productAttribute;
        return $this;
    }

    /**
     * Get productAttribute
     *
     * @return ProductAttributes 
     */
    public function getProductAttribute()
    {
        return $this->productAttribute;
    }

    /**
     * Set product
     *
     * @param Product $product
     * @return ProductAttributesValue
     */
    public function setProduct(\Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}