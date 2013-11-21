<?php



class Zend_Controller_Action_Helper_Paginator extends Zend_Controller_Action_Helper_Abstract
{
   public function generate($curPage, $maxPages, $totalItems = null){
   		
   	$html = '';
   	if($totalItems){
   			$html .= '<div class="well clearfix pull-right">' . $totalItems . ' registro(s) encontrado(s)</div>'; 
   		}
   		$html .= '<div class="pagination"><ul>';
   		if($curPage != 1){
   			$previous = $curPage - 1;
   			$html .= '<li>
   					      <a href="?page=' . $previous . '">Anterior</a>
   					  </li>';
   		}
   		
   		for($i=1;$i<=$maxPages;$i++){
   			if($curPage == $i){$html .= '<li class="active">';}else{$html .= '<li>';}  	
   			$html .= '<a href="?page=' . $i . '">' . $i . '</a>';
   			$html .='</li>';   				
   		}
   		
   		if($maxPages != $curPage){   		
   			$nextPage = $curPage + 1;
   			$html.='<li><a href="?page=' . $nextPage . '">Próximo</a></li>';
   		}
   				
   			
   		$html .= '</ul></div>';
   		
   		return $html;
   }
}

?>