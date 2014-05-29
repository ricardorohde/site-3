<script>

function troca_frequencia(el,id)
{		
	var v = $(el).val();			
	$.ajax({
		  type:'POST',
		  url: "<?php echo url::base(true); ?>vip/troca_frequencia",
		  data: ({frequencia:v,id:id}),	
		  dataType:"json"		 
	});
}

</script>

<ul id='buscas_salvas' class='lista_vip'>

<?php

	$user = Auth::instance()->get_user();
	$buscas_salvas = $user->alertas; 
	
	if(count($buscas_salvas)>0) //se possui alertas
	{
		echo "<li id='headers'>"; //headers
		echo "<div class='part_1'><span>Buscas</span></div>";
		echo "<div class='part_2'><span>Criação</span></div>";
		echo "<div class='part_3'><span>Alertas</span></div>";
		echo "<div class='part_4'><span>".html::anchor("vip/remover_busca/todas","Deletar todos")."</span></div>";
		
		echo "</li>"; 
				
		foreach($buscas_salvas as $b)
		{
			$filtros = tools::gera_fitro_da_url_amigavel($b->alerta); //vamos gerar o filtro desta url
			
			//echo "<pre>";print_r($filtros);exit;
			$filtros_str = tools::gera_str_dos_filtros($filtros);
						
			echo "<li class='itens'>";
				
				echo "<div class='part_1'>";	
				echo "<span class='cidade'>".(($filtros_str['cidade'])?(ucfirst(strtolower($filtros_str['cidade']))):("Todas as Cidades"))."</span>";	
					echo "<p>";
						echo html::anchor($b->alerta.".html",
						 $filtros_str['tipo']."".
						 $filtros_str['pret']."".
						 $filtros_str['bairro']."".
						 $filtros_str['condominio']."".
						 $filtros_str['faixa_valor']."".
						 $filtros_str['dormitorios']."".
						 $filtros_str['banheiros']."".
						 $filtros_str['garagens'],array("class"=>"busca")					
						);
										
						
						echo html::anchor($b->alerta.".html","[veja a busca]",array("class"=>"link_busca","target"=>"parent"));
					echo "</p>";
				echo "</div>";
				
				echo "<div class='part_2'><p>".date("d/m/Y",strtotime($b->created))."</p></div>";
				
				$opcoes = array(0=>"diario",1=>"semanal",2=>"mensal");
				
				echo "<div class='part_3'>".form::dropdown("frequencia",$opcoes,$b->frequencia, 'onChange="troca_frequencia(this,'.$b->id.')"' )."</div>";
				echo "<div class='part_4'>".html::anchor("vip/remover_busca/".$b->id,"remover",array("class"=>"delete_vip"))."</div>";
				echo "<div class='cb'></div>";
			echo "</li>";
		}	
	}
	else
	echo "<li><p>Você ainda não salvou nenhuma busca</p></li>";

?>

</ul>