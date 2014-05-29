<?php
	//echo "<pre>";
	//print_r($campos);
  $view = new View('painel_filtros');
  $view->campos = $campos;
  $view->filtros = $filtros; 
  $view->render(TRUE);
  
?> 