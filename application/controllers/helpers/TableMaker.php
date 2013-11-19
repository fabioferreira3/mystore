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
            	if (isset($row['images']) && $row['images']){
            		$imagePath = '/images/catalog/' . $row['product']->getId() . '/' . $row['images'][0]->getName();
            		$thumbPath = '/images/catalog/' . $row['product']->getId() . '/thumbnail/' . $row['images'][0]->getName();
            	};
            	if(isset($row['price']) && $row['price']){
            		$price = 'R$' . $row['price']->getPrice();
            	}            
                $editUrl = '/admin238/product/edit?product_id=' . $row['product']->getId();     
                 if($row['product']->getStatus() == '1'){
                     $status = '<a href="/admin238/product/disable?product_id='.$row['product']->getId().'">
                     <i class="splashy-gem_okay"></i>Ativo';}else{
                     $status = '<a href="/admin238/product/enable?product_id='.$row['product']->getId().'"><i class="splashy-gem_remove"></i>Desabilitado</a>';}            
                 $html.= "<tr class='result'>";
                 $html.= "<td>" . '<input type="checkbox" name="row_sel" class="row_sel" value="' . $row['product']->getId() . '"/></td>';
                 $html.= "<td>" . $row['product']->getId() . "</td>";
                 $html.= "<td style='width: 60px'><a href='" . $imagePath . "' title='' class='cbox_single thumbnail'> <img alt='' src='" . $thumbPath . "' style='height: 50px; width: 50px'></a></td>";
                 $html.= "<td>" . $row['product']->getName() . "</td>";
                 $html.= "<td>" . $row['product']->getSku() . "</td>";
                 $html.= "<td>" . $price . "</td>";
                 $html.= "<td>" . $row['stock']->getCurrentQty() . "</td>";
                 $html.= "<td>" . $status . "</td>";
                 $html.= "<td><a href='" . $editUrl . "' class='sepV_a' title='Editar'><i class='icon-pencil'></i></a> <a href='#' title='Remover'><i class='icon-trash'></i></a></td>";
                 $html.= "</tr>";
            }
        }
        
        return $html;
        
    }
    
}