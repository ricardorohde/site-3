<div id="pesquisa_cod_jb">
<?php
	echo form::open('imoveis/busca');
	echo '<p>';
	echo form::input('cod_jb','Pesquisa por código', 'onfocus="this.value=\'\'"');
    echo form::button(array('type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'class' => 'ok'),'OK');
	echo '</p>';
?>
</div>