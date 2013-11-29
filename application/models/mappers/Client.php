<?php



use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator as Paginator;

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
     * @var $address
     *
     * @OneToMany(targetEntity="DB_Address", mappedBy="client")
     */
    private $address;

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
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
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
    
    public function getClient($perPage = null,$currentPage = null,$clientId = null){
        
        if(!$perPage){
            $perPage = 1000;
        }
        if(!$currentPage){
            $currentPage = 1;
        }
        
        $em = Zend_Registry::getInstance()->entitymanager;
        $query = $em->createQueryBuilder()->select('c')->from('DB_Client','c');
        if($clientId){
            $query->where('c.id = :clientId');
            $query->setParameter('clientId',$clientId);
        }        
        $query->orderBy('c.id','DESC');
        
        $paginator = new Paginator($query);         
        $paginator_iter = $paginator->getIterator();        
        $adapter =  new \Zend_Paginator_Adapter_Iterator($paginator_iter);        
        $data = new \Zend_Paginator($adapter);        
        $data->setItemCountPerPage($perPage)->setCurrentPageNumber($currentPage);
        
        return $data;
    }
    
    public function addOrUpdate($params,$clientId, $address = false){
        
        $em = Zend_Registry::getInstance()->entitymanager;
            if($clientId){
                $tbClient = $em->getRepository('DB_Client')->find($clientId);
                $tbClient->setFirstName($params['name']);
                $tbClient->setLastName($params['lastname']);
                $tbClient->setCpf($params['cpf']);
                $birth = new DateTime(str_replace('/', '-',$params['birth']));
                $tbClient->setDateBirth($birth);
                $tbClient->setGender($params['gender']);
                $tbClient->setEmail($params['email']);
                if($params['password'] != ''){
                    $tbClient->setPassword(hash('sha256',$params['password']));
                } 
            }else{
               
                $checkEmail = $em->getRepository('DB_Client')->findOneByEmail($params['email']);
                
                // Se cliente for pessoa física (CPF)
                if (isset($params['cpf']) && $params['cpf'] != ''){
                    $cpf = str_replace(array('.','-'),'',$params['cpf']);
                    $checkCpf = $em->getRepository('DB_Client')->findOneByCpf($cpf);
                }
                
                // Se cliente for pessoa jurídica (CNPJ)
                if (isset($params['cnpj']) && $params['cnpj'] != ''){
                    $cnpj = str_replace(array('.','-','/'),'',$params['cnpj']);
                    $checkCnpj = $em->getRepository('DB_Client')->findOneByCnpj($cnpj);
                }
                
                if ($checkEmail == NULL && $checkCpf == NULL){                    
                
                    $tbClient = new DB_Client();
                    $tbClient->setFirstName($params['name']);
                    $tbClient->setLastName($params['lastname']);
                    $tbClient->setCpf($params['cpf']);
                    $birth = new DateTime(str_replace('/', '-',$params['birth']));
                    $dtNow = new DateTime();
                    $tbClient->setDateBirth($birth);
                    $tbClient->setClientType('1');
                    $tbClient->setGender($params['gender']);
                    $tbClient->setEmail($params['email']);
                    if($params['password'] != ''){
                        $tbClient->setPassword(hash('sha256',$params['password']));
                    }
                    $tbClient->setKeyConfirm(md5(rand(5,15)));
                    $tbClient->setDateCreate($dtNow);
                    $tbClient->setDateUpd($dtNow);                  
                    $tbClient->setStatus('0'); 
                    $currentStore = $em->getRepository('DB_Store')->findOneById('1');
                    $tbClient->setStore($currentStore);                   
                }else{
                    Zend_Controller_Action_HelperBroker::getStaticHelper('flashMessenger')->addMessage('Já existe um usuário com este Email e/ou CPF/CNPJ','error');
                    return false;
                }

            } 
                $em->persist($tbClient);
            
                if($address){
                    $tbAddress = new DB_Address(); 
                    if($clientId){
                        $billingAddress = $tbAddress->checkAddressTypeExist(3,$clientId);
                    }else{
                        $billingAddress = false;
                    }                   
                
                    if($billingAddress != false){
                        $billingAddress = $tbAddress->getAddressByType(3,$clientId);
                        $billingAddress->setStreet($params['billingaddress']);
                        $billingAddress->setNumber($params['billingnumber']);
                        $billingAddress->setComplement($params['billingcomplement']);
                        $billingAddress->setDistrict($params['billingdistrict']);
                        $billingCountry = $em->getRepository('DB_Country')->find($params['billingcountry']);
                        $billingAddress->setCountry($billingCountry);
                        $billingState = $em->getRepository('DB_State')->find($params['billingstate']);
                        $billingAddress->setState($billingState);
                        $billingAddress->setCity($params['billingcity']);
                        $em->persist($billingAddress);
                    }else{
                        if(isset($params['billingstate']) && $params['billingstate'] != ''){
                            $billingAddress = new DB_Address();
                            $billingAddress->setStreet($params['billingaddress']);
                            $billingAddress->setNumber($params['billingnumber']);
                            $billingAddress->setComplement($params['billingcomplement']);
                            $billingAddress->setDistrict($params['billingdistrict']);
                            $billingAddress->setZip($params['billingzip']);
                            $billingCountry = $em->getRepository('DB_Country')->find($params['billingcountry']);
                            $billingAddress->setCountry($billingCountry);
                            $billingState = $em->getRepository('DB_State')->find($params['billingstate']);
                            $billingAddress->setState($billingState);
                            $billingAddress->setCity($params['billingcity']);
                            $addressType = $em->getRepository('DB_AddressType')->find(3);
                            $billingAddress->setAddressType($addressType);
                            $billingAddress->setClient($tbClient);
                            $dtNow = new DateTime();
                            $billingAddress->setDateCreate($dtNow);
                            $em->persist($billingAddress);
                        }
                    }
                    
                    if($clientId){
                        $shippingAddress = $tbAddress->checkAddressTypeExist(2,$clientId);
                    }else{
                        $shippingAddress = false;
                    }            
            
                    if($shippingAddress != false){
                        $shippingAddress = $tbAddress->getAddressByType(2,$clientId);
                        $shippingAddress->setStreet($params['shippingaddress']);
                        $shippingAddress->setNumber($params['shippingnumber']);
                        $shippingAddress->setComplement($params['shippingcomplement']);
                        $shippingAddress->setDistrict($params['shippingdistrict']);
                        $shippingCountry = $em->getRepository('DB_Country')->find($params['shippingcountry']);
                        $shippingAddress->setCountry($billingCountry);
                        $shippingState = $em->getRepository('DB_State')->find($params['shippingstate']);
                        $shippingAddress->setState($shippingState);
                        $shippingAddress->setCity($params['shippingcity']);
                        $em->persist($shippingAddress);                         
                    }else{
                        if(isset($params['shippingstate']) && $params['shippingstate'] != ''){
                            $shippingAddress = new DB_Address();
                            $shippingAddress->setStreet($params['shippingaddress']);
                            $shippingAddress->setNumber($params['shippingnumber']);
                            $shippingAddress->setComplement($params['shippingcomplement']);
                            $shippingAddress->setDistrict($params['shippingdistrict']);
                            $shippingAddress->setZip($params['shippingzip']);
                            $shippingCountry = $em->getRepository('DB_Country')->find($params['shippingcountry']);
                            $shippingAddress->setCountry($shippingCountry);
                            $shippingState = $em->getRepository('DB_State')->find($params['shippingstate']);
                            $shippingAddress->setState($shippingState);
                            $shippingAddress->setCity($params['shippingcity']);
                            $addressType = $em->getRepository('DB_AddressType')->find(2);
                            $shippingAddress->setAddressType($addressType);
                            $shippingAddress->setClient($tbClient);
                            $dtNow = new DateTime();
                            $shippingAddress->setDateCreate($dtNow);                            
                            $em->persist($shippingAddress); 
                        }
                    }                  
            }
            $em->flush();
            Zend_Controller_Action_HelperBroker::getStaticHelper('flashMessenger')->addMessage('Cliente cadastrado com sucesso!','success');
            return true;      
    }
    
    public function getClientsByFilter(array $params){
    	
    	$perPage = 1000;
    	$currentPage = 1;
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$query = $em->createQueryBuilder()->select('c')->from('DB_Client','c');
    	$query->innerjoin('c.address','ad','WITH','c.id = ad.client');
    	
    	if(isset($params['status']) && $params['status']){
    		$query->where('c.status = :status');
    		$query->setParameter('status',$params['status']);
    	}
    	if(isset($params['id']) && $params['id']){
    		$query->andWhere('c.id  :id');
    		$query->setParameter('id',$params['id']);
    	}
    	if(isset($params['name']) && $params['name']){
    		$query->andWhere('c.firstName LIKE :name');
    		$query->orWhere('c.lastName LIKE :name');
    		$query->setParameter('name','%'.$params['name'].'%');
    	}
    	if(isset($params['email']) && $params['email']){
    		$query->andWhere('c.email LIKE :email');
    		$query->setParameter('email','%'.$params['email'].'%');
    	}
    	if(isset($params['state']) && $params['state']){
    		$query->innerjoin('ad.state','st','WITH','st.name LIKE :state');
    		$query->setParameter('state','%'.$params['state'].'%');
    	}
    	if(isset($params['country']) && $params['country']){
    		$query->innerjoin('ad.country','ct','WITH','ct.name LIKE :country');
    		$query->setParameter('country','%'.$params['country'].'%');
    	}
    	if(isset($params['dateSince']) && $params['dateSince']){ 
    		$dateSince = str_replace('/','-',$params['dateSince']); 
    		$dateSince = new DateTime($dateSince);  		
    		$query->andWhere('c.dateCreate >= :dateSince');
    		$query->setParameter('dateSince',$dateSince->format('Y-m-d'));
    	}
    	if(isset($params['lastLogin']) && $params['lastLogin']){
    		$lastLogin = str_replace('/','-',$params['lastLogin']);
    		$lastLogin = new DateTime($lastLogin);
    		$query->andWhere('c.lastLogin >= :lastLogin');
    		$query->setParameter('lastLogin',$lastLogin->format('Y-m-d'));
    	}
    	
    	$paginator = new Paginator($query);
    	$paginator_iter = $paginator->getIterator();
    	$adapter =  new \Zend_Paginator_Adapter_Iterator($paginator_iter);
    	$data = new \Zend_Paginator($adapter);
    	$data->setItemCountPerPage($perPage)->setCurrentPageNumber($currentPage);
    	
    	return $data;
    }
    
    public function generateTable($data,array $conditions = null){
    	
    	if(isset($conditions['dates']) && $conditions['dates'] === false){
    		$condDates = false;
    	}else{
    		$condDates = true;
    	}
    	if(isset($conditions['selectType']) && $conditions['selectType'] === 'radio'){
    		$condSelect = 'radio';
    	}else{
    		$condSelect = 'checkbox';
    	}
    	if(isset($conditions['status']) && $conditions['status'] === false){
    		$condStatus = false;
    	}else{
    		$condStatus = true;
    	}
    	if(isset($conditions['actions']) && $conditions['actions'] === false){
    		$condActions = false;
    	}else{
    		$condActions = true;
    	}
    	$html = '';
    	    	
    	if($data){
    		foreach($data as $row){
    			if($row->getStatus() == 0){$status = 'Inativo';}else{$status = 'Ativo';}
    			if($row->getLastLogin() !== null){$lastLogin = $row->getLastLogin()->format('d/m/Y');}else{$lastLogin = '';}
    			$html.='<tr>';
    			$html.='<td><input type="'.$condSelect.'" name="row_sel" class="row_sel" /></td>';
    			$html.='<td>'. $row->getFirstName() . ' ' . $row->getLastName() .'</td>';
    			$html.='<td>'. $row->getEmail() .'</td>';
    			$html.='<td>'. $row->getAddress()[0]->getState()->getName() .'</td>';
    			$html.='<td>'. $row->getAddress()[0]->getCountry()->getName() .'</td>';
    			if($condDates){
    				$html.='<td>'. $row->getDateCreate()->format('d/m/Y') .'</td>';
    				$html.='<td>'. $lastLogin .'</td>';
    			}
    			if($condStatus){
    				$html.='<td>' . $status .'</td>';
    			}    
    			if($condActions){			
	    			$html.='<td>
	           		 		<a href="/admin238/customer/edit/id/'. $row->getId() .'" class="sepV_a" title="Editar">
	           		 				<i class="icon-pencil"></i>           		 		</a>';
	    			if($row->getStatus() != 0){$html.='<a href="/admin238/customer/disable/id/'. $row->getId() .'" title="Desativar">
	                            <i class="splashy-gem_remove"></i>
	                        </a>';}else{
	    	                        $html.=' <a href="/admin238/customer/enable/id/'. $row->getId() .'" title="Ativar">
	                            <i class="splashy-okay"></i>
	                        </a>';
	    			}
    			}
    			$html.='</td>';
    			$html.= "</tr>";
    		}
    	}
    	
    	return $html;
    	
    }
     
    
}