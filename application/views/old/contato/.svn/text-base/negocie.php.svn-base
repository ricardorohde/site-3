<?php
    echo form::open('negocie/send_negocie');
    echo form::hidden( 'tipo' , $tipo );

    echo '<fieldset>';
    echo '<legend>Seus dados</legend>';
    echo '<p><label>* Nome: <br/>' . form::input( 'nome' ) . '</label></p>';
    echo '<p><label>* E-mail: <br/>' . form::input( 'email' ) . '</label></p>';
    echo '<p><label>Tel: <br/>' . form::input( 'tel' ) . '</label></p>';
    echo '<p><label>Endereço: <br/>' . form::input( 'endereco' ) . '</label></p>';
    echo '<p><label>Cidade: <br/>' . form::input( 'cidade' ) . '</label></p>';

    echo '</fieldset>';

    $booleano = array( 'sim' => 'sim',
                       'nao' => 'não' );

    echo '<fieldset>';
    echo '<legend>Seus dados</legend>';
    echo '<p><label>Tipo: <br/>' . form::dropdown( 'tipo' , $tipos ) . '</label></p>';
    echo '<p><label>Cobertura: <br/>' . form::dropdown( 'cobertura' , $booleano , 'nao' ) . '</label></p>';
    echo '<p><label>Finalidade: <br/>' . form::dropdown( 'finalidade' , $finalidades ) . '</label></p>';
    $pret = array( 'venda' => 'Venda',
                    'locacao' => 'Locação');
    echo '<p><label>Pretenção: <br/>' . form::dropdown( 'pretencao' , $pret ) . '</label></p>';
    echo '<p><label>Financiado: <br/>' . form::dropdown( 'financiado'  , $booleano ) . '</label></p>';
    echo '<p><label>Endereço: <br/>' . form::input( 'end_imovel' ) . '</label></p>';
    echo '<p><label>Bairro: <br/>' . form::input( 'bairro' ) . '</label></p>';
    echo '<p><label>Área: <br/>' . form::input( 'area' ) . '</label></p>';
    echo '<p><label>Valor: <br/>' . form::input( 'valor' ) . '</label></p>';
    echo '<p><label>Paga condomínio: <br/>' . form::dropdown( 'paga_condominio' , $booleano ) . '</label></p>';
    echo '<p><label>Valor condomínio: <br/>' . form::input( 'valor_condominio' ) . '</label></p>';
    echo '<p><label>Descrição: <br/>' . form::textarea( 'descricao' ) . '</label></p>';
    echo '<p><label>Observações: <br/>' . form::textarea( 'obs' ) . '</label></p>';
    echo '<p><label>Exclusividade: <br/>' . form::dropdown( 'exclusividade' , $booleano ) . '</label></p>';
    echo '</fieldset>';
    echo form::button( 'button' , 'Enviar' );
    echo form::close();

    if( isset( $mais_info ) ) echo $mais_info ;

    ?>