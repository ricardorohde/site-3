<ul id='buscas_salvas' class='lista_vip'>

<?php
 //mesmo esquema do buscas salvas, nem mudei o nome das variaves, fiz alguns ajustes só

	$buscas_salvas = explode("/",cookie::get("buscas_recentes","")); 
	array_pop($buscas_salvas);
	//print_r($buscas_salvas);exit;
	if(count($buscas_salvas)>0) //se possui alertas
	{
		echo "<li id='headers'>"; //headers				
		echo "</li>"; 
		
		$tipos = ORM::factory("tipo")->select_list("slug","tipo");	//array com os filtros, pra nao carregar toda vez, já que é pequeno	
		
		foreach($buscas_salvas as $b)
		{
			$filtros = tools::gera_fitro_da_url_amigavel($b); //vamos gerar o filtro desta url
			
			$filtros_str = tools::gera_str_dos_filtros($filtros);
			
			echo "<li class='itens'>";
				
				echo "<div>";	
				echo "<span class='cidade'>".(($filtros_str['cidade'])?(ucfirst(strtolower($filtros_str['cidade']))):("Todas as Cidades"))."</span>";	
				echo "<p>";
				echo $filtros_str['tipo'];
				echo $filtros_str['pret'];
				echo $filtros_str['bairro'];
				echo $filtros_str['condominio'];
				echo $filtros_str['faixa_valor'];
				echo $filtros_str['dormitorios'];
				echo $filtros_str['banheiros'];
				echo $filtros_str['garagens'];				
				echo "</p>";
				echo html::anchor($b.".html","veja a busca",array("id"=>"veja_busca","target"=>"parent"));
				echo "</div>";
				
				echo "<div class='cb'></div>";
			echo "</li>";
		}	
	}
	else
	echo "<li><p>Nenhuma busca foi feita recentemente</p></li>";

?>

</ul>