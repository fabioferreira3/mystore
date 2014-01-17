<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @Table(name="invoice")
 * @Entity
 */
class DB_Invoice
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
     * @var string $invoiceCod
     *
     * @Column(name="invoice_cod", type="string", length=50, nullable=false)
     */
    private $invoiceCod;

    /**
     * @var string $nf
     *
     * @Column(name="nf", type="string", length=255, nullable=true)
     */
    private $nf;

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
     * @var boolean $emailSent
     *
     * @Column(name="email_sent", type="boolean", nullable=true)
     */
    private $emailSent;
    
    /**
     * @var string $totalValue
     *
     * @Column(name="total_value", type="string", nullable=false)
     */
    private $totalValue;

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
     * @var string $comment
     *
     * @Column(name="comment", type="string", length=500, nullable=true)
     */
    private $comment;

    /**
     * @var Order
     *
     * @ManyToOne(targetEntity="DB_Orders")
     * @JoinColumns({
     *   @JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;

    
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
     * Set invoiceCod
     *
     * @param string $invoiceCod
     * @return Invoice
     */
    public function setInvoiceCod($invoiceCod)
    {
        $this->invoiceCod = $invoiceCod;
        return $this;
    }

    /**
     * Get invoiceCod
     *
     * @return string 
     */
    public function getInvoiceCod()
    {
        return $this->invoiceCod;
    }

    /**
     * Set nf
     *
     * @param string $nf
     * @return Invoice
     */
    public function setNf($nf)
    {
        $this->nf = $nf;
        return $this;
    }

    /**
     * Get nf
     *
     * @return string 
     */
    public function getNf()
    {
        return $this->nf;
    }

    /**
     * Set dateCreate
     *
     * @param datetime $dateCreate
     * @return Invoice
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
     * @return Invoice
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
     * Set emailSent
     *
     * @param boolean $emailSent
     * @return Invoice
     */
    public function setEmailSent($emailSent)
    {
        $this->emailSent = $emailSent;
        return $this;
    }

    /**
     * Get emailSent
     *
     * @return boolean 
     */
    public function getEmailSent()
    {
        return $this->emailSent;
    }

    /**
     * Set store
     *
     * @param DB_Store $store
     * @return Invoice
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
     * Set order
     *
     * @param DB_Orders $order
     * @return Invoice
     */
    public function setOrder(\DB_Orders $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return DB_Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
    
    /**
     * Set comment
     *
     * @param string $comment
     * @return Invoice
     */
    public function setComment($comment)
    {
    	$this->comment = $comment;
    	return $this;
    }
    
    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
    	return $this->comment;
    }
    
    /**
     * Set string
     *
     * @param string $totalValue
     * @return Invoice
     */
    public function setTotalValue($totalValue)
    {
    	$this->totalValue = $totalValue;
    	return $this;
    }
    
    /**
     * Get totalValue
     *
     * @return string
     */
    public function getTotalValue()
    {
    	return $this->totalValue;
    }
    
    
    public function create($orderId, $comment = null, $sendEmail = false){
    	
    	$em = Zend_Registry::getInstance()->entitymanager;
    	$tbOrder = new DB_Orders();
    	$order = $em->getRepository('DB_Orders')->find($orderId);
    	
    	// Verifica se já existe fatura com valor total
    	
    	$invoice = $em->getRepository('DB_Invoice')->findByOrder($orderId);
    	if($invoice != null){
    		$sum = 0;
    		
    		// Soma o valor de todas as faturas existentes
    		foreach($invoice as $row){
    			$sum += $row->getTotalValue();    			
    		}
    		
    		// Se o valor da soma for igual ao valor da nova fatura, gera um erro
    		if($sum == $order->getTotalPrice()){
    			return false;
    		}
    		
    	}
    	
    	$random = '';
    	for($i=0; $i <= 4; $i++){
    		$random .= mt_rand(1,9);
    	}
    	$dtNow = new DateTime();
    	$store = $em->getRepository('DB_Store')->find(1);
    	
    	$this->setOrder($order);
    	$this->setInvoiceCod($order->getOrderCod() . '-' . $random);
    	if($comment){
    		$this->setComment($comment);
    	}
    	$this->setTotalValue($order->getTotalPrice());
    	$this->setDateCreate($dtNow);
    	$this->setDateUpd($dtNow);
    	$this->setStore($store);
    	if($sendEmail){
    		$this->setEmailSent(1);
    	}else{
    		$this->setEmailSent(0);
    	}
    	$em->persist($this);
    	$em->flush();
    	
    	$tbOrder->changeStatus($orderId,2);   	
    	
    	return true;
    	
    }

    

    
}