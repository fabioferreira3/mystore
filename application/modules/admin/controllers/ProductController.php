<?php 

class Admin_ProductController extends Zend_Controller_Action
{
	private $layout;
	private $em;
	private $repo;
	
	public function init(){
		
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
	
	public function indexAction(){
		
		$tbProduct = $this->repo->db('Product')->findAll();		
		try{
			$tbProduct = new DB_Product();
			$products = $tbProduct->getAllProductInfo();		
		}
		catch(Exception $e){echo $e->getMessage();exit;}
		$this->view->products = $products;	
		
	}
	
	public function addAction(){
		try{
			$params = $this->getRequest()->getParams();
			$store = $this->repo->db('Store')->find(1);				
			
			if(isset($params['product_id'])){
				$product = ($params['product_id']);					
			}else{
				
				$tbProduct = new DB_Product;
				$tbProduct->setName('Sem Nome');
				$tbProduct->setStore($store);
				$this->em->persist($tbProduct);
				$this->em->flush();
				$product = $tbProduct->getId();
				$this->getHelper('Redirector')->gotoUrl('/admin238/product/add?product_id=' . $product);
				
			}    		
    		
    		$session = new Zend_Session_Namespace('product');
    		$session->productId = $product;
    		$this->view->productId = $session->productId;
    	    		
		}
		catch(Exception $e){echo $e->getMessage();}	
		
    		$contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/add-content/';
    		$this->view->content = new Zend_View();
    		$this->view->content->setScriptPath($contentPath);   
    		$this->view->content->categories = $this->repo->db('Categories')->findAll();     
            $this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
            $this->view->content->conditions = $this->repo->db('ProductConditions')->findAll();
		try{
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
				if($postvars['promotion_price'] == ''){
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
        
        $postvars = $this->getRequest()->getParams();        
        $i = 0;
        foreach ($postvars['name'] as $name){
            if ($name != ''){
                $image = new DB_ProductImages();
                $result = $image->getImagesByProduct($name,null);
                if ($image != null){
                    try{
                    $this->em->remove($result[0]);
                    $this->em->flush(); 
                    $i++;                   
                    }
                    catch(Exception $e){echo json_encode($e->getMessage());exit;}
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
	
	public function editAction(){
		
		$contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/edit-content/';
		$this->view->content = new Zend_View();
		$this->view->content->setScriptPath($contentPath);
		
		$params = $this->getRequest()->getParams();
		$tbProduct = $this->repo->db('Product')->find($params['product_id']);
		$tbProductPrice = $this->repo->db('ProductPrices')->findOneByProduct($params['product_id']);
		$tbProductStock = $this->repo->db('ProductStock')->findOneByProduct($params['product_id']);
		$tbProductMeta = $this->repo->db('ProductMeta')->findOneByProduct($params['product_id']);
		$tbProductPromotion = $this->repo->db('ProductPromotion')->findOneByProduct($params['product_id']);
		if($tbProductPromotion != null){
			$this->view->content->promotion = $tbProductPromotion;
		}else{
			$this->view->content->promotion = false;
		}
		$this->view->productId = $params['product_id'];
		$this->view->productName = $tbProduct->getName();
		$this->view->content->general = $tbProduct;
		$this->view->content->price = $tbProductPrice;
		$this->view->content->stock = $tbProductStock;
		$this->view->content->meta = $tbProductMeta;
		$this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
		$this->view->content->conditions = $this->repo->db('ProductConditions')->findAll();
	}
	
	public function removeAction(){
		$params = $this->getRequest()->getParams();
		$product = $this->repo->db('Product')->find($params['product_id']);		
		
	}
	
	public function enableAction(){
		
		$params = $this->getRequest()->getParams();
		$product = $this->repo->db('Product')->find($params['product_id']);
		$product->setStatus('1');
		$this->em->persist($product);
		$this->em->flush();
		$this->_helper->flashMessenger->addMessage('Produto habilitado com sucesso!','success');		
		$this->getHelper('Redirector')->gotoUrl('/admin238/product');
		
	}
	
	public function disableAction(){
		
		$params = $this->getRequest()->getParams();
		$product = $this->repo->db('Product')->find($params['product_id']);
		$product->setStatus('0');
		$this->em->persist($product);
		$this->em->flush();
		$this->_helper->flashMessenger->addMessage('Produto desabilitado com sucesso!','success');
		$this->getHelper('Redirector')->gotoUrl('/admin238/product');		
		
	}
	
	
}

?>