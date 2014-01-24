<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductImages
 *
 * @Table(name="product_images")
 * @Entity
 */
class DB_ProductImages
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
     * @var string $name
     *
     * @Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    
    /**
     * @var integer $ordenation
     *
     * @Column(name="ordenation", type="integer", length=2, nullable=true)
     */
    private $ordenation;
    
   /**
     * @var Product
     *
     * @ManyToOne(targetEntity="DB_Product", inversedBy="images")
     * @JoinColumns({
     *   @JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;  
    
    
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
     * Set name
     *
     * @param string $name
     * @return ProductImages
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
     * Set ordenation
     *
     * @param integer $ordenation
     * @return ProductImages
     */
    public function setOrdenation($ordenation)
    {
        $this->ordenation = $ordenation;
        return $this;
    }

    /**
     * Get ordenation
     *
     * @return integer 
     */
    public function getOrdenation()
    {
        return $this->ordenation;
    }
    
    /**
     * Set product
     *
     * @param DB_Product $product
     * @return ProductImages
     */
    public function setProduct(\DB_Product $product = null)
    {
    	$this->product = $product;
    	return $this;
    }
    
    /**
     * Get product
     *
     * @return integer
     */
    public function getProduct()
    {
    	return $this->product;
    }    
    
    /**
     * Set store
     *
     * @param DB_Store $store
     * @return ProductImages
     */
    public function setStore(\DB_Store $store = null)
    {
    	$this->store = $store;
    	return $this;
    }
    
    /**
     * Get store
     *
     * @return integer
     */
    public function getStore()
    {
    	return $this->store;
    }
    
    
    public function getImagesByProduct($imageName = null, $idProduct){
            
        $em = Zend_Registry::getInstance()->entitymanager;
        $data = $em->createQueryBuilder()
                   ->select('a')
                   ->from('DB_ProductImages','a');                                        
                   if($idProduct){
                       $data->where('a.name = :name'); 
                       $data->setParameter('id',$idProduct);
                   }
                   if($imageName){     
                       $data->where('a.name = :name');                                
                       $data->setParameter('name',$imageName);
                   }
                   
        $result = $data->getQuery()->getResult();
        
        
        return $result;        
    }
    
}