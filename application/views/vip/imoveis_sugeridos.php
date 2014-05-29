<script>
function tira_imovel(cod,pret){
			
	$.ajax({
	  type:'POST',
	  url: "<?php echo url::base(true); ?>vip/remove_sugerido",
	  data: ({cod:cod}),	
	  dataType:"json"	,
	  success: function(ret){
		$("#li_"+cod).remove();
	  }
	  });		  	
}

</script>

<ul id='lista_imoveis'>

<?php	
	$user = Auth::instance()->get_user();
	
	$sql = "SELECT pkimovel as id_imovel,objetivo as objetivo from imovel_sugerido where user_id =".$user->id. " ORDER BY sugerido_em desc,id desc";
	$db=new Database;
	$imoveis = $db->query($sql);
	
	if(count($imoveis)>0) //se possui imoveis
	{				
		foreach($imoveis as $i)
		{				
			$imovel = ORM::factory("imovel")->where("pkimovel",$i->id_imovel)->find(); //pega o imovel
			
			if($imovel->loaded)
			{
				$pret = $i->objetivo;
				$url = $imovel->gera_url($pret);
				
				$miniatura = $imovel->pega_miniatura();
				$imagem = (!$miniatura->arqfoto)?("images/sem_foto.gif"):($miniatura->arqfoto );
				$descricao = (!$miniatura->descricao)?("sem foto"):($miniatura->descricao );
				$img = "<a href='$url'>".html::image( array( 'src' => $imagem, 'width' => '200', 'height'=> '120'  ) , array( 'alt' => $descricao ) )."</a>";
				
				echo "<li id='li_".$imovel->pkimovel."'>";			
					echo "<div class='head'>";
						echo "<span class='valor'>";
							if($pret == "venda")echo 'R$'.number_format($imovel->valvenda,2,',','.');	
							if($pret == "locacao")echo 'R$'.number_format($imovel->vallocacao,2,',','.');	
						echo "</span>";					
						echo "<h2>".$imovel->bairro." ".ucfirst(strtolower($imovel->cidade))." - <span>".(($pret=="venda")?("A venda"):("Para Alugar"))."<span></h2>";
						$script = " href=\"javascript:tira_imovel( '$imovel->pkimovel');\" ";
						echo "<a $script  class='seguir_imovel'>Remover imóvel</a>";
					echo "</div>";
					echo "<div class='info'>";
						echo $img;
						echo "<div class='dados'>";
						echo "<span><b>Código: </b>".$imovel->cod_jb."</span>";
						
						$tipos = array("apartamento","sala","loja","predio");
						$true = in_array(strtolower($imovel->tipo),$tipos);
						if($true)
							echo "<p><span>Área Útil:</span> ".number_format($imovel->area_util,0,'','.')."m2</p>";
						else
						{
							echo "<p><span>Área Construída:</span> ".number_format($imovel->area_construida,0,'','.')."m2</p>";
							echo "<p><span>Terreno:</span> ".number_format($imovel->area_terreno,0,'','.')."m2</p>";
						}					
						
						echo "<p><span>Dormitórios:</span> ".$imovel->dorm."</p>";
						echo "<p><span>Garagens:</span> ".$imovel->garagem."</p>";
						if($imovel->valor_cond > 0)
						echo "<p><span>Condomínio:</span> R$".number_format($imovel->valor_cond,2,',','.')."</p>";							
						echo "</div>";
						
						echo "<div class='contato'>";
							echo "<span>Informações de contato</span>";
							echo "<p>Telefone: (19) 2512-0000</p>";
							echo "<p>Email: </p>";
						echo "</div>";
					echo "</div>";
				
				echo "</li>";
			}
			else echo "...";//
		}	
	}
	else
		echo "<li class='padding'><p>Nenhum imóvel ".(($pret=="venda")?("a venda"):("para alugar"))." sugerido.</p></li>";

?>

</ul>