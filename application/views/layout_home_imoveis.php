<div class="row">

<div id="filtros" class="three columns">
    <?php if( isset($filtros ) ) echo $filtros ; ?>
</div><!-- filtros -->

<div class="eight columns listaImoveis">
   <?php
         if ( isset( $h1 ) ) echo '<h1>'. $h1 . '</h1>';
         if( isset( $lista ) ) echo $lista ;
         if( isset( $lista_casas ) ) echo $lista_casas ;
         if( isset( $lista_terrenos ) ) echo $lista_terrenos ;

   ?>

</div><!-- coluna principal -->

<div id="ferramentas" class="two columns">
    <?php if( isset($ferramentas ) ) echo $ferramentas ; ?>
</div><!-- ferramentas -->

 </div>