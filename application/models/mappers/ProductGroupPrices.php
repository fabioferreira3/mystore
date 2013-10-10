<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductGroupPrices
 *
 * @Table(name="product_group_prices")
 * @Entity
 */
class DB_ProductGroupPrices
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
     * @var integer $dateFrom
     *
     * @Column(name="date_from", type="integer", nullable=false)
     */
    private $dateFrom;

    /**
     * @var integer $dateTo
     *
     * @Column(name="date_to", type="integer", nullable=false)
     */
    private $dateTo;

    /**
     * @var integer $dateCreate
     *
     * @Column(name="date_create", type="integer", nullable=false)
     */
    private $dateCreate;

    /**
     * @var integer $dateUpd
     *
     * @Column(name="date_upd", type="integer", nullable=false)
     */
    private $dateUpd;

    /**
     * @var ProductPrices
     *
     * @ManyToOne(targetEntity="DB_ProductPrices")
     * @JoinColumns({
     *   @JoinColumn(name="price_id", referencedColumnName="id")
     * })
     */
    private $price;

    /**
     * @var ClientGroupTypes
     *
     * @ManyToOne(targetEntity="DB_ClientGroupTypes")
     * @JoinColumns({
     *   @JoinColumn(name="group_client_id", referencedColumnName="id")
     * })
     */
    private $groupClient;



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
     * Set dateFrom
     *
     * @param integer $dateFrom
     * @return ProductGroupPrices
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return integer 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param integer $dateTo
     * @return ProductGroupPrices
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * Get dateTo
     *
     * @return integer 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set dateCreate
     *
     * @param integer $dateCreate
     * @return ProductGroupPrices
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return integer 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateUpd
     *
     * @param integer $dateUpd
     * @return ProductGroupPrices
     */
    public function setDateUpd($dateUpd)
    {
        $this->dateUpd = $dateUpd;
        return $this;
    }

    /**
     * Get dateUpd
     *
     * @return integer 
     */
    public function getDateUpd()
    {
        return $this->dateUpd;
    }

    /**
     * Set price
     *
     * @param DB_ProductPrices $price
     * @return ProductGroupPrices
     */
    public function setPrice(\DB_ProductPrices $price = null)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return DB_ProductPrices 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set groupClient
     *
     * @param DB_ClientGroupTypes $groupClient
     * @return ProductGroupPrices
     */
    public function setGroupClient(\DB_ClientGroupTypes $groupClient = null)
    {
        $this->groupClient = $groupClient;
        return $this;
    }

    /**
     * Get groupClient
     *
     * @return DB_ClientGroupTypes 
     */
    public function getGroupClient()
    {
        return $this->groupClient;
    }
}