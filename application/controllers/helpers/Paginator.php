<?php

use Doctrine\ORM\Tools\Pagination\Paginator as Paginator;

class Zend_Controller_Action_Helper_Paginator extends Zend_Controller_Action_Helper_Abstract
{
   public function generate($query,$page){
   	
   		$doctrine_paginator = new Paginator($query);
   		
   		$doctrine_paginator_iter = $d2_paginator->getIterator();
   		$adapter =  new Zend_Paginator_Adapter_Iterator($doctrine_paginator_iter);
   		
   		$zend_paginator = new Zend_Paginator($adapter);
   		
   		$zend_paginator->setItemCountPerPage(1)->setCurrentPageNumber($page);
   		
   		return $zend_paginator;
   }
}

?>