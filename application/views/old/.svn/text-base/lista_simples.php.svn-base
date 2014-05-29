    <?php
        echo '<ul>';
        foreach ($resultados['resultados'] as $row):
            echo '<li>';
            $miniatura = $row->pega_miniatura();
          	if ( ! $miniatura ):
                echo html::image('images/sem_foto.gif');
            else:
                $imagem = '<img src="http://www.centrina.com.br/fotos/'.$miniatura['miniatura'].'" alt="'.$miniatura['alt'].'" width="154" height="120" />';
                echo html::anchor($row->gera_url(),$imagem);
            endif;
            echo '<br/>';

            if ( strlen($row->bairro) > 16 ) {
                $bairro = '<marquee behavior="scroll" scrollamount = "3">' . $row->bairro . '</marquee>';
            } else {
                $bairro = $row->bairro;
            }


            echo '<span class="bairro"><nobr>'.html::anchor($row->gera_url(),$bairro , array( 'title' => $row->bairro ) ).'</nobr></span><br/>';
            if(strlen($row->descricao)>40):
                $string_descricao = tools::cutText($row->descricao, 40).' ...';
            else:
                $string_descricao = $row->descricao;
            endif;
            echo $string_descricao.'<br/>';
            echo '<span class="preco">R$ '.number_format($row->valor_imovel,2,',','.').'</span>';
            echo '</li>';

        endforeach;
        echo '</ul>';

    ?>