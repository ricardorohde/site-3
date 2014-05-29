
<section id="banner">
	<img src="images/slide_banner02.jpg" alt="banner" />	
</section><!-- banner -->


<section class="bgbannerform">
<section class="bannerform">
    <h1><span>Orientando os melhores</span> negócios imobiliários</h1>

    <?= $pesquisa ?>

    <div class="box2">
    <h2>Precisa de ajuda?</h2>
    <p>Sua procura pode ser desgastante, mas não se contar com a assessoria certa. Estamos aqui para fazer tudo para que realize um ótimo negócio sem perder tempo</p>
    <button class="atendimento" onclick="javascript:window.open('http://webservices.blap.com.br/liguegratis.aspx?id=551925120000&cid=10005','liguegratis','width=430,height=378,top=0,left=0,scrollbars=no,status=no,toolbar=no,location=no,directories=no, menubar=no,resizable=no,fullscreen=no')">Atendimento VIP</button>
    </div>

</section>
</section><!-- banner form -->

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

<section id="middletext">
<section class="wrapper">
	<p>Deixe o trabaho conosco, podemos encontrar exatamente o que precisa.</p><a href="#" class='button' title='contamos com você'>contamos com você</a>
</section>
</section>

<section id="middlecontent">
<section class="wrapper">
    
    <figure><h2>Quer negociar seu imóvel?</h2>
    <p>Temos a expertise necessária para equilibrar as  variáveis da negociação e fazer do seu imóvel um ótimo negócio. Veja como trabalhamos:</p>
    <img alt="ScreenShoot" src="images/screenshoot-grafico-exclusividade.png"></figure>
    
    <div class="steps">
    <aside class='step_1'>
    <h3><span>1</span>Venda com rapidez</h3>
    <p>Utilizamos nossas mídias para que seu imóvel tenha o maior destaque possível e seja vendido rapidamente.</p>
    </aside>
    
    <aside  class='step_2'>
    <h3><span>2</span>Orientação adequada</h3>
    <p>Temos especialistas que darão o subsídio para correção de pequenos detalhes que farão grande diferença.</p>
    </aside>
    
    <aside  class='step_3'>
    <h3><span>3</span>Preço ideal</h3>
    <p>Seu imóvel será avaliado por uma equipe que conhece o mercado. A negociação do seu imóvel será efetivamente um bom negócio.</p>
    </aside>
    </div>
    
    <article>
    <h5><img alt="Next Mobile" src="images/nextexclusividade.png"></h5>
    <p>Sua venda pode ser desgastante, mas não se contar com a assessoria certa.</p>
    <div class="buttonconnect no_icon"><a href="<?php echo url::base(true);?>exclusividade"><span>Conheça a Exclusividade</span></a></div>
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
    </script>