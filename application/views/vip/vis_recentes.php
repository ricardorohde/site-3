<ul id='lista_imoveis'>

<?php
	//mesmo esquema do buscas salvas, nem mudei o nome das variaves, fiz alguns ajustes só

	$imoveis = explode("/",cookie::get("imoveis_recentes","")); 
	array_pop($imoveis);
	$imoveis = array_reverse($imoveis);
	
	if(count($imoveis)>0) //se possui imoveis
	{				
		foreach($imoveis as $i)
		{
			$i = explode("_",$i);
			$codigo = strtoupper($i[0]);
			$pret = $i[1];			
			$imovel = ORM::factory("imovel")->where("pkimovel",$codigo)->find(); //pega o imovel
			
			if($imovel->loaded)
			{
				$url = $imovel->gera_url($pret);
				
				$miniatura = $imovel->pega_miniatura();
				$imagem = (!$miniatura->arqfoto)?("images/sem_foto.gif"):($miniatura->arqfoto );
				$descricao = (!$miniatura->descricao)?("sem foto"):($miniatura->descricao );
				$img = "<a href='$url'>".html::image( array( 'src' => $imagem, 'width' => '200', 'height'=> '120'  ) , array( 'alt' => $descricao ) )."</a>";
				
				echo "<li>";			
					echo "<div class='head'>";
						echo "<span class='valor'>";
							if($pret == "venda")echo 'R$'.number_format($imovel->valvenda,2,',','.');	
							if($pret == "locacao")echo 'R$'.number_format($imovel->vallocacao,2,',','.');	
						echo "</span>";					
						echo "<h2>".$imovel->bairro." ".ucfirst(strtolower($imovel->cidade))." - <span>".(($pret=="venda")?("A venda"):("Para Alugar"))."<span></h2>";
					echo "</div>";
					echo "<div class='info'>";
						echo $img;
						echo "<div class='dados'>";
							echo "<span><b>Código: </b>".$imovel->cod_jb."</span>";
							echo "<p><span>Dormitórios:</span> ".$imovel->dorm."</p>";
							echo "<p><span>Garagens:</span> ".$imovel->garagem."</p>";
							if($imovel->valor_cond > 0)
							echo "<p><span>Condomínio:</span> R$".number_format($imovel->valor_cond,2,',','.')."</p>";
							echo "<p><span>Área Construída:</span> ".number_format($imovel->area_util,0,'','.')."m2</p>";
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
		echo "<li><p>Nenhum imóvel visualizado recentemente</p></li>";

?>

</ul>