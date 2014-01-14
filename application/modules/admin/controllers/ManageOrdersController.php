<?php 

class Admin_ManageOrdersController extends Zend_Controller_Action
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
		
		$this->view->manageOrdersPage = true;
	}
	
	public function indexAction(){
	    
		try{
			$params = $this->getRequest()->getParams();
			if(isset($params['page'])){$curPage = $params['page'];}
			else{$curPage = 1;}
			$tbOrders = new DB_Orders();
			$maxItemsPerPage = 20;
			$totalItems = $tbOrders->getOrders()->getTotalItemCount();
			$maxPages = ceil($totalItems / $maxItemsPerPage);
					
			$this->view->status = $this->repo->db('OrderStatus')->findAll();
			$this->view->table = $tbOrders->generateTable($tbOrders->getOrders());
			$this->view->pagination = $this->_helper->Paginator->generate($curPage,$maxPages,$totalItems);
		}
		catch(Exception $e){echo $e->getMessage();exit;}		
	}
	
	public function addAction(){
		
		try{
			
			$params = $this->getRequest()->getParams();
			
			if(isset($params['create'])){	
				$tbOrders = new DB_Orders();
				$store = $this->repo->db('Store')->find('1');
				if($tbOrders->checkRecord()){
					$newOrderCod = $tbOrders->getLastOrderCod() + 1;
					$tbOrders->setOrderCod($newOrderCod);
				}else{
					$random = '';
						for($i=0; $i <= 5; $i++){
							$random .= mt_rand(1,9);
						}
					$random = '100' . $random;
					$tbOrders->setOrderCod($random);
				}																
					$dtNow = new DateTime();
					$statusOnCreation = $this->repo->db('OrderStatus')->find('7');				
					$tbOrders->setOrderStatus($statusOnCreation);
					$tbOrders->setStore($store);
					$tbOrders->setDateCreate($dtNow);			
					$tbOrders->setDateUpd($dtNow);
					$this->em->persist($tbOrders);
					$this->em->flush();	
					$orderId = $tbOrders->getId();
					$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders/edit?orderid=' . $orderId);
			}else{
				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
			}
			
		}
		catch(Exception $e){echo $e->getMessage();exit;	}
	}
	
	public function editAction(){
		
		try{
			$params = $this->getRequest()->getParams();
			$countries = $this->repo->db('Country')->findAll();
			$this->view->countries = $countries;
			
			if(isset($params['orderid']) && $params['orderid'] != ''){
				$data = $this->repo->db('Orders')->find($params['orderid']);
				if($data->getOrderStatus()->getId() != 7){
					$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
				}
				$this->view->data = $data;
				$tbClient = new DB_Client();
				$clientData = $this->repo->db('Client')->findAll();
				$conditions = array();
				$conditions['dates'] = false;
				$conditions['status'] = false;
				$conditions['actions'] = false;
				$conditions['selectType'] = 'radio';
				$this->view->orderId = $params['orderid'];
				$this->view->clientTable = $tbClient->generateTable($clientData,$conditions);
			}else{
				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
				exit;
			}
		}
		catch(Exception $e){echo $e->getMessage();exit;}
	}
	
	public function removeAction(){
	    
		try{				
			$params = $this->getRequest()->getParams();
			$tbOrders = new DB_Orders();
			if($tbOrders->destroy($params['orderid'])){
				$this->_helper->flashMessenger->addMessage('Pedido removido com sucesso!','success');
				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
				exit;
			}else{
				$this->_helper->flashMessenger->addMessage('Pedido não removido!','error');
				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
				exit;
			}
		}
		catch(Exception $e){echo $e->getMessage();exit;	}
	}
    
    public function saveAction(){
            
        try{
            $params = $this->getRequest()->getParams();
            
       //   echo json_encode($params);
            $tbOrders = new DB_Orders();
            $tbOrders->saveOrder($params);
            echo json_encode('ok');
            exit;
        }
        catch(Exception $e){echo json_encode($e->getMessage());exit; }
    }
    
    public function detailsAction(){
        
    	try{
    	    
            $tbProduct = new DB_Product();
   
            
    	    $params = $this->getRequest()->getParams();
            $tbOrder = new DB_Orders();
            $data = $tbOrder->getOrderDetails($params['orderid']);
          //  Zend_Debug::dump($data['products'][0]->getProduct()->getImages());exit;
            $conditions['thumbnail'] = true;
            echo $tbProduct->generateOrderProductsTable($data,$conditions);
            exit;
            if($data != false){
                $this->view->data = $data; 
                $this->view->client = $data['general']->getClient();
            }else{
                $this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
            }
                                  
    	}
        catch(Exception $e){echo $e->getMessage();exit;}
    }
}