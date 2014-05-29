<script type="text/javascript" src="<?=url::base();?>js/oneup.js"> </script>
<script>

var fotos = <?php echo count($row->fotos()); ?>;
var index = 1;
var logado = <?php echo $logado; ?>;
$(document).ready(function() {
	jQuery('button.seguir_imovel').click(function(){  	

	if(logado==1){
	
		var cod = $(this).attr("name");	
		var pret = "<?php echo $pret; ?>";					
		var el = this;
		$.ajax({
		  type:'POST',
		  url: "<?php echo url::base(true); ?>vip/seguir_imovel",
		  data: ({cod:cod,pret:pret}),	
		  dataType:"json",	
		  beforeSend: function(){
			if(logado == 1)						
				$(el).children().html("Carregando");
			
		  },						  
		  success: function(ret){
			
			if(ret)
			{
				cod = cod.split("_");
				if(logado == 1)			
					$(el).toggleClass("remove");
				if(cod[1] == "remove") //se o usuario estava seguindo , agora não esta mais
				{
					$(el).attr("name",cod[0]); //muda o nome para somente o código
					$(el).children().html("Seguir imóvel");	
				}
				else
				{
					if(logado == 1)
					{
						$("#plusone").oneUp({speed:2500,distance:50});
						$(el).attr("name",cod[0]+"_remove"); //muda o nome para código_remove
						$(el).children().html("Seguindo");		
					}
				}
			}
			else alert("Ocorreu algum erro, tente novamente em alguns instantes");
		  }			
		  
		});
	
	}
	
	});
});
function troca(n)
{	

	if(n==1)	
	{
		if( index < fotos )
		{
			index++;
			$("#banner-rotator2 a.right").click();
		}	
	}
	else
	{
		if( index > 1 )
		{
			index--;
			$("#banner-rotator2 a.left").click();
		}	
	}
	muda_atual(index);
	
}

function muda_atual(n)
{
document.getElementById('foto_atual').innerHTML = n;
}
</script>

<section id="bannerinner">

<div class="slider">    
    <div id="banner-rotator2" class="royalSlider rsDefault">
   
<?php
    // foto
    /*
    $foto = $row->pega_foto();
          	if ( ! $foto ):
                echo html::image('images/sem_foto_detalhes.jpg', array("class" => 'foto_imovel', "alt" => $h1, "title" => $h1));
            else:
             */
			$fotos = ORM::factory("foto")->where("pkimovel",$row->pkimovel)->orderby("ordem")->find_all();
            foreach ( $fotos as $imagem):			 
             echo '<div><img src="'.$imagem->arqfoto.'" class="rsImg" /><a href="'.$imagem->arqfoto.'" class="tela_inteira fancybox" rel="gallery"><span></span><p>Tela inteira</p></a><img src="'. $imagem->arqfoto.'"  alt="'. $h1 . ' '. $imagem->descricao .'" title="'.$h1. ' '. $imagem->descricao . '" class="foto_imovel rsTmb" width="96" height="72"/></div>';
             // echo '<div><img src="'.$imagem->arqfoto.'" class="rsImg rsABlock" data-speed="10000" data-fade-effect="false" data-move-effect="bottom" data-move-offset="'.$h.'" /><img src="'. $imagem->arqfoto.'"  alt="'. $h1 . ' '. $imagem->descricao .'" title="'.$h1. ' '. $imagem->descricao . '" class="foto_imovel rsTmb" width="96" height="72"/></div>';
             endforeach;

            //endif;

?>
    </div>    
	
    </div>
</section><!-- banner -->


<div id="menu" class="default">
<div id="bgheading">



<div class="wrapper">

