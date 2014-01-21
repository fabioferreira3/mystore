<?php


use Doctrine\ORM\Mapping as ORM;

/**
 * ShippingTracking
 *
 * @Table(name="shipping_tracking")
 * @Entity
 */
class DB_ShippingTracking
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
     * @var Shipping
     *
     * @ManyToOne(targetEntity="DB_Shipping")
     * @JoinColumns({
     *   @JoinColumn(name="shipping_id", referencedColumnName="id")
     * })
     */
    private $shipping;
    
    /**
     * @var ShippingType
     *
     * @ManyToOne(targetEntity="DB_ShippingType")
     * @JoinColumns({
     *   @JoinColumn(name="shipping_type_id", referencedColumnName="id")
     * })
     */
    private $shippingType;
    
    /**
     * @var string $trackingNumber
     *
     * @Column(name="tracking_number", type="string", nullable=true)
     */
    private $trackingNumber;

  
    /**
     * @var datetime $dateCreate
     *
     * @Column(name="date_create", type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=true)
     */
    private $dateUpd;    
     
    
    
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
     * Set shipping
     *
     * @param DB_Shipping $shipping
     * @return ShippingTracking
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
     * Set shippingType
     *
     * @param DB_ShippingType $shippingType
     * @return ShippingTracking
     */
    public function setShippingType(\DB_ShippingType $shippingType = null)
    {
    	$this->shippingType = $shippingType;
    	return $this;
    }
    
    /**
     * Get shippingType
     *
     * @return DB_ShippingType
     */
    public function getShippingType()
    {
    	return $this->shippingType;
    }

    /**
     * Set trackingNumber
     *
     * @param string $trackingNumber
     * @return ShippingTracking
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * Get trackingNumber
     *
     * @return string 
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }    

    
    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Shipping
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
     * @return Shipping
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
    
    
   

   

   }