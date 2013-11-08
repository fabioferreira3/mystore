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
    	//	$tbProduct = new DB_Product;		
    	//	$this->em->persist($tbProduct);
    	//	$this->em->flush();	
    		$product = $this->repo->db('Product')->find('9');
    		$session = new Zend_Session_Namespace('product');
    		$session->productId = '8';
    		$this->view->productId = $session->productId;
		}
		catch(Exception $e){echo $e->getMessage();}	
		
    		$contentPath = APPLICATION_PATH . '/modules/admin/views/scripts/product/add-content/';
    		$this->view->content = new Zend_View();
    		$this->view->content->setScriptPath($contentPath);        
            $this->view->content->groupClients = $this->repo->db('ClientGroupTypes')->findAll();
		
		if($this->getRequest()->isPost()){
			Zend_Debug::dump($this->getRequest()->getPost());
		}		
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