<?php

            // classes da celula
            $celula_class ='celula '.strtolower($row->finalidade);
            if($row->exclusividade == 'E' && $row->data_exclusividade_final <= getdate()) $celula_class .= ' exclusivo';
            echo '<div class="'.$celula_class.'" >';

            $foto = $row->pega_foto();
          	if ( ! $foto ):
                echo html::image('images/sem_foto_detalhes.jpg');
            else:
                echo '<img src="http://www.centrina.com.br/fotos/29/'.$foto['imagem'].'" alt="'.$foto['alt'].'" height="285" />';
            endif;

            echo '<div class="info">';

            echo '<h2>'.$row->bairro_sinonimo() .'</h2>';
            echo '<span class="legenda">'.$row->cidade.' - '.$row->uf.'</span>';
            if(strlen($row->descricao)>200):
                $string_descricao = tools::cutText($row->descricao, 200).' ...';
            else:
                $string_descricao = $row->descricao;
            endif;
            echo '<p>'.$string_descricao.'</p>';

            echo '<div class="preco">R$ '.number_format($row->valor_imovel,2,',','.').'</div>';

            echo '<p>'.$row->dorm.' dormit&oacute;rios.</p>';



            echo '</div>'; // end info

            echo '</div>'; // end celula

            /* image slider
            if($row->foto != ''):
                  echo '<div id="mycarousel" class="jcarousel-skin-tango">';
                    echo '<ul>';

                    foreach ($row->fotos() as $imagem):
                        echo '<li>'.html::anchor('http://www.centrina.com.br/fotos/29/'.$imagem['imagem'],'<img src="http://www.centrina.com.br/fotos/29/mini_'.$imagem['imagem'].'" alt="'.$imagem['alt'].'" width="75" height="75"/>',array('class'=>'thickbox' , 'rel' =>'galeria') ).'</li>';
                    endforeach;

                    echo '</ul>';
                  echo '</div>';
                endif;
                */

                echo '<div class="mais_info">';

                 echo '<div id="sobre">';
                    echo '<table>';
                    if($row->tipo) echo '<tr><th>Tipo:</th><td>'.$row->tipo.'</td></tr>';
                    if($row->finalidade) echo '<tr><th>Finalidade:</th><td>'.$row->finalidade.'</td></tr>';
                    if($row->cidade) echo '<tr><th>Cidade:</th><td>'.$row->cidade.' - '.$row->uf.'</td></tr>';
                    if($row->bairro) echo '<tr><th>Bairro:</th><td>'.$row->bairro.'</td></tr>';
                    if($row->endereco) echo '<tr><th>Endereço:</th><td>'.$row->endereco.'</td></tr>';
                    if($row->cep) echo '<tr><th>CEP:</th><td>'.$row->cep.'</td></tr>';
                    if($row->garagem) echo '<tr><th>Garagem:</th><td>'.$row->garagem.'</td></tr>';
                    if($row->dorm) echo '<tr><th>Dormitórios:</th><td>'.$row->dorm.'</td></tr>';
                    if($row->suite) echo '<tr><th>Suítes:</th><td>'.$row->suite.'</td></tr>';
                    if($row->banheiro) echo '<tr><th>Banheiros:</th><td>'.$row->banheiro.'</td></tr>';
                    if($row->sala) echo '<tr><th>Salas:</th><td>'.$row->sala.'</td></tr>';
                    if($row->quartoemp) echo '<tr><th>Quarto empregada:</th><td>'.$row->quartoemp.'</td></tr>';
                    if($row->piscina) echo '<tr><th>Piscina:</th><td>'.$row->piscina.'</td></tr>';
                    if($row->condfechado) echo '<tr><th>Condomínio fechado:</th><td>'.$row->condfechado.'</td></tr>';
                    if($row->nome_cond) echo '<tr><th>Nome do condomínio:</th><td>'.$row->nome_cond.'</td></tr>';
                    if($row->area) echo '<tr><th>Área:</th><td>'.$row->area.' m²</td></tr>';
                    if($row->area_util) echo '<tr><th>Área útil:</th><td>'.$row->area_util.' m²</td></tr>';
                    if($row->area_total) echo '<tr><th>Área total:</th><td>'.$row->area_total.' m²</td></tr>';
                    if($row->area_construida) echo '<tr><th>Área construída:</th><td>'.$row->area_construida.' m²</td></tr>';
                    if($row->area_mezanino) echo '<tr><th>Área do mezanino:</th><td>'.$row->area_mezanino.' m²</td></tr>';
                    if($row->dimensao_terreno) echo '<tr><th>Dimensão do terreno:</th><td>'.$row->dimensao_terreno.'</td></tr>';
                    if($row->metros_terreno) echo '<tr><th>Área do terreno:</th><td>'.$row->metros_terreno.' m²</td></tr>';

                    echo '</table>';
                echo '</div>';
                /*
                echo '<div id="local">';
                    echo '<div id="map" style="width: 400px; height: 400px"></div>';
                echo '</div>';
                */
                echo '</div>';

                ?>
                <p><a href="javascript:window.print();" title="Imprimir essa ficha" >Clique aqui para imprimir</a> </p> 
