<?php



use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator as Paginator;

/**
 * Product
 *
 * @Table(name="product")
 * @Entity
 */
class DB_Product
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
     * @var string $sku
     *
     * @Column(name="sku", type="string", length=50, nullable=true)
     */
    private $sku;

    /**
     * @var string $desc1
     *
     * @Column(name="desc1", type="string", length=255, nullable=true)
     */
    private $desc1;

    /**
     * @var text $desc2
     *
     * @Column(name="desc2", type="text", nullable=true)
     */
    private $desc2;

    /**
     * @var string $weight
     *
     * @Column(name="weight", type="string", length=10, nullable=true)
     */
    private $weight;

    /**
     * @var string $height
     *
     * @Column(name="height", type="string", length=10, nullable=true)
     */
    private $height;

    /**
     * @var string $length
     *
     * @Column(name="length", type="string", length=10, nullable=true)
     */
    private $length;

    /**
     * @var string $thickness
     *
     * @Column(name="thickness", type="string", length=10, nullable=true)
     */
    private $thickness;

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
     * @var datetime $newSince
     *
     * @Column(name="date_new_since", type="datetime", nullable=true)
     */
    private $dateNewSince;
    
    /**
     * @var datetime $newTo
     *
     * @Column(name="date_new_to", type="datetime", nullable=true)
     */
    private $dateNewTo;

    /**
     * @var string $width
     *
     * @Column(name="width", type="string", length=10, nullable=true)
     */
    private $width;

    /**
     * @var string $slug
     *
     * @Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;
    
    /**
     * @var integer $status
     *
     * @Column(name="status", type="integer", nullable=false)
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
     * @var ProductType
     *
     * @ManyToOne(targetEntity="DB_ProductType")
     * @JoinColumns({
     *   @JoinColumn(name="product_type_id", referencedColumnName="id")
     * })
     */
    private $productType;

    /**
     * @var ProductConditions
     *
     * @ManyToOne(targetEntity="DB_ProductConditions")
     * @JoinColumns({
     *   @JoinColumn(name="condition_id", referencedColumnName="id")
     * })
     */
    private $condition;
    
    /**
     * @var Price
     *
     * @OneToOne(targetEntity="DB_ProductPrices", mappedBy="product")
     
     */
    private $price;
    
    /**
     * @var Stock
     *
     * @OneToOne(targetEntity="DB_ProductStock", mappedBy="product")
      
     */
    private $stock;
    
    /**
     * @var Images
     *
     * @OneToMany(targetEntity="DB_ProductImages", mappedBy="product")
      
     */
    private $images;
    
   

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
     * @return Product
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
     * Set sku
     *
     * @param string $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * Get sku
     *
     * @return string 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set desc1
     *
     * @param string $desc1
     * @return Product
     */
    public function setDesc1($desc1)
    {
        $this->desc1 = $desc1;
        return $this;
    }

    /**
     * Get desc1
     *
     * @return string 
     */
    public function getDesc1()
    {
        return $this->desc1;
    }

    /**
     * Set desc2
     *
     * @param text $desc2
     * @return Product
     */
    public function setDesc2($desc2)
    {
        $this->desc2 = $desc2;
        return $this;
    }

    /**
     * Get desc2
     *
     * @return text 
     */
    public function getDesc2()
    {
        return $this->desc2;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return Product
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Get height
     *
     * @return string 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Product
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set thickness
     *
     * @param string $thickness
     * @return Product
     */
    public function setThickness($thickness)
    {
        $this->thickness = $thickness;
        return $this;
    }

    /**
     * Get thickness
     *
     * @return string 
     */
    public function getThickness()
    {
        return $this->thickness;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Product
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
     * @return Product
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
     * Set dateNewSince
     *
     * @param datetime $dateNewSince
     * @return Product
     */
    public function setDateNewSince($dateNewSince)
    {
    	$this->dateNewSince = $dateNewSince;
    	return $this;
    }
    
    /**
     * Get dateNewSince
     *
     * @return datetime
     */
    public function getDateNewSince()
    {
    	return $this->dateNewSince;
    }
    
    /**
     * Set dateNewTo
     *
     * @param datetime $dateNewTo
     * @return Product
     */
    public function setDateNewTo($dateNewTo)
    {
    	$this->dateNewTo = $dateNewTo;
    	return $this;
    }
    
    /**
     * Get dateNewTo
     *
     * @return datetime
     */
    public function getDateNewTo()
    {
    	return $this->dateNewTo;
    }

    /**
     * Set width
     *
     * @param string $width
     * @return Product
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }
    
    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        if($this->price !== null){
            return $this->price->getPrice();
        }else{
            return false;
        }
    }
    
    /**
     * Get stock
     *
     * @return string
     */
    public function getCurrentQty()
    {
    	if($this->stock !== null){
            return $this->stock->getCurrentQty();
        }else{
            return false;
        }
    }
    
    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
    	return $this->images;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
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
     * Set status
     *
     * @param integer $status
     * @return Product
     */
    public function setStatus($status)
    {
    	$this->status = $status;
    	return $this;
    }
    
    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
    	return $this->status;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return Product
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

    /**
     * Set productType
     *
     * @param DB_ProductType $productType
     * @return Product
     */
    public function setProductType(\DB_ProductType $productType = null)
    {
        $this->productType = $productType;
        return $this;
    }

    /**
     * Get productType
     *
     * @return DB_ProductType 
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set condition
     *
     * @param DB_ProductConditions $condition
     * @return Product
     */
    public function setCondition(\DB_ProductConditions $condition = null)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * Get condition
     *
     * @return DB_ProductConditions 
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    public function getProducts($productId = null, $perPage = null, $curPage = null){
    	
    	if(!$perPage){
    		$perPage = 1000;
    	}
    	if(!$curPage){
    		$curPage = 1;
    	}
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$query = $em->createQueryBuilder();        
        $query->select('p')->from('DB_Product','p')->orderBy('p.id','DESC');
        if($productId){
        	$query->where('p.id = :productId');
        	$query->setParameter('productId',$productId);
        }
    	$paginator = new Paginator($query);
    	$paginator_iter = $paginator->getIterator();
    	$adapter =  new \Zend_Paginator_Adapter_Iterator($paginator_iter);
    	$data = new \Zend_Paginator($adapter);
    	$data->setItemCountPerPage($perPage)->setCurrentPageNumber($curPage);
    	
    	return $data;
    }    

    public function getProductsByFilter($params){
        
    	if(!isset($params['curPage'])){
    		$currentPage = 1;
    	}else{
    		$currentPage = $params['curPage'];
    	}
    	if(!isset($params['perPage'])){
    		$perPage = 10;
    	}else{
    		$perPage = $params['perPage'];
    	}
    	
        $em = Zend_Registry::getInstance()->entitymanager;
    
        $query = $em->createQueryBuilder();        
        $query->select('p')->from('DB_Product','p');
       
        if($params['status'] != ''){
            $query->where('p.status = :status');
            
            $query->setParameter('status',$params['status']);            
        }else{
            $query->where('p.status != 1234567');            
        }       
        if(isset($params['name']) && $params['name'] != ''){         	
            $query->andWhere('p.name LIKE :name');
            $query->setParameter('name',"%".$params['name']."%");            
        }        
        if(isset($params['sku']) && $params['sku'] != ''){        	
            $query->andWhere('p.sku LIKE :sku');
            $query->setParameter('sku',"%".$params['sku']."%");            
        } 
        if(isset($params['priceFrom']) && $params['priceTo'] && $params['priceTo'] != '' && $params['priceFrom'] != ''){
        	$query->innerjoin('p.price','pr','WITH','pr.price <= :priceTo AND pr.price >= :priceFrom');
        	$query->setParameters(array('priceFrom' => $params['priceFrom'], 'priceTo' => $params['priceTo']));
        	
        }else if(isset($params['priceFrom']) && $params['priceFrom']){        	
        	$query->innerjoin('p.price','pr','WITH','pr.price >= :priceFrom');
        	$query->setParameter('priceFrom',$params['priceFrom']);     
        }else if(isset($params['priceTo']) && $params['priceTo']){
        	$query->innerjoin('p.price','pr','WITH','pr.price <= :priceTo');
        	$query->setParameter('priceTo',$params['priceTo']);
        }        
       
        if(isset($params['stockFrom']) && isset($params['stockTo']) && $params['stockTo'] != '' && $params['stockFrom'] != ''){
           	$query->innerjoin('p.stock','st','WITH','st.currentQty <= :stockTo AND st.currentQty >= :stockFrom');
        	$query->setParameters(array('stockFrom' => $params['stockFrom'], 'stockTo' => $params['stockTo']));
        }else if(isset($params['stockFrom']) && $params['stockFrom']){
        	$query->innerjoin('p.stock','st','WITH','st.currentQty >= :stockFrom');       
        	$query->setParameter('stockFrom',$params['stockFrom']);      	
        }else if(isset($params['stockTo']) && $params['stockTo']){
        	$query->innerjoin('p.stock','st','WITH','st.currentQty <= :stockTo'); 
        	$query->setParameter('stockTo',$params['stockTo']);        	
        }       
        
        $query->orderBy('p.id','DESC');
        
        $paginator = new Paginator($query);         
        $paginator_iter = $paginator->getIterator();        
        $adapter =  new \Zend_Paginator_Adapter_Iterator($paginator_iter);        
        $data = new \Zend_Paginator($adapter);        
        $data->setItemCountPerPage($perPage)->setCurrentPageNumber($currentPage);     
        
        return $data;
    }

    public function destroy($productId){
        
        try{
        $em = Zend_Registry::getInstance()->entitymanager;
        
        $product = $em->getRepository('DB_Product')->find($productId);
        $related = $em->getRepository('DB_ProductRelated')->findByMainProduct($productId);
        $price = $em->getRepository('DB_ProductPrices')->findByProduct($productId);
        $range = $em->getRepository('DB_ProductPriceRange')->findByProduct($productId);
        $attributes = $em->getRepository('DB_ProductAttributesValue')->findByProduct($productId);
        $stock = $em->getRepository('DB_ProductStock')->findByProduct($productId);
        $images = $em->getRepository('DB_ProductImages')->findByProduct($productId);
        $meta = $em->getRepository('DB_ProductMeta')->findByProduct($productId);
        $promotion = $em->getRepository('DB_ProductPromotion')->findByProduct($productId);
        $views = $em->getRepository('DB_ProductViews')->findByProduct($productId);
        $rate = $em->getRepository('DB_ProductRate')->findByProduct($productId);
        $categoryProduct = $em->getRepository('DB_CategoryProducts')->findByProduct($productId);
        
        if($related != null){
            foreach($related as $one){
                $this->em->remove($one);
            }                
        }
        if($price != null){
            foreach($price as $one){
                $em->remove($one);
            }                
        }
        if($range != null){
            foreach($range as $one){
                $em->remove($one);
            }                
        }
        if($attributes != null){
            foreach($attributes as $one){
                $em->remove($one);
            }                
        }
        if($stock != null){
            foreach($stock as $one){
                $em->remove($one);
            }                
        }
        if($images != null){
            foreach($images as $one){
                $em->remove($one);
            }                
        }
        if($meta != null){
            foreach($meta as $one){
                $em->remove($one);
            }                
        }
        if($promotion != null){
            foreach($promotion as $one){
                $em->remove($one);
            }                
        }
        if($views != null){
            foreach($views as $one){
                $em->remove($one);
            }                
        }
        if($rate != null){
            foreach($rate as $one){
                $em->remove($one);
            }                
        }
        if($categoryProduct != null){
            foreach($categoryProduct as $one){
                $em->remove($one);
            }                                      
        }
        if($product != null){
            $em->remove($product);                            
        }
        $em->flush();
            return true;
        }
        catch(Exception $e){return $e->getMessage();}
    }
    
    public function generateTable($params,array $conditions = null){
    	
    	$html = '';    	
    	
    	if($params){
    		foreach($params as $row){
    			
    			// Define o url path do thumbnail do produto 
    			if ($row->getImages()[0] !== null && $row->getImages()[0]){
    				$imagePath = '/images/catalog/' . $row->getId() . '/' . $row->getImages()[0]->getName();
    				$thumbPath = '/images/catalog/' . $row->getId() . '/thumbnail/' . $row->getImages()[0]->getName();
    			};
    			
    			// Se existir preço cadastrado, mostra-o
    			if($row->getPrice() !== null && $row->getPrice()){
    				$price = 'R$' . $row->getPrice();
    			}
    			$editUrl = '/admin238/product/edit?product_id=' . $row->getId();
    			if($row->getStatus() == '1'){
    				$status = '<a href="/admin238/product/disable?product_id='.$row->getId().'">
                     <i class="splashy-gem_okay"></i>Ativo';}else{
    	                     $status = '<a href="/admin238/product/enable?product_id='.$row->getId().'"><i class="splashy-gem_remove"></i>Desabilitado</a>';}
    	                     $html.= "<tr class='result'>";
    	                     
    	                     // Mostra ou oculta select do produto
    	                     if(!isset($conditions['noselect'])){
    	                     	$html.= "<td>" . '<input type="checkbox" name="row_sel" class="row_sel" value="' . $row->getId() . '"/></td>';
    	                     }
    	                     // Mostra ou oculta o id do produto    	                     
    	                     if(!isset($conditions['noid'])){
    	                     	$html.= "<td class='span1'>" . $row->getId() . "</td>";
    	                     }
    	                     
    	                     // Mostra ou oculta a thumbnail do produto
    	                     if(!isset($conditions['noimage'])){
    	                     	$html.= "<td style='width: 60px'><a href='" . $imagePath . "' title='' class='cbox_single thumbnail'> <img alt='' src='" . $thumbPath . "' style='height: 50px; width: 50px'></a></td>";
    	                     }
    	                     
    	                     $html.= "<td>" . $row->getName() . "</td>";
    	                     if(!isset($conditions['nosku'])){
    	                     	$html.= "<td>" . $row->getSku() . "</td>";
    	                     }
    	                     if(!isset($conditions['noprice'])){
    	                     	$html.= "<td>" . $price . "</td>";
    	                     }
    	                     if(!isset($conditions['nostock'])){
    	                     	if(isset($conditions['editStock'])){
    	                     		$html.= "<td colspan='2'><input type='text' value='" . $row->getCurrentQty() . "' class='editStock span4'/></td>";
    	                     	}else{
    	                     		$html.= "<td colspan='2'>" . $row->getCurrentQty() . "</td>";
    	                     	}    	                     	
    	                     }
    	                     // Mostra ou oculta o status do produto
    	                     if(!isset($conditions['nostatus'])){
    	                     	$html.= "<td>" . $status . "</td>";
    	                     }
    	                     
    	                     // Mostra ou oculta ícone 'Editar Produto' 
    	                     if(!isset($conditions['noactions'])){
    	                     	$html.= "<td><a href='" . $editUrl . "' class='sepV_a' title='Editar'><i class='icon-pencil'></i></a> <a href='#' title='Remover'><i class='icon-trash'></i></a></td>";
    	                     }  

    	                     // Cria campo para inserir quantidade do produto no pedido
    	                     if(isset($conditions['inputQty'])){
    	                     	$html.= '<td><input type="text" class="inputQty span12"/></td>';
    	                     }
    	                     
    	                     // Adiciona botão para inserir produto no pedido
    	                     if(isset($conditions['addButton'])){
    	                     	$html.= '<td><button class="btn addProduct">+</button></td>';
    	                     }
    	                     
    	                     $html.= "</tr>";
    		}
    	}
    	
    	return $html;
    }
}