<?php
    echo '<h3><span>';
	echo "<strong>";
	if($row->consulta == 1)
	{echo "Valor sob consulta";}
	elseif( $this->uri->segment(1) == "venda" ) echo 'R$'.number_format($row->valvenda,2,',','.');	
    elseif( $this->uri->segment(1) == "locacao" ) echo 'R$'.number_format($row->vallocacao,2,',','.');
	echo "</strong>&nbsp;-&nbsp;";
    // linha com código, cidade e bairro     
      echo $row->bairro . ', ';
      echo $row->cidade . ', ';
      echo $row->dorm . ' dormitórios';
      //echo 'Código: ' . '<strong>' . $row->cod_jb . '</strong>';
    echo '</span></h3>';
	
	$disponivel = 0;
	$txt = "venda";
	if( ($this->uri->segment(1) == "venda") and ($row->vallocacao > 0) ) //tb disponivel pra locaçao
		{$disponivel = $row->vallocacao; $txt = "a locação";}
	elseif( ($this->uri->segment(1) == "locacao") and ($row->valvenda > 0))	
		$disponivel = $row->valvenda;		
		if($disponivel > 0)
			echo "<div id='disponivel'><span>Disponível para ".$txt.": </span><strong>R$".number_format($disponivel,2,',','.')."</strong></div>";
	
    ?>

    <div class="photolist">
    
   <?php /* <p><a href="http://maps.google.com/maps?q=<?php echo "Brasil+".$row->uf."+".$row->cidade."+".$row->bairro;?>&t=h&z=17" class="fancybox_ajax iframe"> Ver o mapa <!--img src="images/icon_home02.png" alt="Home"--> </a></p> */ ?>
    
    </div>

    <div class="bgbuttons">
    <div class="buttons">
	
	<?php	
		$name_seguir = $row->pkimovel;	
		$classe_seguir = "seguir_imovel";
		$title_seguir = "Seguir Imóvel";	
		$link = "";
		$rel = "";
		if($logado==1)
		{				
			if($imovel_seguindo)
			{
				$classe_seguir .= " remove";
				$title_seguir = "Seguindo";
				$name_seguir .= "_remove";
			}			
		}
		else
		{	
			$classe_seguir .= " fancybox_ajax";
			$link = "href='".url::base(true)."vip/form_cadastro?imovel=".$row->pkimovel."&pret=".$pret."&referrer=".url::current()."'";
		}
		
	?>
	
    <div class="button">		
			<span class='plusone' id='plusone'>+1</span><?php echo "<button name='".$name_seguir."' class='".$classe_seguir."' ".$link."><span>".$title_seguir."</span></button>"; ?>
	</div>
    <!-- <div class="button"><a href="#" class="messages"><span>Compartilhar</span></a></div> -->
	
	<!-- AddThis Button BEGIN -->
		<div class="button addthis_toolbox addthis_default_style ">
			<a class="messages addthis_button_compact"><span>Compartilhar</span></a>
		</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true}; var addthis_share = {"url":"<?php echo site::url_padrao()."/".url::current();?>"}</script>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5124faf37144b4e5"></script>
	<!-- AddThis Button END -->
	
    </div>
    </div>


	
	
</div>
</div>
</div>

