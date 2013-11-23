<?php

class Zend_Controller_Action_Helper_ClientTableMaker extends Zend_Controller_Action_Helper_Abstract
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
            if($row->getStatus() == 0){$status = 'Inativo';}else{$status = 'Ativo';}  
            if($row->getLastLogin() !== null){$lastLogin = $row->getLastLogin()->format('d/m/Y');}else{$lastLogin = '';}     
           		 $html.='<tr>';
           		 $html.='<td><input type="checkbox" name="row_sel" class="row_sel" /></td>';
           		 $html.='<td>'. $row->getFirstName() . ' ' . $row->getLastName() .'</td>';
           		 $html.='<td>'. $row->getEmail() .'</td>';
           		 $html.='<td>'. $row->getAddress()[0]->getState()->getName() .'</td>';
           		 $html.='<td>'. $row->getAddress()[0]->getCountry()->getName() .'</td>';
           		 $html.='<td>'. $row->getDateCreate()->format('d/m/Y') .'</td>';
           		 $html.='<td>'. $lastLogin .'</td>';
           		 $html.='<td>' . $status .'</td>';
           		 $html.='<td><a href="/admin238/customer/edit/id/'. $row->getId() .'" class="sepV_a" title="Editar"><i class="icon-pencil"></i></a></td>';
                 $html.= "</tr>";
            }
        }
        
        return $html;
        
    }
    
}