<?php
	echo form::open('imoveis/busca');
	echo form::input('cod_jb','Pesquisa por código', 'onfocus="this.value=\'\'"');
	echo form::hidden('pret',$pret);
    echo form::button(array('type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'class' => 'ok'),'OK');
    echo form::close();
?>
