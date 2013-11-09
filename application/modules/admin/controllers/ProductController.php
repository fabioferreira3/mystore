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
		
	}
	
	public function addAction(){
		try{
			$params = $this->getRequest()->getParams();
			$store = $this->repo->db('Store')->find(1);
			if(isset($params['product_id'])){
				$product = ($params['product_id']);					
			}else{
				
				$tbProduct = new DB_Product;
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
            $this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
            $this->view->content->conditions = $this->repo->db('ProductConditions')->findAll();
		try{
		if($this->getRequest()->isPost()){
			$postvars = $this->getRequest()->getPost();
			Zend_Debug::dump($postvars);
			
			$checkSku = $this->repo->db('Product')->findOneBySku($postvars['sku']);
			if ($checkSku != null){
				$this->_helper->flashMessenger->addMessage('Já existe um produto com este SKU!','error');
				$this->getHelper('Redirector')->gotoUrl('/admin238/product/add?product_id=' . $product);
			}
			
			
			
			$tbProduct = $this->repo->db('Product')->find($product);			
			$condition = $this->repo->db('ProductConditions')->find($postvars['condition']);
			$dtNow = new DateTime();			
			
			/* General */
			
			$tbProduct->setName($postvars['name']);
			$tbProduct->setSku($postvars['sku']);
			$tbProduct->setStatus($postvars['status']);
			
			if($postvars['new_since'] != null){
				$newSince = str_replace('/','-',$postvars['new_since']);				
				$dateNewSince = new DateTime($newSince);
				$tbProduct->setDateNewSince($dateNewSince);
			}
			if($postvars['new_until'] != ''){
				$newTo = str_replace('/','-',$postvars['new_until']);
				$dateNewTo = new DateTime($newTo);				
				$tbProduct->setDateNewTo($dateNewTo);
			}
			if($postvars['height'] != ''){
				$tbProduct->setHeight($postvars['height']);
			}
			if($postvars['width'] != ''){
				$tbProduct->setWidth($postvars['width']);
			}
			if($postvars['length'] != ''){
				$tbProduct->setLength($postvars['length']);
			}
			if($postvars['thickness'] != ''){
				$tbProduct->setThickness($postvars['thickness']);
			}
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
				$tbProductPrices->setDateUpd($dtNow);
			}else{
				$tbProductPrices->setDateUpd($dtNow);
			}
			$tbProductPrices->setProduct($tbProduct);
			$oldPrice = str_replace('.','',$postvars['normal_price']);
			$newPrice = str_replace(',','.',$oldPrice);			
			$tbProductPrices->setPrice($newPrice);			
			$tbProductPrices->setProduct($tbProduct);
						
			
			/* DB Persist & Flush */
			$this->em->persist($tbProduct);
			$this->em->persist($tbProductPrices);
			$this->em->flush();		
			
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
		
	}
	
	
}

?>