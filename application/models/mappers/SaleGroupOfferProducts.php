<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * SaleGroupOfferProducts
 *
 * @Table(name="sale_group_offer_products")
 * @Entity
 */
class DB_SaleGroupOfferProducts
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
     * @var Store
     *
     * @ManyToOne(targetEntity="DB_Store")
     * @JoinColumns({
     *   @JoinColumn(name="store_id", referencedColumnName="id")
     * })
     */
    private $store;

    /**
     * @var SaleGroupOffer
     *
     * @ManyToOne(targetEntity="DB_SaleGroupOffer")
     * @JoinColumns({
     *   @JoinColumn(name="sale_group_offer_id", referencedColumnName="id")
     * })
     */
    private $saleGroupOffer;

    /**
     * @var Product
     *
     * @ManyToOne(targetEntity="DB_Product")
     * @JoinColumns({
     *   @JoinColumn(name="product1_id", referencedColumnName="id")
     * })
     */
    private $product1;

    /**
     * @var Product
     *
     * @ManyToOne(targetEntity="DB_Product")
     * @JoinColumns({
     *   @JoinColumn(name="product2_id", referencedColumnName="id")
     * })
     */
    private $product2;



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
     * Set store
     *
     * @param DB_Store $store
     * @return SaleGroupOfferProducts
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
     * Set saleGroupOffer
     *
     * @param DB_SaleGroupOffer $saleGroupOffer
     * @return SaleGroupOfferProducts
     */
    public function setSaleGroupOffer(\DB_SaleGroupOffer $saleGroupOffer = null)
    {
        $this->saleGroupOffer = $saleGroupOffer;
        return $this;
    }

    /**
     * Get saleGroupOffer
     *
     * @return DB_SaleGroupOffer 
     */
    public function getSaleGroupOffer()
    {
        return $this->saleGroupOffer;
    }

    /**
     * Set product1
     *
     * @param DB_Product $product1
     * @return SaleGroupOfferProducts
     */
    public function setProduct1(\DB_Product $product1 = null)
    {
        $this->product1 = $product1;
        return $this;
    }

    /**
     * Get product1
     *
     * @return DB_Product 
     */
    public function getProduct1()
    {
        return $this->product1;
    }

    /**
     * Set product2
     *
     * @param DB_Product $product2
     * @return SaleGroupOfferProducts
     */
    public function setProduct2(\DB_Product $product2 = null)
    {
        $this->product2 = $product2;
        return $this;
    }

    /**
     * Get product2
     *
     * @return DB_Product 
     */
    public function getProduct2()
    {
        return $this->product2;
    }
}