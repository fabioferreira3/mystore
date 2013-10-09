<?php

class Zend_Controller_Action_Helper_EM extends Zend_Controller_Action_Helper_Abstract
{
    public function db($dbname){
        
       $registry = Zend_Registry::getInstance();
       $repo = $registry->entitymanager;
       
       return $repo->getRepository('DB_' . $dbname);
       
    }
    
    public function em(){
        $registry = Zend_Registry::getInstance();
        return $registry->entitymanager;
    }
}

?>