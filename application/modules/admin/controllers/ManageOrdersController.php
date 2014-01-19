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
		$this->view->teste = 'teste';
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
            
            $tbOrders = new DB_Orders();
            $tbOrders->saveOrder($params);
            $this->_helper->flashMessenger->addMessage('Pedido criado/atualizado com sucesso!','success');
            echo json_encode(true);
            exit;
        }
        catch(Exception $e){echo json_encode($e->getMessage());exit; }
    }
    
    public function cancelAction(){
    	
    	try{
    		$params = $this->getRequest()->getParams();
    		$ordersId = array();
    		if(is_array($params['orderid'])){
    			$i = 0;
    			foreach ($params['orderid'] as $id){
    				$ordersId[$i] = $id;
    				$i++;
    			}
    		}else{
    			$ordersId[0] = $params['orderid'];
    		}
            if(isset($params['updatestock']) && $params['updatestock'] == 1){                
                $updateStock = true;
            }else{
                $updateStock = false;
            }
    		
    		$tbOrder = new DB_Orders();
    		$results = $tbOrder->cancel($ordersId,$updateStock);
    		if ($results['success'] > 0 && $results['failure'] > 0){
    		    $this->_helper->flashMessenger->addMessage($results['success'] . ' pedido(s) cancelado(s) com sucesso, porém ' . $results['failure'] . ' pedido(s) não foram cancelado(s)','success');
    		}else if($results['success'] > 0 && $results['failure'] <= 0){
    		    if($results['success'] == 1){
    		        $this->_helper->flashMessenger->addMessage('Pedido cancelado com sucesso!','success');
    		    }else{
    		        $this->_helper->flashMessenger->addMessage($results['success'] . ' pedidos cancelados com sucesso!','success');
    		    }
    		}else if($results['failure'] > 0 && $results['success'] <= 0){
                if($results['failure'] == 1){
                    $this->_helper->flashMessenger->addMessage('Este pedido não pode ser cancelado','error');
                }else{
                    $this->_helper->flashMessenger->addMessage($results['failure'] . ' pedidos não puderam ser cancelados!','error');
                }
            }       		
    		
			$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
    		
    	}
    	catch(Exception $e){echo $e->getMessage();exit;}
    }
    
    public function detailsAction(){
        
    	try{
    	    
            $tbProduct = new DB_Product();   
            
    	    $params = $this->getRequest()->getParams();
            $tbOrder = new DB_Orders();            
            $data = $tbOrder->getOrderDetails($params['orderid']); 
            $invoices = $this->repo->db('Invoice')->findByOrder($params['orderid']);        
            $conditions['thumbnail'] = true;
      
            if($data != false){
                $this->view->data = $data; 
                $this->view->client = $data['general']->getClient();
                $this->view->productTable = $tbProduct->generateOrderProductsTable($data,$conditions);
                if($invoices != null){
                	$this->view->invoices = $invoices;
                }
            }else{
                $this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
            }
                                  
    	}
        catch(Exception $e){echo $e->getMessage();exit;}
    }
    
    public function invoiceAction(){
    	
    	try{
    		$params = $this->getRequest()->getParams();
    		$tbOrder = new DB_Orders();
    		$tbProduct = new DB_Product();
    		$conditions['thumbnail'] = true;
    		
    		// Traz informações pelo ID do Pedido (Somente para criação de nova fatura)
    		
    		if(isset($params['orderid'])){
    			$data = $tbOrder->getOrderDetails($params['orderid']);
    			if($data != false){
    				$this->view->data = $data;    				
    			}else{
    				$this->_helper->flashMessenger->addMessage('Pedido não encontrado!','error');
    				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
    			}
    		}   		
    		
    		// Traz informações pelo ID da Fatura (Somente para visualização de determinada fatura)
    		
    		if(isset($params['invoiceid'])){
    			$invoice = $this->repo->db('Invoice')->find($params['invoiceid']);
    			if($invoice != null){
	    			$data = $tbOrder->getOrderDetails($invoice->getOrder()->getId());
	    			if($data != false){
	    				$this->view->data = $data;
	    				$this->view->invoice = $invoice;    
	    				$this->view->type = 'view';				
	    			}else{
	    				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
	    			}
    			}else{
    				$this->_helper->flashMessenger->addMessage('Fatura não encontrada!','error');
    				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
    			}
    			
    		}
    		
    		$this->view->productTable = $tbProduct->generateOrderProductsTable($data,$conditions);
    		$this->view->client = $data['general']->getClient();   	
    		
    		
    		if(isset($params['create']) && $params['create'] == 1){
    			$this->view->type = 'create';
    			$title = 'Criar Fatura - Pedido #' . $data['general']->getOrderCod();
    		}else if(isset($params['view']) && $params['view'] == 1){
    			$this->view->type = 'view';
    			$title = 'Fatura #' . $invoice->getInvoiceCod();
    		}
    		$this->view->title = $title;
    		
    	}
    	catch(Exception $e){echo $e->getMessage();exit;}
    }
    
    public function saveInvoiceAction(){
    	
    	try{
    		$params = $this->getRequest()->getParams();    		
    		$tbInvoice = new DB_Invoice();    		
    		if($tbInvoice->create($params['orderid'],$params['comment'],$params['sendemail'])){
    			
    			$this->_helper->flashMessenger->addMessage('Fatura criada com sucesso!','success');
    			echo json_encode(true);    			
    		}else{
    			$this->_helper->flashMessenger->addMessage('Erro na geração da fatura!','error');
    			echo json_encode(true);
    		}
    		exit;
    	}
    	catch(Exception $e){echo $e->getMessage();exit;}
    }
    
    public function shippingAction(){
    	try{
    		
    		$params = $this->getRequest()->getParams();
    		
    		if(isset($params['orderid'])){
    			$data = $tbOrder->getOrderDetails($params['orderid']);
    			if($data != false){
    				$this->view->data = $data;
    			}else{
    				$this->_helper->flashMessenger->addMessage('Pedido não encontrado!','error');
    				$this->getHelper('Redirector')->gotoUrl('/admin238/manage-orders');
    			}
    		}
    		
    	}
    	catch(Exception $e){echo $e->getMessage();exit}
    }
}