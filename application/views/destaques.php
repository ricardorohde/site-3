<?php
	$numero = 0;
	foreach( $destaques['resultados'] as $row ){
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