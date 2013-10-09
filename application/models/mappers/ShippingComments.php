<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ShippingComments
 *
 * @Table(name="shipping_comments")
 * @Entity
 */
class DB_ShippingComments
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
     * @var text $comment
     *
     * @Column(name="comment", type="text", nullable=false)
     */
    private $comment;

    /**
     * @var integer $dateCreate
     *
     * @Column(name="date_create", type="integer", nullable=false)
     */
    private $dateCreate;

    /**
     * @var integer $dateUpd
     *
     * @Column(name="date_upd", type="integer", nullable=true)
     */
    private $dateUpd;

    /**
     * @var Admin
     *
     * @ManyToOne(targetEntity="DB_Admin")
     * @JoinColumns({
     *   @JoinColumn(name="admin_id", referencedColumnName="id")
     * })
     */
    private $admin;

    /**
     * @var Shipping
     *
     * @ManyToOne(targetEntity="DB_Shipping")
     * @JoinColumns({
     *   @JoinColumn(name="shipping_id", referencedColumnName="id")
     * })
     */
    private $shipping;

    /**
     * @var Client
     *
     * @ManyToOne(targetEntity="DB_Client")
     * @JoinColumns({
     *   @JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;



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
     * Set comment
     *
     * @param text $comment
     * @return ShippingComments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set dateCreate
     *
     * @param integer $dateCreate
     * @return ShippingComments
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
     * @return ShippingComments
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
     * Set admin
     *
     * @param DB_Admin $admin
     * @return ShippingComments
     */
    public function setAdmin(\DB_Admin $admin = null)
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * Get admin
     *
     * @return DB_Admin 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set shipping
     *
     * @param DB_Shipping $shipping
     * @return ShippingComments
     */
    public function setShipping(\DB_Shipping $shipping = null)
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * Get shipping
     *
     * @return DB_Shipping 
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set client
     *
     * @param DB_Client $client
     * @return ShippingComments
     */
    public function setClient(\DB_Client $client = null)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get client
     *
     * @return DB_Client 
     */
    public function getClient()
    {
        return $this->client;
    }
}