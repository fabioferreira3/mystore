<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OrderComments
 *
 * @Table(name="order_comments")
 * @Entity
 */
class DB_OrderComments
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
     * @var Admin
     *
     * @ManyToOne(targetEntity="DB_Admin")
     * @JoinColumns({
     *   @JoinColumn(name="admin_id", referencedColumnName="id")
     * })
     */
    private $admin;

    /**
     * @var Order
     *
     * @ManyToOne(targetEntity="DB_Order")
     * @JoinColumns({
     *   @JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;

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
     * @return OrderComments
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
     * @param datetime $dateCreate
     * @return OrderComments
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
     * @return OrderComments
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
     * Set admin
     *
     * @param DB_Admin $admin
     * @return OrderComments
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
     * Set order
     *
     * @param DB_Order $order
     * @return OrderComments
     */
    public function setOrder(\DB_Order $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return DB_Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set client
     *
     * @param DB_Client $client
     * @return OrderComments
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