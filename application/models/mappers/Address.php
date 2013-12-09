<?php



use Application\Models\Mappers as ORM;

/**
 * Address
 *
 * @Table(name="address")
 * @Entity
 */
class DB_Address
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
     * @var $addressType
     *
     * @ManyToOne(targetEntity="DB_AddressType")
     * @JoinColumns({
     *   @JoinColumn(name="address_type_id", referencedColumnName="id")
     * })
     */
    private $addressType;

    /**
     * @var string $street
     *
     * @Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string $number
     *
     * @Column(name="number", type="string", length=10, nullable=true)
     */
    private $number;
    
    /**
     * @var string $district
     *
     * @Column(name="district", type="string", length=10, nullable=true)
     */
    private $district;

    /**
     * @var string $complement
     *
     * @Column(name="complement", type="string", length=50, nullable=false)
     */
    private $complement;

    /**
     * @var string $zip
     *
     * @Column(name="zip", type="string", length=20, nullable=false)
     */
    private $zip;

    /**
     * @var string $city
     *
     * @Column(name="city", type="string", length=100, nullable=false)
     */
    private $city;

    /**
     * @var State
     *
     * @ManyToOne(targetEntity="DB_State")
     * @JoinColumns({
     *   @JoinColumn(name="state", referencedColumnName="id")
     * })
     */
    private $state;

    /**
     * @var datetime $dateCreate
     *
     * @Column(name="date_create", type="datetime", nullable=false)
     */
    private $dateCreate;

    /**
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=false)
     */
    private $dateUpd;

    /**
     * @var Country
     *
     * @ManyToOne(targetEntity="DB_Country")
     * @JoinColumns({
     *   @JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var Client
     *
     * @ManyToOne(targetEntity="DB_Client", inversedBy="address")
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
     * Set address_type_id
     *
     * @param DB_Country $addressType
     * @return Address
     */
    public function setAddressType(\DB_AddressType $addressType = null)
    {
    	$this->addressType = $addressType;
    	return $this;
    }
    
    /**
     * Get address_type_id
     *
     * @return DB_AddressType
     */
    public function getAddressType()
    {
    	return $this->addressType;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Address
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
     * @return Address
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
     * Set district
     *
     * @param string $district
     * @return Address
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
     * Set zip
     *
     * @param string $zip
     * @return Address
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
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
     * @return Address
     */
    public function setState(\DB_State $state = null)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Address
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
     * @return Address
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
     * Set country
     *
     * @param DB_Country $country
     * @return Address
     */
    public function setCountry(\DB_Country $country = null)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return DB_Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set client
     *
     * @param DB_Client $client
     * @return Address
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
    
    public function checkAddressTypeExist($addressTypeId,$clientId){
        
         $em = Zend_Registry::getInstance()->entitymanager;
         $query = $em->createQueryBuilder()->select('a')->from('DB_Address','a');
         $query->innerjoin('a.client','c','WITH','c.id = :clientId');
         $query->setParameter('clientId',$clientId);
         $data = $query->getQuery()->getResult();
         
         if($data != null){
             return true;
         }else{
             return false;
         }        
    }
    
    public function getAddressByType($addressType, $clientId = null){
        
        $em = Zend_Registry::getInstance()->entitymanager;
        $query = $em->createQueryBuilder()->select('a')->from('DB_Address','a');
        $query->where('a.addressType = :typeId');
        $query->setParameter('typeId',$addressType);        
        if($clientId){
            $query->innerjoin('a.client','c','WITH','c.id = :clientId');
            $query->setParameter('clientId',$clientId);
        }
        
        return $query->getQuery()->getSingleResult();
    }
    
    public function getAddressesByClient($clientId){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$results = $em->getRepository('DB_Address')->findByClient($clientId);
    	
    	$address = $this->AddressToArray($results);
    	
    	return $address;
    	
    }
    
    protected function AddressToArray($object){
    	
    	$address = array();
    	
    	foreach($object as $result){
    		if($result->getAddressType()->getId() == '2'){
    			$address['shipping']['receiver'] = $result->getClient()->getFirstName() . ' ' . $result->getClient()->getLastName();
    			$address['shipping']['address'] = $result->getStreet();
    			$address['shipping']['number'] = $result->getNumber();
    			$address['shipping']['complement'] = $result->getComplement();
    			$address['shipping']['district'] = $result->getDistrict();
    			$address['shipping']['zipcode'] = $result->getZip();
    			$address['shipping']['city'] = $result->getCity();
    			$address['shipping']['state'] = $result->getState()->getId();
    			$address['shipping']['country'] = $result->getCountry()->getId();
    		}else if($result->getAddressType()->getId() == '3'){
    			$address['billing']['receiver'] = $result->getClient()->getFirstName() . ' ' . $result->getClient()->getLastName();
    			$address['billing']['address'] = $result->getStreet();
    			$address['billing']['number'] = $result->getNumber();
    			$address['billing']['complement'] = $result->getComplement();
    			$address['billing']['district'] = $result->getDistrict();
    			$address['billing']['zipcode'] = $result->getZip();
    			$address['billing']['city'] = $result->getCity();
    			$address['billing']['state'] = $result->getState()->getId();
    			$address['billing']['country'] = $result->getCountry()->getId();
    		}
    	}
    	
    	return $address;
    }
}