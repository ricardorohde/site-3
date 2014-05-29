<?php
     
    echo form::open('envia_form/send/contato',array("id"=>"form_lightbox" , "onsubmit"=>"return validate(this)"));  		
    echo '<fieldset id="form_contato">';
	echo html::image("images/next_form.jpg");
	echo "<p>Preencha o formulário abaixo</p>";
    echo '<span>'. form::input( 'nome' , "", "placeholder='Nome'") ." <label id='label_nome'>Digite seu nome.</label></span>";
    echo '<span>' . form::input( 'email',"", "placeholder='E-mail'")  ." <label id='label_email'>Digite um e-mail válido.</label></span>";	
	$opcoes = array("sac"=>"SAC-Atendimento ao Cliente","venda"=>"Venda","Locação"=>"locacao","administracao"=>"Administração de Imóveis","outros"=>"Outros");
    echo '<span>' . form::dropdown( 'departamento',$opcoes ) ."</span>";
	
    echo '<span>' . form::input( 'tel',"", "placeholder='Telefone'" ) ."<label id='label_telefone'>Digite seu telefone!</label></span>";
    echo '<span>' . form::textarea( 'mensagem',"", "placeholder='Mensagem'" ) ."</span>";
	echo form::button( 'button' , 'Enviar' , 'class="atendimento"'  );
    echo '</fieldset>';   
    echo form::close();       
    ?>