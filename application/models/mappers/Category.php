<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @Table(name="category")
 * @Entity
 */
class DB_Category
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
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string $slug
     *
     * @Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var integer $parentId
     *
     * @Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

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
     * @return Category
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
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set parent
     *
     * @param integer $parentId
     * @return Category
     */
    public function setParent($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parentId;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Category
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
     * @return Category
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
     * Set store
     *
     * @param DB_Store $store
     * @return Category
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
    
    public function getCategoryName($categoryId){
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$category =  $em->getRepository('DB_Category')->find($categoryId);
    	if($category != null){
    		return $category->getName();
    	}else{
    		return false;
    	}
    }
    
    public function getAllDependencies(){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$tbCategory = $em->getRepository('DB_Category');
    	$categories = $tbCategory->findAll();
    	$a = 0; $b = 0; $c = 0;
    	foreach ($categories as $category){
    		if ($category->getParent() == '0' || $category->getParent() == null){
    			$rootNodes[$a]['id'] = $category->getId();
    			$rootNodes[$a]['name'] = $category->getName();
    			if ($childNodes = $tbCategory->findByParentId($rootNodes[$a]['id'])){
    				foreach($childNodes as $childNode){
    					$rootNodes[$a][$b]['id'] = $childNode->getId();
    					$rootNodes[$a][$b]['name'] = $childNode->getName();    	
    					if($grandNodes = $tbCategory->findByParentId($rootNodes[$a][$b]['id'])){
    						foreach($grandNodes as $grandNode){
    							$rootNodes[$a][$b][$c]['id'] = $grandNode->getId();
    							$rootNodes[$a][$b][$c]['name'] = $grandNode->getName();
    							$c++;
    						}
    					}
    					$b++;			
    				}
    			}
    		}
    		$a++;
    	}    	   	
    	
    	return $rootNodes;
    }
}