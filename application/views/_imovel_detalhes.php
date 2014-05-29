<section id="bannerinner">

<div class="slider">
    <div id="slider-ajax-container">
    <div id="banner-rotator2" class="royalSlider royalSlider2">
    <ul class="royalSlidesContainer">
<?php
    // foto
    $foto = $row->pega_foto();
          	if ( ! $foto ):
                echo html::image('images/sem_foto_detalhes.jpg', array("class" => 'foto_imovel', "alt" => $h1, "title" => $h1));
            else:

            foreach ($row->fotos() as $imagem):
               echo '<li class="royalSlide"><figure><img src="http://www.centrina.com.br/fotos/'. $imagem['imagem'].'" alt="'.$h1.'" title="'.$h1.'" class="foto_imovel" /></figure></li>';
             endforeach;

            endif;

?>

</ul>
    </div>
    </div>
    </div>
</section><!-- banner -->


<div id="menu" class="default">
<div id="bgheading">
<div class="wrapper">

<?php
    echo '<h3>';
    echo 'R$'.number_format($row->valor_imovel,2,',','.').' <span>';
    // linha com código, cidade e bairro
      echo $row->bairro . ', ';
      echo $row->cidade . ', ';
      echo $row->dorm . ' dormitórios' . ', ';
      //echo 'Código: ' . '<strong>' . $row->cod_jb . '</strong>';
    echo '</span></h3>';
    ?>

    <div class="photolist">
    <div class="previousarrow"><a href="#"><img src="images/arrow05.gif" alt="Previous" /></a></div>
    <p>1/12 FOTOS</p>
    <div class="nextarrow"><a href="#"><img src="images/arrow06.gif" alt="Next" /></a></div>
    </div>

    <div class="bgbuttons">
    <div class="buttons">
    <!--div class="button"><a href="email-seguindo.html"><span>Seguir imóvel</span></a></div-->
    <div class="button"><a href="#" class="messages"><span>Compartilhar</span></a></div>
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
      echo '<p>' . $row->area_total . ' <span>m2</span> </p>';
      echo '<p>' . $row->dorm . ' <span>dormitórios</span> </p>';
      echo '<p>' . $row->suite . ' <span>suítes</span> </p>';

    ?>

        </div>

        <div class="set">
         <?php
      echo '<p>' . $row->banheiro . ' <img src="images/icon_people.gif" alt=""></p>';
      echo '<p>' . $row->garagem . ' <img src="images/icon_car.gif" alt=""></p>';
    ?>
        <p class="icon">
        <a href="#"><img src="images/icon_home02.png" alt="Home"></a>
        <a href="#"><img src="images/icon_play.png" alt="Play"></a>
        </p>
        </div>
        </div>

        <div class="details">
        <h4><span>Descrição do imóvel</span></h4>
        <aside>
        <p><?= $row->descricao; ?></p>

        <div class="buttonconnect"><a href="#" class="green"><span>Ligue grátis</span></a></div>
        </aside>
        </div>

        <div class="details right">
        <h4><span>Ficha completa</span></h4>
        <ul>
        <li>
        <span class="tipo">Tipo</span>
        <span class="tipo"><?= $row->tipo;?></span>
        </li>

        <li class="gray">
        <span class="tipo">Finalidade: </span>
        <span class="tipo"><?= $row->finalidade;?></span>
        </li>

        <li>
        <span class="tipo">Cidade /Estado :</span>
        <span class="tipo"><?= $row->cidade . '/' . $row->uf;?></span>
        </li>

        <li class="gray">
        <span class="tipo">Bairro:</span>
        <span class="tipo"><?= $row->bairro;?></span>
        </li>

        <li>
        <span class="tipo">Dormitórios / Suítes:</span>
        <span class="tipo"><?= $row->dorm . ' (' . $row->suite . ')'; ?></span>
        </li>

        <li class="gray">
        <span class="tipo">Vagas:</span>
        <span class="tipo"><?= $row->garagem;?></span>
        </li>

        <li>
        <span class="tipo">Banheiros:</span>
        <span class="tipo"><?= $row->banheiro;?></span>
        </li>

        <li class="gray">
        <span class="tipo">Área construída:</span>
        <span class="tipo"><?= $row->area_construida ?> M2</span>
        </li>

        <li>
        <span class="tipo">Área total:</span>
        <span class="tipo"><?= $row->area_total ?> M2</span>
        </li>

        <li class="gray">
        <span class="tipo">Valor do condomínio:</span>
        <span class="tipo">R$ <?= $row->valor_cond ?></span>
        </li>
        </ul>
        </div>
    </div>


    <div class="rightinfo">
        <div class="links">
        <p> <a href="imoveis-a-venda-em-campinas.html">Voltar aos resultados</a></p>
        <p class="right"><span class="prev"><a href="casa-a-venda-vinhedo.html">Anterior</a> </span>  <span>|  </span><span class="next"> <a href="casa-a-venda-vinhedo.html">Próximo</a></span></p>
        </div>

        <div class="form">
        <form action="#" method="post">
        <fieldset>
        <h4>Solicitar informações</h4>
        <h2><?= $row->cod_jb ;?></h2>
        <ul>
        <li><input name="" type="text" class="input" value="Nome:" onFocus="if(this.value == 'Nome:') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Nome:';}" /></li>

        <li><input name="" type="text" class="input" value="Email:" onFocus="if(this.value == 'Email:') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Email:';}" /></li>

        <li><input name="" type="text" class="input" value="Fone:" onFocus="if(this.value == 'Fone:') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Fone:';}" /></li>

        <li><textarea name="" cols="" rows="" class="textarea" onFocus="if(this.value == 'Mensagem:') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Mensagem:';}" >Mensagem:</textarea></li>
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







<section id="recents" class="whitebg">
<section class="wrapper">

    <h4><span>Você tem bom gosto</span> <br /> talvez goste destes também</h4>
    <div class="slider">
        <div id="slider-ajax-container">
        <div id="banner-rotator" class="royalSlider">
        <ul class="royalSlidesContainer">
        <li class="royalSlide">
<?php

    $numero = 0;
                            foreach( $semelhantes['resultados'] as $row ){
                              echo '<article>';
                              // imagem
                              $miniatura = $row->pega_miniatura();
                            	if ( ! $miniatura ):
                                  echo html::anchor( $row->gera_url() , html::image( array( 'src' => 'images/sem_foto.gif', 'width' => '179', 'height'=> '100'  ) , array( 'alt' => 'sem foto' ) )  );
                              else:
                                  $imagem = '<img src="http://www.centrina.com.br/fotos/'.$miniatura['miniatura'].'" alt="'.$miniatura['alt'].'" width="179" height="100" />';
                                  echo html::anchor( $row->gera_url() , $imagem  );
                              endif;

                              //echo '<h4>'.html::anchor($row->gera_url(), $row->bairro_sinonimo() ) . '</h4>';
                              echo '<p><span>'. $row->bairro_sinonimo() .'</span><br/>R$ ' . number_format($row->valor_imovel,2,',','.').'</p>';
                              echo '</article>';

                              if($numero == 4){
                                echo '</li><li class="royalSlide">';
                                $numero = 0;
                              }else{ $numero ++; }
                            }

?>
</li>
        </ul>
        </div>
        </div>
    </div>
</section>
<!-- wrapper -->
</section><!-- recents -->

</div>


