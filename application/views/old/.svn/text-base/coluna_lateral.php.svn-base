<?php
    echo View::factory('pesquisa_cod_jb')->render();
?>

<?php
  $view = new View('painel_filtros');
  $view->campos = $campos;
  $view->filtros = $filtros;
?>

  <?php
   $view->filtro_ativo = true;
   $view->render(TRUE);
  ?>

<div id="filtros">

  <?php
   $view->filtro_ativo = false;
   $view->render(TRUE);

  ?>

</div>