<?php
$site = "http://nextsolucoesimobiliarias.com.br/novo/";
 ?>
<body style='background-color:#e1e1e1;font-family:verdana;font-size:12px;padding-top: 10px;color: #333333;'>

<div style='background-image:url("<?php echo $site;?>images/email/bg_top.jpg");width:599px;height:217px;position:relative;margin: 0 auto;'>

<a href='<?php echo $site;?>' style=' float: left;margin: 20px 10px 10px;'>
	<img src='<?php echo $site;?>images/email/logo.png' alt='Next'/>
</a>

<div style="float: right;width: 440px;margin-top: 20px;">
<ul style='list-style: none outside none;position:absolute;right:40px;top: 50px;'>
	<li style='float:left'> <a href='<?php echo $site;?>index.php/imoveis_a-venda.html' style="text-decoration:none;color:#60605e">Comprar imóveis</a>|</li>
	<li style='float:left;margin-left: 7px;'> <a href='<?php echo $site;?>index.php/imoveis_para-alugar.html' style="text-decoration:none;color:#60605e">Alugar imóveis</a>|</li>
	<li style='float:left;margin-left: 7px;'> <a href='<?php echo $site;?>' style="text-decoration:none;color:#60605e">Aplicativo</a>|</li>
	<li style='float:left;margin-left: 7px;'><a href='www.facebook.com.br/next'><img src='<?php echo $site;?>images/email/facebook.jpg'/></a></li>
	<li style='float:left;margin-left: 7px;'><a href='www.facebook.com.br/next'><img src='<?php echo $site;?>images/email/twitter.jpg'/></a></li>
</ul>
</div>

<h1 style='display: block;font-size: 37px;font-weight: normal;padding-top: 110px;text-align: center;color: #333333;'>Busca que estou <span style='font-weight: bold;color: #333333;'>Seguindo</span></h1>

<p style='background-color:#FFFFFF;margin: 0; padding: 10px; width: 579px;'>Ficamos felizes de notificá-lo sobre novos imóveis em nosso portfólio, que  estão dentro da especificação de sua busca. <a href='<?php echo url::base(true);?>vip'>Se preferir visualize em seu espaço no site</a></p>

</div>
<div style='width:599px;height:7px;margin:0 auto'></div>
<div style="margin: 0px auto; background-color: rgb(242, 242, 242); padding: 20px; width: 559px;">

<span style="font-weight: bold; color: #292929;">Busca Salva</span>
<span style=' color: #5B889D;display: block;font-weight: bold;'>Campinas</span>
<p style='margin:0'><?php echo $busca; ?></p>
</div>
<div style='width:599px;height:7px;margin:0 auto'></div>
<div style='width:599px;margin: 0 auto;'>
	<ul style='list-style:none;padding:0;margin:0'>
		<?php
			foreach($imovel as $i)
			{
				$miniatura = $i->pega_miniatura();
				$imagem = (!$miniatura->arqfoto)?($site."images/sem_foto.gif"):($miniatura->arqfoto );
			
				echo "<li style='background-color:#f2f2f2;position: relative;margin: 0 !important;'>";
						echo "<div style=' float: left;padding: 10px 0 10px 10px;width: 540px;'>";
						echo "<div style='float: left;width: 355px;'>";
							echo "<a href='".($site.$i->gera_url())."' style='color: #5B889D; display: block; font-size: 18px; padding-bottom: 10px; text-decoration: none;'>".($i->bairro." ".$i->cidade)."<a/>";
							echo "<img src='".$imagem."' style='float:left;width:200px;height:120px'/>";
							echo "<p style='overflow: hidden; padding: 5px 0 5px 10px;color: #6B6A70;margin:0'><span style='font-weight: bold;'>Dormitórios: </span>".$i->dorm."</p>";						
							echo "<p style='overflow: hidden; padding: 5px 0 5px 10px;color: #6B6A70;margin:0'><span style='font-weight: bold;'>Garagens: </span>".$i->garagem."</p>";
							if($i->valor_cond>0) echo "<p style='overflow: hidden; padding: 5px 0 5px 10px;color: #6B6A70;margin:0'><span style='font-weight: bold;'>Condomínio: </span>R$".number_format($i->valor_cond,2,',','.')."</p>";
							echo "<p style='overflow: hidden; padding: 5px 0 5px 10px;color: #6B6A70;margin:0'><span style='font-weight: bold;'>Área construída: </span>".$i->area_util." m2</p>";
						echo "</div>";
						echo "<div style=' position: absolute;right: 60px;top: 59px;'>";
							echo "<span style='color:#5B889D; display: block; font-size: 18px; font-weight: bold;text-align: right;'>R$".number_format( ($pret=="venda")?($i->valvenda):($i->vallocacao),2,',','.')."</span>";
							echo "<span style='color:#6B6A70;display: block; font-size: 12px; text-align: right;'>código: ".$i->cod_jb."</span>";
						echo "</div>";
						echo "<div style='clear:both'></div>";	
					echo "</div>";
					echo '<div style=" background-color: #4B788D;float: right;min-height: 213px;width: 40px;"></div>';
					echo "<div style='clear:both'></div>";					
				echo "</li>";	
				echo "<li style='width:599px;height:7px'></li>";
			}
		?>
	</ul>
</div>

<div style='background-image:url("<?php echo $site;?>images/email/bg_bottom.jpg");width:599px;height:242px;position: relative;margin: 0 auto;'>

	<div style=' float: left;padding: 30px 0 0 30px;width: 310px;'>
		<h2 style='color:#e0ad45'>Download o App Next Mobile</h2>
		<p style='color:#1d1d1d'>Navegue por imóveis nas proximidades, com fotos, detalhes, informaçòes do bairro em seu Android, IPad ou Iphone.</p>
		<a href='#'><img src='<?php echo $site;?>images/email/app.jpg'/></a>
	</div>
	<img style='margin-left: 30px; margin-top: 55px;' src='<?php echo $site;?>images/email/mobile.jpg'/>

</div>

<div style='width:599px;height:242px;position: relative;margin: 0 auto;'>
<p style='display:block;width:100%;text-align:center'> Campinas-SP <span style=' color: #1B1B1B;font-weight: bold;'>(19) 2512-0000</span></p>
<a href='<?php echo $site;?>' style='display: block;text-align: center;'><img src='<?php echo $site;?>images/email/logo_footer.jpg'/></a>
<p style='color: #898989;display: block;text-align: center;'>Av. Dr. Jesuíno Marcondes Machado, 440. Nova Campinas 
<br>CEP: 13.092-108, Campinas
</p>
<p style="text-align: center;">
	<a href='www.facebook.com.br/next' style=''><img src='<?php echo $site;?>images/email/facebook_footer.jpg'/></a>
	<a href='www.facebook.com.br/next' style=''><img src='<?php echo $site;?>images/email/twitter_footer.jpg'/></a>
</p>
</div>

</body>
