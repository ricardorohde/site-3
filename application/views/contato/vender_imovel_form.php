<?php
     
    echo form::open('envia_form/send/vender_imovel',array("id"=>"form_lightbox" , "onsubmit"=>"return validate(this)"));  	
    echo '<fieldset id="form_contato" class="vender_imovel">';
	echo html::image("images/next_form.jpg");
	echo "<strong>VIP</strong>";
	echo "<p><span>Pretende negociar seu imóvel? <br> Encontrou o lugar certo.</span>Deixe seus contatos e faremos<br> todo o trabalho para você.</p>";
    echo '<span>'. form::input( 'nome' , "", "placeholder='Nome'") ." <label id='label_nome'>Digite seu nome.</label></span>";
    echo '<span>' . form::input( 'email',"", "placeholder='E-mail'")  ." <label id='label_email'>Digite um e-mail válido.</label></span>";
	    echo '<span>' . form::input( 'tel',"", "placeholder='Telefone'" ) ."<label id='label_telefone'>Digite seu telefone!</label></span>";    
		
	echo "<p class='check_span'><span>Venda</span> ".form::checkbox('check_venda', 'sim')."</p>";
	
	echo "<p class='check_span'><span>Locação</span> ".form::checkbox('check_locacao', 'sim')."</p>";
		
	echo form::button( 'button' , 'Quero negociar meu imóvel' , 'class="atendimento"'  );
    echo '</fieldset>';   
    echo form::close();       
    ?>