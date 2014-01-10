<?php



use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator as Paginator;

/**
 * OrderAddresses
 *
 * @Table(name="order_addresses")
 * @Entity
 */
class DB_OrderAddresses
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
     * @var integer $order
     *
     * @ManyToOne(targetEntity="DB_Orders")
     * @JoinColumns({
     *   @JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;
    
    /**
     * @var integer $addressType
     *
     * @ManyToOne(targetEntity="DB_AddressType")
     * @JoinColumns({
     *   @JoinColumn(name="address_type_id", referencedColumnName="id")
     * })
     */
    private $addressType;
    
    /**
     * @var string $name
     *
     * @Column(name="name", type="string", nullable=true)
     */
    private $name;
    
     /**
     * @var string $address
     *
     * @Column(name="address", type="string", nullable=true)
     */
    private $address;
    
    /**
     * @var string $number
     *
     * @Column(name="number", type="string", nullable=true)
     */
    private $number;
    
    /**
     * @var string $complement
     *
     * @Column(name="complement", type="string", nullable=true)
     */
    private $complement;
    
    /**
     * @var string $zipcode
     *
     * @Column(name="zipcode", type="string", nullable=true)
     */
    private $zipcode;
    
    /**
     * @var string $city
     *
     * @Column(name="city", type="string", nullable=true)
     */
    private $city;
    
    /**
     * @var string $district
     *
     * @Column(name="district", type="string", nullable=true)
     */
    private $district;
    
    /**
     * @var integer $state
     *
     * @ManyToOne(targetEntity="DB_State")
     * @JoinColumns({
     *   @JoinColumn(name="state", referencedColumnName="id")
     * })
     */
    private $state;
    
    /**
     * @var integer $country
     *
     * @ManyToOne(targetEntity="DB_Country")
     * @JoinColumns({
     *   @JoinColumn(name="country", referencedColumnName="id")
     * })
     */
    private $country;
    
    /**
     * Set order
     *
     * @param DB_Orders $order
     * @return OrderAddresses
     */
    public function setOrder(\DB_Orders $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return DB_OrderAddresses 
     */
    public function getOrder()
    {
        return $this->order;
    }
    
    /**
     * Set addressType
     *
     * @param DB_AddressType $addressType
     * @return OrderAddresses
     */
    public function setAddressType(\DB_AddressType $addressType = null)
    {
        $this->addressType = $addressType;
        return $this;
    }

    /**
     * Get addressType
     *
     * @return DB_OrderAddresses 
     */
    public function getAddressType()
    {
        return $this->addressType;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return OrderAddresses
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set address
     *
     * @param string $address
     * @return OrderAddresses
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Set number
     *
     * @param string $number
     * @return OrderAddresses
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }
    
    /**
     * Set complement
     *
     * @param string $complement
     * @return OrderAddresses
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * Get complement
     *
     * @return string 
     */
    public function getComplement()
    {
        return $this->complement;
    }
    
    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return OrderAddresses
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }
    
    /**
     * Set district
     *
     * @param string $district
     * @return OrderAddresses
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * Get district
     *
     * @return string 
     */
    public function getDistrict()
    {
        return $this->district;
    }
    
    /**
     * Set city
     *
     * @param string $city
     * @return OrderAddresses
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * Set state
     *
     * @param DB_State $state
     * @return OrderAddresses
     */
    public function setState(\DB_State $state = null)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return DB_OrderAddresses 
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * Set country
     *
     * @param DB_Country $country
     * @return OrderAddresses
     */
    public function setCountry(\DB_Country $country = null)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return DB_OrderAddresses 
     */
    public function getCountry()
    {
        return $this->country;
    }

}