<section id="middlecontent">
<section class="wrapper">

    <div class="leftinfo">
        <div class="links">
        <div class="set">


        <?php
		
		  $tipo_1 = array("casa", "chacara", "sitio", "hotel" ,"predio" );
		  $tipo_2 = array("apartamento", "sala", "salao", "galpao", "loja");
		  $tipo_3 = array("terreno","area");

		  $area = 0;
		
		  $true = in_array(strtolower($row->tipo), array("terreno","area","salao","galpao","loja","sala") );

		  $area = ( in_array(strtolower($row->tipo),$tipo_1) )?($row->area_construida):($area);			
		  $area = ( in_array(strtolower($row->tipo),$tipo_2) )?($row->area_util):($area);			
		  $area = ( in_array(strtolower($row->tipo),$tipo_3) )?($row->area_terreno):($area);			
		
		  echo '<p>' . round($area) . ' <span>m2</span> </p>';
		  if(!$true){
			echo '<p>' . $row->dorm . ' <span>dormitórios</span> </p>';
		    echo '<p>' . $row->suite . ' <span>suítes</span> </p>';
		  }

		?>

        </div>

        <div class="set">
		
        <?php
			echo '<p>' . $row->banheiro . ' <img src="images/icon_people.gif" alt=""></p>';
			echo '<p>' . $row->garagem . ' <img src="images/icon_car.gif" alt=""></p>';
		?>
		
        <p class="icon">
	    
		
		
        
        <!--a href="#"><img src="images/icon_play.png" alt="Play"></a-->
        </p>
        </div>
        </div>

        <div class="details">
        <h4><span>Descrição do imóvel</span></h4>
        <aside>
        <p><?= $row->descricao; ?></p>

        <div class="buttonconnect"><button class="green" onclick="javascript:window.open('http://talkcorp.com.br/apps/grupounion/1925120000/','liguegratis','width=530,height=400,top=0,left=0,scrollbars=no,status=no,toolbar=no,location=no,directories=no, menubar=no,resizable=no,fullscreen=no')"><span>Ligue grátis</span></button></div>
        </aside>
        </div>

		<?php
		
			$rows = array(-1 => "gray",1 => "");
			$index = -1;
		
		?>
        <div class="details right">
        <h4><span>Ficha completa</span></h4>
        <ul>
        <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Tipo</span>
			<span class="tipo"><?= $row->tipo;?></span>
        </li>

       <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Finalidade: </span>
			<span class="tipo"><?= $row->finalidade;?></span>
        </li>

        <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Cidade /Estado :</span>
			<span class="tipo"><?= $row->cidade . '/' . $row->uf;?></span>
        </li>

        <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Bairro:</span>
			<span class="tipo"><?= $row->bairro;?></span>
        </li>

		<?php
					
			if(!$true)
			{
		?>
		
        <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Dormitórios / Suítes:</span>
			<span class="tipo">
				<?php echo $row->dorm; ?>
				<?php if( $row->suite > 0 ) echo "(".$row->suite.")"; ?>
			</span>
        </li>

		<?php } ?>
		
         <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Vagas:</span>
			<span class="tipo"><?= $row->garagem;?></span>
        </li>

        <li class="<?php echo $rows[($index*=-1)]?>">
			<span class="tipo">Banheiros:</span>
			<span class="tipo"><?= $row->banheiro;?></span>
        </li>

		 <?php
		
			$tipos = array("apartamento","sala","loja","predio");
			$true = in_array(strtolower($row->tipo),$tipos);
			if( $true )
			{
		?>		
			 <li class="<?php echo $rows[($index*=-1)]?>">
				<span class="tipo">Área Útil:</span>
				<span class="tipo"><?= $row->area_util ?> M2</span>
			</li>		
		<?php }
			else
			{
		?>		
			  <li class="<?php echo $rows[($index*=-1)]?>">
				<span class="tipo">Área construída:</span>
				<span class="tipo"><?= $row->area_construida ?> M2</span>
			</li>
			
			  <li class="<?php echo $rows[($index*=-1)]?>">
				<span class="tipo">Terreno:</span>
				<span class="tipo"><?= $row->area_terreno ?> M2</span>
			</li>
			
		<?php }
		
		if($true){
		?>
			 <li class="<?php echo $rows[($index*=-1)]?>">
				<span class="tipo">Valor do condomínio:</span>
				<span class="tipo">R$ <?= $row->valor_cond ?></span>
			</li>
		<?php } ?>
        </ul>
        </div>
    </div>


    <div class="rightinfo">
		<? if($mostra_semelhantes){ ?>
        <div class="links">
        <p> <?php echo $busca_url; ?></p>
        <p class="right"><span class="prev"><a href="<?php echo $imovel_prev_url; ?>">Anterior</a> </span>  <span>|  </span><span class="next"> <a href="<?php echo $imovel_next_url; ?>">Próximo</a></span></p>
        </div>
		<? } ?>

		<script>

				
			function validar(form_id) {			 
			   var ret = true;				
			   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			   var address = form_id.email.value;
			   var nome =  form_id.nome.value;
			   var fone =  form_id.fone.value;
			   
			    if(nome==null || nome=="")
			   {
			    alert("Insira seu nome!");
				ret = false;
				}
			   
			   if(reg.test(address) == false) {			 
				  alert('Endereço de email inválido!');
				  ret= false;
			   }  
			  
				
			   if(fone==null || fone=="")
			   {
			    alert("Insira seu telefone!");
				ret= false;
				}
				return ret;
			}

		</script>
		
        <div class="form">
        <form action="<?=url::base();?>index.php/envia_form/send/agente" method="post" id="form_info" onsubmit="return validar(this);">
        <fieldset>
        <h4>Solicitar informações</h4>
        <h2><?= $row->cod_jb ;?></h2>
        <ul>
			<input name="imovel" type="hidden" value="<?php echo $row->cod_jb ;?>" />
		
        <li><input name="nome" type="text" class="input" placeholder="Nome:" /></li>

        <li><input name="email" type="text" class="input" placeholder="E-mail:" /></li>

        <li><input name="fone" type="text" class="input" placeholder="Telefone:" /></li>

        <li><textarea name="mensagem" cols="" rows="" class="textarea" placeholder="Mensagem:" ></textarea></li>
        </ul>

        <div class="buttons"><input name="" type="submit" class="button" value="Contate um agente"></div>
        <p>Ao enviar você aceita nossos Termos de Uso <br /> e Política de Privacidade</p>
        </fieldset>
        </form>
        </div>
    </div>


    <!--div class="bottominfo">
    	<h3>Bairro Cambuí</h3>

        <div class="article">
        <p><span>Nós conhecemos este bairro e o mercado como ninguém.</span></p>
        <p>Cambuí é o nome de um bairro (inspirado na árvore Cambuí) localizado na região central de Campinas, iniciando na avenida José de Sousa Campos até o Centro de Convivência. O bairro possui uma infra-estrutura bastante completa, com mercados, lojas, restaurantes, bares, hotéis, clubes, teatros etc. É cercado pelos bairros: Centro, Vila Colúmbia, Taquaral, Guanabara, Vila Estanislau, Vila Nova Campinas e Chácara da Barra.</p>

        <p>Trata-se de um bairro tradicional e antigo da cidade. O lugar onde hoje se localiza o largo Santa Cruz e praça 15 de Novembro, foi um dos três descampados (ou campinhos) onde Campinas começou, em 1774.</p>

        <div class="buttonconnect"><a href="#" class="blue"><span>Baixe as informações</span></a></div>
        </div>

        <div class="aside">
        <figure><img src="images/screenshoot02.jpg" alt="ScreenShoot" /></figure>
        <div class="buttonconnect"><a href="#"><span>Conheça NextMobile</span></a></div>
        </div>
    </div-->

