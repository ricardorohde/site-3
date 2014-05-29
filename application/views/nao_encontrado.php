<section class="bgbannerform">
<section class="bannerform">
    <h1><span>Sua busca não retornou</span> nenhum resultado</h1>

    <div class="box2">
		
	<h2>Você buscou pelo código <span><?php echo $codigo ;?></span></h2>

	<p>Busque novamente pelos códigos</p>
	<div id='form'><?php echo $cod_jb ;?></div>

	<p>Ou busque pelos filtros</p>
	<?php echo html::anchor('/imoveis_a-venda.html' , 'Quero comprar imóveis', array("id"=>"comprar") ) ?>
	<?php echo html::anchor('/imoveis_para-alugar.html' , 'Quero alugar imóveis', array("id"=>"alugar") ) ?>    

	
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
                <div id="banner-rotator" class="royalSlider">
                    <ul class="royalSlidesContainer">

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
                                  echo html::anchor( $row->gera_url() , html::image( array( 'src' => 'images/sem_foto.gif', 'width' => '179', 'height'=> '100'  ) , array( 'alt' => 'sem foto' ) )  );
                              else:

                                  $imagem = '<img src="'. $miniatura->arqfoto .'" alt="'.$miniatura->descricao.'" width="179" height="100" />';
                                    echo html::anchor( $row->gera_url($pret) , $imagem  );
                              endif;

                              //echo '<h4>'.html::anchor($row->gera_url(), $row->bairro_sinonimo() ) . '</h4>';
                              echo '<p><span>'. $row->bairro_sinonimo()  .'</span><br/>R$ ' .(($pret=="venda")?( number_format($row->valvenda,2,',','.') ):( number_format($row->vallocacao,2,',','.') )).'</p>';
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
            </div>
        </div><!-- #slider -->
    </div>
</div>

</section><!-- #Recents -->
</section><!-- #Recents -->