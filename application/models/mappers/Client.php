<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @Table(name="client")
 * @Entity
 */
class DB_Client
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
     * @var string $firstName
     *
     * @Column(name="first_name", type="string", length=100, nullable=false)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @Column(name="last_name", type="string", length=100, nullable=false)
     */
    private $lastName;
    
    /**
     * @var string $email
     *
     * @Column(name="email", type="string", length=150, nullable=false)
     */
    private $email;
    
    /**
     * @var string $password
     *
     * @Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;
    
    /**
     * @var string $keyConfirm
     *
     * @Column(name="key_confirm", type="string", length=32, nullable=false)
     */
    private $keyConfirm;

    /**
     * @var datetime $dateBirth
     *
     * @Column(name="date_birth", type="datetime", nullable=false)
     */
    private $dateBirth;

    /**
     * @var integer $clientType
     *
     * @Column(name="client_type", type="integer", nullable=true)
     */
    private $clientType;

    /**
     * @var string $cpf
     *
     * @Column(name="cpf", type="string", length=11, nullable=false)
     */
    private $cpf;

    /**
     * @var string $cnpj
     *
     * @Column(name="cnpj", type="string", length=14, nullable=true)
     */
    private $cnpj;

    /**
     * @var boolean $gender
     *
     * @Column(name="gender", type="boolean", nullable=true)
     */
    private $gender;

    /**
     * @var datetime $dateCreate
     *
     * @Column(name="date_create", type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @var datetime $dateUpd
     *
     * @Column(name="date_upd", type="datetime", nullable=false)
     */
    private $dateUpd;

    /**
     * @var datetime $lastLogin
     *
     * @Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;
    
    /**
     * @var integer $status
     *
     * @Column(name="status", type="integer", nullable=true)
     */
    private $status;

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
     * Set firstName
     *
     * @param string $firstName
     * @return Client
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Client
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    
    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
    	$this->email = $email;
    	return $this;
    }
    
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
    	return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Client
     */
    public function setPassword($password)
    {
    	$this->password = $password;
    	return $this;
    }
    
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
    	return $this->password;
    }
    
    /**
     * Set key
     *
     * @param string $keyConfirm
     * @return Client
     */
    public function setKeyConfirm($keyConfirm)
    {
    	$this->keyConfirm = $keyConfirm;
    	return $this;
    }
    
    /**
     * Get keyConfirm
     *
     * @return string
     */
    public function getKeyConfirm()
    {
    	return $this->keyConfirm;
    }
    

    /**
     * Set dateBirth
     *
     * @param datetime $dateBirth
     * @return Client
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;
        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return datetime 
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set clientType
     *
     * @param integer $clientType
     * @return Client
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;
        return $this;
    }

    /**
     * Get clientType
     *
     * @return integer 
     */
    public function getClientType()
    {
        return $this->clientType;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     * @return Client
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set cnpj
     *
     * @param string $cnpj
     * @return Client
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string 
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return Client
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Client
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
     * @return Client
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
     * Set lastLogin
     *
     * @param datetime $lastLogin
     * @return Client
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return datetime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
    
    
    /**
     * Set status
     *
     * @param string $status
     * @return Client
     */
    public function setStatus($status)
    {
    	$this->status = $status;
    	return $this;
    }
    
    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
    	return $this->status;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return Client
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
    
	public function getDataAddress($clientId = null){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$data = $em->createQueryBuilder()->select(array('a','b'))->from('DB_Address','a')->innerjoin('a.client','b','WITH','a.addressType = 1');
    	if($clientId){
    	    $data->where('b.id = :clientId');
            $data->setParameters(array('clientId' => $clientId));
            $result = $data->getQuery()->getResult();
    	}else{
    	    $result = $data->getQuery()->getResult();
    	}
    	return $result; 
    } 
}