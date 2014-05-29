
<section id="banner_home_lancamento" class='lancamento'>
	
		<!-- <img src="images/slide_banner02.jpg" alt="banner" />	-->
		<?php
			for($i=1;$i<=$lancamentos;$i++){
			  echo "<div class='item'>";
				echo "<img src='".$dir."/img_".$i.".jpg' />";
				echo "<div class='info'><h2>Lançamentos</h2>";
				echo "<p>Empreendimentos diferenciados, apresentados <br>em primeira mão aos clientes da Next.</p>";
				echo "<a href='http://nextsim.com.br/lancamentos/' target='blank'> >> Confira as melhores oportunidades do mercado</a></div>";
			  echo "</div>";
			}
		?>
	
</section><!-- banner -->

<section id="acoes">
<section class="wrapper">

	<div id='block1'>
		<?php echo html::anchor('imoveis_a-venda.html','<h3><strong>Comprar</strong> imóveis</h3>' ); ?>
		<p>Encontrar o imóvel ideal para você é o nosso negócio. Conheça nossa carteira, teremos prazer em atendê-lo.</p>
		<p>&nbsp;</p>
		<p>Desejo encontrar <?php echo html::anchor('imoveis_a-venda.html','imóveis para comprar' ); ?></p>
	</div>
		
	<div id='block2'>
		<?php echo html::anchor('imoveis_para-alugar.html','<h3><strong>Alugar</strong> imóveis</h3>' ); ?>
		<p>De prédios e galpões a apartamentos. Encontre o imóvel ideal para sua necessidade.</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>Desejo encontrar <?php echo html::anchor('imoveis_para-alugar.html','imóveis para alugar' ); ?></p>
	</div>
		
	<div id='block3'>
		<?php echo html::anchor('exclusividade','<h3><strong>Negociar</strong> seu imóvel</h3>' ); ?>
		<p>Venda ou alugue seu imóvel pelo valor justo e com atendimento exclusivo. Deixe o trabalho duro conosco.</p>
		<p>&nbsp;</p>
		<p>Desejo <?php echo html::anchor('exclusividade','negociar meu imóvel' ); ?></p>
	</div>
	
</section>
</section>

<section id="middletext">
<section class="wrapper">
	<p>Deixe o trabalho conosco, podemos encontrar exatamente o que precisa.</p> <a href="javascript:void()" title='contamos com você' class='button' onclick="window.open('http://webservices.blap.com.br/liguegratis.aspx?id=551925120000&cid=10005','corretoronline','width=430,height=378,top=0,left=0,scrollbars=no,status=no,toolbar=no,location=no,directories=no, menubar=no,resizable=no,fullscreen=no')">Contatamos você</a>	
</section>
</section>

<section id="recents">
<section class="wrapper">

<div class="row">
    <div class="twelve columns">
    <h4><span>Imóveis mais</span> recentes</h4>

         <div class="slider">
            <div id="slider-ajax-container">
                <ul id="banner-rotator" class="royalSlider rsDefault">
                    

                    <?php
                        if( isset( $destaques)){
                            $numero = 0;
                            foreach( $destaques['resultados'] as $row ){
                              if($numero == 0)
                                echo '<li class="royalSlide">';
                              echo '<article>';
                              // imagem
                              $miniatura = $row->pega_miniatura();
                            	if ( ! $miniatura ):
                                  echo html::anchor( $row->gera_url("venda",false,false) , html::image( array( 'src' => 'images/sem_foto.gif', 'width' => '180', 'height'=> '100'  ) , array( 'alt' => 'sem foto' ) )  );
                              else:

                                  $imagem = '<img src="'. $miniatura->arqfoto .'" alt="'.$miniatura->descricao.'" width="180" height="100" />';
                                    echo html::anchor( $row->gera_url("venda",false,false) , $imagem  );
                              endif;
							  if($row->consulta==1)
								$preco = "Valor sob consulta";
							  else
								$preco = "R$ ".number_format($row->valvenda,2,',','.');
                              //echo '<h4>'.html::anchor($row->gera_url(), $row->bairro_sinonimo() ) . '</h4>';
                              echo '<p><span>'. $row->bairro_sinonimo()  .'</span><br/>' . $preco.'</p>';
                              echo '</article>';

                              if($numero == 4){
                                echo '</li>';
                                $numero = 0;
                              }else{ $numero ++; }
                            }
                        }
                        ?>
                        </li>
                    
                </ul>
            </div>
        </div><!-- #slider -->
    </div>
</div>

</section><!-- #Recents -->
</section><!-- #Recents -->

<section id="conheca_exclusividade">
<section class="wrapper">
           
    <div class="steps">
	<p>Sua venda pode ser desgastante,<br> mas não se contar com a  <strong>assessoria certa!</strong></p>
    </div>
    
    <article>
    <h5><img alt="Next Mobile" src="images/exclusividade2.jpg"></h5>   
    <a class='button' href="<?php echo url::base(true);?>exclusividade"><span>Conheça a Exclusividade</span></a>
    </article>

</section><!-- wrapper -->
</section>

<script>
	
    jQuery(document).ready(function($) {	
	
		$('.banner_home').royalSlider({
		 autoHeight: false,			
			fadeinLoadedSlide: false,		
			imageScaleMode: 'none',
			imageAlignCenter:false,			
			arrowsNavAutoHide: false,
			arrowsNavHideOnTouch: false,
			controlNavigation: 'none', 		
			controlsInside:true,			
			hideArrowOnLastSlide:true
		});
	
    });
	
	 	
    jQuery(document).ready(function($) {	
	
		$('.lancamento').royalSlider({
		 autoHeight: false,			
			fadeinLoadedSlide: false,		
			imageScaleMode: 'none',
			imageAlignCenter:false,			
			arrowsNavAutoHide: true,
			controlNavigation: 'none', 		
			controlsInside:false,	
			transitionType: 'fade',
			hideArrowOnLastSlide:true,
			loop:true,
			autoPlay: {
				// autoplay options go gere
				enabled: true,
				pauseOnHover: true,
				delay: 3000
			}
		});
		
		
	
    });
	
	
    </script>