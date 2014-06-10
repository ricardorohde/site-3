<?php
	echo form::open('imoveis/busca');
	//echo form::input('cod_jb','Palavras Chave', 'onfocus="this.value=\'\'"');
	$search =  implode(" ", explode("_",$this->input->get('search',"") ) );
	echo form::input('cod_jb', $search , 'placeholder = "Palavras Chave"') ;
	echo form::hidden('pret',$pret);
    echo form::button(array('type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'class' => 'ok'),'OK');
    echo form::close();
?>