</section><!-- wrapper -->
</section><!-- middle content -->





<?php 

if( isset( $semelhantes ) ){
	if(count($semelhantes['resultados']) > 0){
?>

<section id="recents" class="whitebg">
<section class="wrapper">

    <h4><span>Você tem bom gosto</span> <br /> talvez goste destes também</h4>
    <div class="slider">
        <div id="slider-ajax-container">
        <ul id="banner-rotator" class="royalSlider rsDefault">
       
        
<?php        
		$numero = 0;
		foreach( $semelhantes['resultados'] as $row ){
		  if($numero == 0)
			echo '<li class="royalSlide">';
		  echo '<article>';
		  // imagem
		  $miniatura = $row->pega_miniatura();
		  if ( ! $miniatura ):
			  echo html::anchor( $row->gera_url($pret,false,false) , html::image( array( 'src' => 'images/sem_foto.gif', 'width' => '180', 'height'=> '100'  ) , array( 'alt' => 'sem foto' ) )  );
		  else:
			  $imagem = '<img src="'. $miniatura->arqfoto .'" alt="'.$miniatura->descricao.'" width="180" height="100" />';
			  echo html::anchor( $row->gera_url($pret,false,false) , $imagem  );
		  endif;
			if($row->consulta==1)
			{$preco = "Valor sob consulta";}
		  else
			{$preco = "R$ ".number_format( ( $this->uri->segment(1) == "venda") ? ($row->valvenda):($row->vallocacao) ,2,',','.');}
		  //echo '<h4>'.html::anchor($row->gera_url(), $row->bairro_sinonimo() ) . '</h4>';
		  echo '<p><span>'. $row->bairro_sinonimo() .'</span><br/>' .$preco.'</p>';
		  echo '</article>';

		  if($numero == 4){
			echo '</li>';
			$numero = 0;
		  }else{ $numero ++; }
		}
?>
</li>
        </ul>
        
        </div>
    </div>
</section>
<!-- wrapper -->
</section><!-- recents -->

<?php }} ?>