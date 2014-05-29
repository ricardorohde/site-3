<ul id='buscas_salvas' class='lista_vip'>

<?php

	$user = Auth::instance()->get_user();
	
	$sql = "SELECT * from busca_sugerida where user_id =".$user->id. " ORDER BY sugerida_em desc,id desc";
	$db=new Database;
	$buscas_salvas = $db->query($sql);
	
	if(count($buscas_salvas)>0) //se possui buscas
	{
		echo "<li id='headers'>"; //headers
		echo "<div class='part_1'><span>Buscas</span></div>";
		echo "<div class='part_2'><span>Sugerida em</span></div>";
		echo "<div class='part_3'><span>Sugerida por</span></div>";
		echo "<div class='part_4'><span>".html::anchor("vip/remover_busca_sugerida/todas","Deletar todos")."</span></div>";
		
		echo "</li>"; 
				
		foreach($buscas_salvas as $b)
		{
			$filtros = json_decode($b->filtro_json, true);
			$url_base = 'imoveis/lista';
            $url = $url_base . '?';
						
			if ( isset($filtros['objetivo']) )$url .= "&pret=" . $filtros['objetivo'];
            if ( isset($filtros['tipo']) )$url .= "&tipo=" . strtolower($filtros['tipo']);
            if ( isset($filtros['finalidade']) ) $url .= "&finalidade=" . $filtros['finalidade'];
            if ( isset($filtros['cidade']) ) $url .= "&cidade=" . $filtros['cidade'];
            if ( isset($filtros['bairro'])) $url .= "&bairro=" . $filtros['bairro'];
				
			$pret = ($filtros['objetivo']=="venda")?("Venda"):("Locacao");
	
			//faixa de valores
				$valorFrom = "qualquer-valor";
				if( isset( $filtros["valor".$pret."From"] ) )
				{
					$sql = "SELECT slug from faixas_valor_".$filtros['objetivo']." where preco =".$filtros["valor".$pret."From"];
					$db=new Database;
					$valorFrom = $db->query($sql);
					$valorFrom = $valorFrom[0]->slug;
				}
				
				$valorTo = "qualquer-valor";
				if( isset( $filtros["valor".$pret."To"] ) )
				{
					$sql = "SELECT slug from faixas_valor_".$filtros['objetivo']." where preco =".$filtros["valor".$pret."To"];
					$db=new Database;
					$valorTo = $db->query($sql);
					$valorTo = $valorTo[0]->slug;
				}			
			
			//==============
		
			$faixa_valor = $valorFrom."-a-".$valorTo;
			if($faixa_valor == "qualquer-valor-a-qualquer-valor")
				$faixa_valor = "";
				
            $url .= "&faixa_valor=" . $faixa_valor;		
            if ( isset($filtros['banheiros']) ) $url .= "&banheiros=banheiros-" . $filtros['banheiros'];
            if ( isset($filtros['dormitorios']) ) $url .= "&dormitorios=dormitorios-" . $filtros['dormitorios'];
            if ( isset($filtros['garagens']) ) $url .= "&garagens=garagens-" . $filtros['garagens'];
			//echo $url;exit;
		
			$link_busca = tools::trata_url_imovel( $url,null,false,true );
			//echo $link_busca;exit;
			$filtros = tools::gera_fitro_da_url_amigavel($link_busca);
			
			//echo "<pre>";print_r($filtros);exit;
			$filtros_str = tools::gera_str_dos_filtros($filtros,true);
			//echo "<pre>";print_r($filtros_str);exit;	
			echo "<li class='itens'>";
				
				echo "<div class='part_1'>";	
				echo "<span class='cidade'>".(($filtros_str['cidade'])?(ucfirst(strtolower($filtros_str['cidade']))):("Todas as Cidades"))."</span>";	
					echo "<p>";
						echo html::anchor($link_busca.".html",
						 $filtros_str['tipo']."".
						 $filtros_str['pret']."".
						 $filtros_str['bairro']."".
						 $filtros_str['finalidade']."".
						 $filtros_str['condominio']."".
						 $filtros_str['faixa_valor']."".
						 $filtros_str['dormitorios']."".
						 $filtros_str['banheiros']."".
						 $filtros_str['garagens'],array("class"=>"busca")					
						);
										
						
						echo html::anchor($link_busca.".html","[veja a busca]",array("class"=>"link_busca","target"=>"parent"));
					echo "</p>";
				echo "</div>";
				
				echo "<div class='part_2'><p>".date("d/m/Y",strtotime($b->sugerida_em))."</p></div>";
				
				
				
				echo "<div class='part_3'>".$b->sugerida_por."</div>";
				echo "<div class='part_4'>".html::anchor("vip/remover_busca_sugerida/".$b->id,"remover",array("class"=>"delete_vip"))."</div>";
				echo "<div class='cb'></div>";
			echo "</li>";
		}	
	}
	else
	echo "<li><p>Você ainda não salvou nenhuma busca</p></li>";

?>

</ul>