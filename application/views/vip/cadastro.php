<script>
	 
	function validate_vip(form)
	{
		var ret = true;
		var nome = form.nome.value;
		var email = form.email.value;	
		var tel = form.fone.value;	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if(!re.test(email))		//validar email		
		{
			$("#label_email").toggleClass("show");
			setTimeout(function(){ $("#label_email").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (nome==null || nome=="") //validar nome
		{
			$("#label_nome").toggleClass("show");
			setTimeout(function(){ $("#label_nome").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (tel==null || tel=="") //validar telefone
		{
			$("#label_tel").toggleClass("show");
			setTimeout(function(){ $("#label_tel").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		return ret;
	} 
	  
	</script>

<h1>Agilizamos todo <span>o trabalho para você</span></h1>

<ul id='desc'>

<li><h3>Informações em tempo real</h3>
<p>Receba atualização em tempo real do status de 
seus imóveis favoritos e novos imóveis disponíveis.</p>
</li>

<li><h3>Tenha apoio total de especialistas</h3>
<p>Conecte-se com especialistas locais para ajudá-lo 
a compreender o processo de compra de casa.</p>
</li>

<li>
<h3>Atendimento Full Service</h3>
<p>Se desejar, entramos em contato e fazemos 
todo o trabalho de pesquisa para você.</p>
</li>

</ul>

<?php
	
	echo html::image("images/vip_imagem.png");
    echo form::open('vip/cadastrar',array("onsubmit"=>"return validate_vip(this)"));		
	echo "<fieldset id='form_vip'>";
	if(isset($_GET['jaexiste']))
		echo "<p class='aviso'>Este email já esta sendo utilizado.</p>";
	elseif(isset($_GET['erro']))
			echo "<p class='aviso'>Ocorreu algum erro, verifique seus dados ou tente novamente mais tarde.</p>";
		
	echo "<p>Preencha o formulário abaixo</p>";
	echo '<p><span>Email</span>'.form::input('email',"","autocomplete='off'")."<label id='label_email'>Digite um email válido.</label></p>";		
	echo '<p><span>Senha:</span>'.form::password('password',"","autocomplete='off'")."</p>";	
	echo "<small>Se quiser que a NEXT gere uma senha para você, deixe este campo em branco que a enviaremos por email.</small>";
	if($mostrar_corretor)
		echo '<p><span>Nome do usuário:</span>'.form::input('nome',"","autocomplete='off'")."<label id='label_nome'>Digite seu nome.</label></p>";
	else
		echo '<p><span>Seu nome:</span>'.form::input('nome',"","autocomplete='off'")."<label id='label_nome'>Digite seu nome.</label></p>";
	echo '<p><span>Telefone</span>'.form::input('fone',"","autocomplete='off'")."<label id='label_tel'>Digite seu telefone.</label></p>";
	if($mostrar_corretor)	
		echo '<br><br><p><span>Corretor</span>'.form::dropdown('corretor',$corretores)."</p>";	
	echo form::button("button",'<span>Cadastro VIP</span>').'';	
	echo "</fieldset>";
	echo form::close();

?>