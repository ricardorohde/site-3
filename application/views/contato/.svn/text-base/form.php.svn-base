<?php
     echo '<div class="form-content">';


    echo form::open('contato/send');
    echo form::hidden( 'imovel' , $imovel );
    echo form::hidden( 'tipo' , $tipo );
    if( $imovel != '' ) echo '<h3>Imóvel: '.$imovel.'</h3>';
    echo '<fieldset>';

    echo '<label>Nome: <br/>' . form::input( 'nome' ) . '</label>';
    echo '<label>E-mail: <br/>' . form::input( 'email' ) . '</label>';
    echo '<label>Tel: <br/>' . form::input( 'tel' ) . '</label>';
    echo '<label>'.$label_mensagem.': <br/>' . form::textarea( 'mensagem' ) . '</label>';
    echo '</fieldset>';
    echo form::button( 'button' , 'Enviar' );
    echo form::close();

    echo '</div>';

    if( isset( $mais_info ) ):

    echo '<div id="form-info">' . $mais_info . '</div>';

    endif;


    ?>