<?php

class Zend_Controller_Action_Helper_TableMaker extends Zend_Controller_Action_Helper_Abstract
{
    
    public function create($tableClass = null, $onlyData = null, $data = null){
        
        $html = '';
        if($onlyData == false){
            $html = "<table";
        }else{
            $tableclass = null;
        }        
        if($tableClass){
            $html.='class ="' . $tableClass . '">';
        }
        if($data){
            foreach($data as $row){                 
                 if($row->getStatus() == '1'){
                     $status = '<a href="/admin238/product/disable?product_id='.$row->getId().'">
                     <i class="splashy-gem_okay"></i>Ativo';}else{
                     $status = '<a href="/admin238/product/enable?product_id='.$row->getId().'"><i class="splashy-gem_remove"></i>Desabilitado</a>';}            
                 $html.= "<tr class='result'>";
                 $html.= "<td>" . '<input type="checkbox" name="row_sel" class="row_sel" value="' . $row->getId() . '"/></td>';
                 $html.= "<td>" . $row->getId() . "</td>";
                 $html.= "<td></td>";
                 $html.= "<td>" . $row->getName() . "</td>";
                 $html.= "<td>" . $row->getSku() . "</td>";
                 $html.= "<td></td>";
                 $html.= "<td></td>";
                 $html.= "<td>" . $status . "</td>";
                 $html.= "</tr>";
            }
        }
        
        return $html;
        
    }
    
}