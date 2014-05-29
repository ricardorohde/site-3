<?php
    // prepara urls para listas de cidades e bairros
	$url_base = 'imoveis/lista/';

    $param = $filtros;  

    $s1 = uri::segment(1);
    if ( ! ereg('\.html',$s1) ) {
        foreach( array_keys($this->input->get()) as $k) {
            $param[$k] = $this->input->get($k);
        }
    }

    foreach( array_keys($campos) as $apelido ):

      $campo = $campos[$apelido];
      if ( sizeof($campo['opcoes']) == 0 ) continue;
      $url = $url_base . '?';
      $p = "";

      foreach ( array_keys( $param ) as $k ) :
           if ( $k != $apelido ) $p .= $k . "=" . $param[$k] . "&";
      endforeach;

      if ( strlen($p) > 0 ) $url .= substr( $p, 0, strlen($p) - 1);

      if ( $campo['valor'] ):
          if ( $filtro_ativo ):
              echo '<div class="filtro_ativo filtro_' . $apelido .'">';
              echo $campo['titulo'] . ": " . $campo['opcoes'][ $campo['valor'] ];
              echo html::anchor($url . "&" . $apelido . "=",'[x]', array ( 'rel' => 'no_follow' ) );
              echo '</div>';
          endif;
      else:
          if ( ! $filtro_ativo ):
            echo '<h3 class="filtro_' . $apelido . ' ">'.$campo['titulo'].'</h3>';
            echo '<ul class="filtro_' . $apelido . ' ">';
            foreach( array_keys($campo['opcoes']) as $chave ):
              echo '<li>'.html::anchor(tools::trata_url_imovel($url . "&" . $apelido . "=" . $chave),$campo['opcoes'][$chave]).'</li>';
            endforeach;
            echo '</ul>';
          endif;
      endif;

    endforeach;

?>