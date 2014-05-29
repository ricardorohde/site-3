<section id="container">
<section class="wrapper">
		
	<div class="previous2"> </div>
	<div class="next2"></div>
    <section id="content">

        <section id="leftpanel">
            <div class="heading">
            <h3>Filtre sua busca</h3>

            <h2><span></span> imóveis localizados</h2>
            </div>

             <div class="box">
    <aside>
        <label>Código</label>
        <?php
			echo $pesquisa_cod;		
		?>
    </aside>
 </div>



            <div class="accordation">
            <div class="leftmenu">
             
                 <?php if( isset($filtros ) ) echo $filtros ; ?>

            
            <br/>&nbsp;&nbsp;
            <br/>
            </div>
            </div>
			<!--
            <div class="nextmobile">
            <figure><img src="images/photo_mobile.png" alt="PHOTO"></figure>
            <div class="info"><h2><span>Encontre imóveis </span>perto de você</h2></div>

            <div class="buttonconnect"><a href="#"><span>Conheça NextMobile</span></a></div>
          </div> -->
        </section><!-- leftpanel -->


        <section id="rightpanel">

        <?php
			$view = new View('lista_imoveis');   
            $view->render(TRUE);
			?>



        </section><!-- rightpanel -->

    </section><!-- content -->

</section><!-- wrapper -->
</section><!-- container -->

