<?php
     
    echo form::open('envia_form/send/seja_vip',array("id"=>"form_lightbox" , "onsubmit"=>"return validate(this)")); 
	echo form::hidden("imovel",($im=="nenhum")?("Nenhum escolhido"):($im));	 	
    echo '<fieldset id="form_contato" class="seja_vip">';
	echo html::image("images/next_form.jpg");
	echo "<strong>VIP</strong>";
	echo "<p><span>Estamos preparando uma surpresa para<br> você que busca fazer um ótimo negócio.</span>Faça o cadastro rápido para <br>ser avisado em primeira mão.</p>";
    echo '<span>'. form::input( 'nome' , "", "placeholder='Nome'") ." <label id='label_nome'>Digite seu nome.</label></span>";
    echo '<span>'. form::input( 'email',"", "placeholder='E-mail'") ." <label id='label_email'>Digite um e-mail válido.</label></span>";
	echo '<span>'. form::input( 'tel',"", "placeholder='Telefone'" ) ."<label id='label_telefone'>Digite seu telefone!</label></span>";    
	echo form::button( 'button' , 'Avise-me' , 'class="atendimento"'  );
    echo '</fieldset>';   
    echo form::close();       
    ?>	
	