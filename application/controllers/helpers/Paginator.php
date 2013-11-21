<?php



class Zend_Controller_Action_Helper_Paginator extends Zend_Controller_Action_Helper_Abstract
{
   public function generate($qtyPages, $curPage, $maxPages){
   	
   		$html = '<div class="pagination"><ul>';
   		$html .= '<li>
					<a href="#">Anterior</a>
				</li>
				<li class="active">
					<a href="#">1</a>
				</li>
				<li>
					<a href="#">2</a>
				</li>
				<li>
					<a href="#">Próximo</a>
				</li>
			';
   		
   		$html .= '</ul></div>';
   
   }
}

?>