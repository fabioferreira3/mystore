<?php 



class Admin_ProductController extends Zend_Controller_Action
{
	private $layout;
	private $em;
	private $repo;
	
	public function init(){
		try{
    		$this->layout = Zend_Layout::getMvcInstance();
    		$this->layout->setLayout('adminLayout');
    		$this->em = $this->_helper->EM->em();
    		$this->repo = $this->_helper->EM;
    	
    		if ($this->_helper->FlashMessenger->hasMessages('success')) {
    			$this->view->msgSuccess = $this->_helper->FlashMessenger->getMessages('success');
    		}
    		if ($this->_helper->FlashMessenger->hasMessages('error')) {
    			$this->view->msgError = $this->_helper->FlashMessenger->getMessages('error');
    		}
    	       
    		$this->view->productPage = true;
        }
        catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function indexAction(){		
		
		try{		     
			$params = $this->getRequest()->getParams();
			if(isset($params['page'])){$curPage = $params['page'];}
			else{$curPage = 1;}
			
			$tbProduct = new DB_Product();
			$maxItemsPerPage = 30;
			$produtos = $tbProduct->getProducts(false,$maxItemsPerPage,$curPage);			
			$totalItems = $produtos->getTotalItemCount();
			$maxPages = ceil($totalItems / $maxItemsPerPage);
	       	$this->view->pagination = $this->_helper->Paginator->generate($curPage,$maxPages,$totalItems);
		    $this->view->products = $produtos;
		}
		catch(Exception $e){echo $e->getMessage();exit;}		
	}
	
	public function addAction(){
		try{
			$params = $this->getRequest()->getParams();
			$store = $this->repo->db('Store')->find(1);	
            $tbCategories = new DB_Category();			
			
			if(isset($params['product_id'])){
				$product = ($params['product_id']);					
			}else{				
				$tbProduct = new DB_Product;
				$tbProduct->setName('Sem Nome');
                $tbProduct->setStatus(0);
				$tbProduct->setStore($store);
				$this->em->persist($tbProduct);
				$this->em->flush();
				$product = $tbProduct->getId();
				$this->getHelper('Redirector')->gotoUrl('/admin238/product/add?product_id=' . $product);
			}    		
    		
    		$session = new Zend_Session_Namespace('product');
    		$session->productId = $product;
    		$this->view->productId = $session->productId;
            
            $contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/add-content/';
            $this->view->content = new Zend_View();
            $this->view->content->setScriptPath($contentPath);   
            $this->view->content->categories = $tbCategories->getAllDependencies();     
            $this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
            $this->view->content->conditions = $this->repo->db('ProductConditions')->findAll();
    	    
            if($this->getRequest()->isPost()){
            $postvars = $this->getRequest()->getPost();
            Zend_Debug::dump($postvars);
            
            $checkSku = $this->repo->db('Product')->findOneBySku($postvars['sku']);
            
                if ($checkSku != null){
                    if($checkSku->getId() != $product){                 
                        $this->_helper->flashMessenger->addMessage('Já existe um produto com este SKU!','error');
                        $this->getHelper('Redirector')->gotoUrl('/admin238/product/edit?product_id=' . $product);
                    }
                }               
            
            $tbProduct = $this->repo->db('Product')->find($product);            
            $condition = $this->repo->db('ProductConditions')->find($postvars['condition']);
            $dtNow = new DateTime();         

            /* Categories */
            
            if ($postvars['categories']){
           
            	$tbCategoryProducts = $this->repo->db('CategoryProducts')->findByProduct($tbProduct);
	            if($tbCategoryProducts != null){	     
	            	foreach($tbCategoryProducts as $one){
	            		$this->em->remove($one);
	            		$this->em->flush();
	            	}       	
	            	        	
	            }	            
	            	foreach ($postvars['categories'] as $categoryId){
	            		$tbCategoryProducts = new DB_CategoryProducts();
	            		$category = $this->repo->db('Category')->find($categoryId);
	            		$tbCategoryProducts->setCategory($category);
	            		$tbCategoryProducts->setProduct($tbProduct);
	            		$tbCategoryProducts->setDateCreate($dtNow);
	            		$tbCategoryProducts->setStore($store);
	            		$this->em->persist($tbCategoryProducts);
	            		$this->em->flush();	            		
	            	}	            
            }
            
            /* General */
            
            $tbProduct->setName($postvars['name']);
            $tbProduct->setSku($postvars['sku']);
            $tbProduct->setStatus($postvars['status']);
            
            if($postvars['new_since'] == ''){
                $tbProduct->setDateNewSince(null);
            }else{
                $newSince = str_replace('/','-',$postvars['new_since']);
                $dateNewSince = new DateTime($newSince);
                $tbProduct->setDateNewSince($dateNewSince);             
            }
                            
            if($postvars['new_until'] == ''){
                $tbProduct->setDateNewTo(null);
            }else{
                $newTo = str_replace('/','-',$postvars['new_until']);
                $dateNewTo = new DateTime($newTo);              
                $tbProduct->setDateNewTo($dateNewTo);
            }
            $tbProduct->setHeight($postvars['height']);
            $tbProduct->setWidth($postvars['width']);
            $tbProduct->setLength($postvars['length']);
            $tbProduct->setThickness($postvars['thickness']);           
            if($postvars['weight'] != ''){
                $tbProduct->setWeight($postvars['weight']);
            }else{
                $tbProduct->setWeight('0.1');
            }
            $tbProduct->setCondition($condition);
            $tbProduct->setSlug($postvars['slug']);
            $tbProduct->setDesc1($postvars['desc1']);
            $tbProduct->setDesc2($postvars['desc2']);
            $tbProduct->setDateCreate($dtNow);
            $tbProduct->setDateUpd($dtNow);
            $tbProduct->setStore($store);
            
            /* Prices */
            
            $tbProductPrices = $this->repo->db('ProductPrices')->findOneByProduct($product);
            if ($tbProductPrices == null){
                $tbProductPrices = new DB_ProductPrices();
                $tbProductPrices->setDateCreate($dtNow);
            }
            $tbProductPrices->setDateUpd($dtNow);
            $tbProductPrices->setProduct($tbProduct);
            $oldPrice = str_replace('.','',$postvars['normal_price']);
            $newPrice = str_replace(',','.',$oldPrice);         
            $tbProductPrices->setPrice($newPrice);          
            $tbProductPrices->setProduct($tbProduct);            
            
                $tbProductPromotion = $this->repo->db('ProductPromotion')->findOneByProduct($product);
                if($tbProductPromotion == null){
                    $tbProductPromotion = new DB_ProductPromotion();                    
                }
                $tbProductPromotion->setDateUpd($dtNow);
                $tbProductPromotion->setProduct($tbProduct);
                if($postvars['promotional_price'] == ''){
                    $tbProductPromotion->setPrice(null);
                }else{
                    $oldPromoPrice = str_replace('.','',$postvars['promotional_price']);
                    $newPromoPrice = str_replace(',','.',$oldPromoPrice);                    
                    $tbProductPromotion->setPrice($newPromoPrice);
                }
                
                if($postvars['promotion_since'] == ''){
                    $tbProductPromotion->setDateFrom(null);
                }else{
                    $newPromoSince = str_replace('/','-',$postvars['promotion_since']);     
                    $newPromoSince = new DateTime($newPromoSince);                  
                    $tbProductPromotion->setDateFrom($newPromoSince);
                }
                if($postvars['promotion_until'] == ''){
                    $tbProductPromotion->setDateTo(null);
                }else{
                    $newPromoTo = str_replace('/','-',$postvars['promotion_until']);
                    $newPromoTo = new DateTime($newPromoTo);
                    $tbProductPromotion->setDateTo($newPromoTo);
                }
                
                $this->em->persist($tbProductPromotion);
            
            
            /* Stock */
            
            $tbProductStock = $this->repo->db('ProductStock')->findOneByProduct($product);
            if ($tbProductStock == null){
                $tbProductStock = new DB_ProductStock();                
            }
            $tbProductStock->setProduct($tbProduct);
            $tbProductStock->setDateUpd($dtNow);
            if($postvars['qty'] != ''){
                $tbProductStock->setCurrentQty($postvars['qty']);
            }else{
                $tbProductStock->setCurrentQty('0');
            }           
            $tbProductStock->setAvailability($postvars['availability']);
            if($postvars['minimal_qty'] == ''){
                $tbProductStock->setMinimumQty(null);
            }else{
                $tbProductStock->setMinimumQty($postvars['minimal_qty']);
            }
            if($postvars['outstock_qty'] == ''){
                $tbProductStock->setQtyOutOfStock(null);
            }else{
                $tbProductStock->setQtyOutOfStock($postvars['outstock_qty']);
            }
            if($postvars['minimal_cart_qty'] == ''){
                $tbProductStock->setMinimumCartQty(null);
            }else{
                $tbProductStock->setMinimumCartQty($postvars['minimal_cart_qty']);
            }
            if($postvars['maximum_cart_qty'] == ''){
                $tbProductStock->setMaximumCartQty(null);
            }else{
                $tbProductStock->setMaximumCartQty($postvars['maximum_cart_qty']);
            }
            $tbProductStock->setEmailWarning($postvars['warning_stock']);           
            $tbProductStock->setDecimal($postvars['decimal']);
            
            
            /* Meta Tags */
            
                $tbProductMeta = $this->repo->db('ProductMeta')->findOneByProduct($product);
                if($tbProductMeta == null){
                    $tbProductMeta = new DB_ProductMeta();
                }
                $tbProductMeta->setProduct($tbProduct);
                $tbProductMeta->setMetaTitle($postvars['meta_title']);
                $tbProductMeta->setMetaDescription($postvars['meta_description']);
                $tbProductMeta->setMetaSearch($postvars['meta_search']);
                
                $this->em->persist($tbProductMeta);
            
            
            /* DB Flush */
            $this->em->persist($tbProduct);
            $this->em->persist($tbProductPrices);
            $this->em->persist($tbProductStock);
            
            $this->em->flush();
            if(isset($params['method'])){
                if($params['method'] == 'edit'){
                    $this->_helper->flashMessenger->addMessage('Produto Atualizado com sucesso!','success');
                }
            }else{
                $this->_helper->flashMessenger->addMessage('Produto Cadastrado com sucesso!','success');
            }
            $this->getHelper('Redirector')->gotoUrl('/admin238/product/edit?product_id=' . $product);
                       
            }else{
                $tbProduct = $this->repo->db('Product')->find($product);
                $tbProductPrice = $this->repo->db('ProductPrices')->findOneByProduct($product);
                
            }		
		}
		catch(Exception $e){echo $e->getMessage();}	
			
	}
	
	public function addImageAction(){		
		
		$postvars = $this->getRequest()->getParams();
        $i = 0;
        
        foreach ($postvars['name'] as $name){
     
            if ($name != ''){                
                $image = $this->repo->db('ProductImages')->findOneByName($name);
                if ($image == null){                
                    $productImage = new DB_ProductImages();
                    $product = $this->repo->db('Product')->find($postvars['productid']);
                    $productImage->setProduct($product);
                    $productImage->setName($name);
                    $productImage->setOrdenation($postvars['order'][$i]);
                    $store = $this->repo->db('Store')->find('1');
                    $productImage->setStore($store);
                    $this->em->persist($productImage);
                    $this->em->flush();
                    $i++;
                }else{
                    $image->setOrdenation($postvars['order'][$i]);
                    $this->em->persist($image);
                    $this->em->flush();
                    $i++;
                }               
            }
       }
       
        if($i>0){
            echo json_encode($i . ' imagens inseridas/atualizadas com sucesso!');
            exit;
        }else{
            echo json_encode(false);
            exit;
        }
			
	}

    public function deleteImageAction(){
        try{
            $postvars = $this->getRequest()->getParams();        
            $i = 0;
            foreach ($postvars['name'] as $name){
                if ($name != ''){
                    $image = new DB_ProductImages();
                    $result = $image->getImagesByProduct($name,null);
                    if ($image != null){
                        
                        $this->em->remove($result[0]);
                        $this->em->flush(); 
                        $i++;                   
                       
                    }
                }        
            }
            if($i>0){
                echo json_encode('Imagem removida com sucesso!');
                exit;
            }else{
                echo json_encode(false);
                exit;
            }  
        }
        catch(Exception $e){echo json_encode($e->getMessage());exit;}       
    }
	
	public function editAction(){	    
	   
		try{
    		$contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/edit-content/';
    		$this->view->content = new Zend_View();
    		$this->view->content->setScriptPath($contentPath);    		
    		   		
    		$params = $this->getRequest()->getParams();
    		
    		$session = new Zend_Session_Namespace('product');
    		$session->productId = $params['product_id'];
    		
    		$tbProduct = $this->repo->db('Product')->find($params['product_id']);
    		$tbProductPrice = $this->repo->db('ProductPrices')->findOneByProduct($params['product_id']);
    		$tbProductStock = $this->repo->db('ProductStock')->findOneByProduct($params['product_id']);
    		$tbProductMeta = $this->repo->db('ProductMeta')->findOneByProduct($params['product_id']);
    		$tbProductPromotion = $this->repo->db('ProductPromotion')->findOneByProduct($params['product_id']);
    		$tbCategories = new DB_Category();  
    		if($tbProductPromotion != null){
    			$this->view->content->promotion = $tbProductPromotion;
    		}else{
    			$this->view->content->promotion = false;
    		}
    		$this->view->productId = $params['product_id'];
    		$this->view->productName = $tbProduct->getName();
    		$this->view->content->general = $tbProduct;
            $this->view->content->categories = $tbCategories->getAllDependencies();
            $categoriesByProduct = $this->repo->db('CategoryProducts')->findByProduct($tbProduct);
            $categoriesArray = array();
            foreach($categoriesByProduct as $category){
            	$categoriesArray[] = $category->getCategory()->getId();
            }
            $this->view->content->categoriesByProduct = $categoriesArray;
    		$this->view->content->price = $tbProductPrice;
    		$this->view->content->stock = $tbProductStock;
    		$this->view->content->meta = $tbProductMeta;
    		$this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
    		$this->view->content->conditions = $this->repo->db('ProductConditions')->findAll();
		}
        catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function removeAction(){
	    
		try{    
    		$params = $this->getRequest()->getParams();
            $tbProduct = new DB_Product();           
            if($tbProduct->destroy($params['product_id'])){
                $this->_helper->flashMessenger->addMessage('Produto excluído com sucesso!','success');        
                $this->getHelper('Redirector')->gotoUrl('/admin238/product');
            }else{
                $this->_helper->flashMessenger->addMessage('Erro ao excluir produto!','error');        
                $this->getHelper('Redirector')->gotoUrl('/admin238/product');
            }
            if($related != null){
                foreach($related as $one){
                    $this->em->remove($one);
                }                
            }
        }
        catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function enableAction(){
		try{
    		$params = $this->getRequest()->getParams();
    		$product = $this->repo->db('Product')->find($params['product_id']);
    		$product->setStatus('1');
    		$this->em->persist($product);
    		$this->em->flush();
    		$this->_helper->flashMessenger->addMessage('Produto habilitado com sucesso!','success');		
    		$this->getHelper('Redirector')->gotoUrl('/admin238/product');
        }
        catch(Exception $e){echo $e->getMessage();exit;}		
	}
	
	public function disableAction(){
		try{
    		$params = $this->getRequest()->getParams();
    		$product = $this->repo->db('Product')->find($params['product_id']);
    		$product->setStatus('0');
    		$this->em->persist($product);
    		$this->em->flush();
    		$this->_helper->flashMessenger->addMessage('Produto desabilitado com sucesso!','success');
    		$this->getHelper('Redirector')->gotoUrl('/admin238/product');
        }
        catch(Exception $e){echo $e->getMessage();exit;}		
	}
    
    public function filterAction(){
        try{
            $params = $this->getRequest()->getParams();
            $tbProduct = new DB_Product();          
            $conditions = array();
            if($params['noid']){ $conditions['noid'] = true; }
            if($params['nostatus']){ $conditions['nostatus'] = true; }
            if($params['noactions']){ $conditions['noactions'] = true; }
            if($params['inputQty']){ $conditions['inputQty'] = true; }
            if($params['addButton']){ $conditions['addButton'] = true; }
            if($params['noprice']){ $conditions['noprice'] = true; }
            if($params['editStock']){ $conditions['editStock'] = true; }
            if($params['noselect']){ $conditions['noselect'] = true; }
            if($params['nocheckbox']){ $conditions['nocheckbox'] = true; }
            
            $results = $tbProduct->getProductsByFilter($params);
                       
            if($results != null){
            	$data = array();     
            	$data['data'] = $results;    
                $data['maker'] = $tbProduct->generateTable($results,$conditions);           
                $data['pagination'] = $this->_helper->Paginator->generate(false,false,$results->getTotalItemCount());
                echo json_encode($data);
            }else{
                $maker = $this->_helper->ProductTableMaker->create(false,true,false);
                echo json_encode($maker);
            }          
            exit;
        }
        catch(Exception $e){echo json_encode($e->getMessage());exit;}
    }	
    
    public function stockAction(){
    	
    	
    }
    
    public function updateStockAction(){
    	
    	try{
	    	$params = $this->getRequest()->getParams();
	    	    	
	    	$i = 0;
	    	foreach($params['productid'] as $product){
	    		$tbProductStock = $this->repo->db('ProductStock')->findOneByProduct($product);
	    		$tbProductStock->setCurrentQty($params['productstock'][$i]);
	    		$this->em->persist($tbProductStock);
	    		$this->em->flush();
	    		$i++;
	    	}    	
	    		echo json_encode('Estoque Atualizado com Sucesso!');
	    		exit;
	    	}
    	catch(Exception $e){echo json_encode($e->getMessage());exit;}
    	
    }
    
    
}

?>