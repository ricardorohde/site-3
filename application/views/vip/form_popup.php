<script>

$(document).ready(function(){
	$('h2.accordion').click(function(){
		$(this).parent().find('div.accordion').slideToggle("slow");
		});
	});
	 
	function validate_cadastro(form)
	{
		var ret = true;
		var nome = form.username.value;
		var email = form.email.value;	
		var fone = form.fone.value;	
		var ru = /^[\w\.@]{5,100}$/;
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if(!re.test(email))		//validar email		
		{
			$("#label_email_cadastro").toggleClass("show");
			setTimeout(function(){ $("#label_email_cadastro").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if(!ru.test(nome)) //validar nome
		{
			$("#label_username_cadastro").toggleClass("show");
			setTimeout(function(){ $("#label_username_cadastro").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (fone==null || fone=="") //validar telefone
		{
			$("#label_tel_cadastro").toggleClass("show");
			setTimeout(function(){ $("#label_tel_cadastro").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		return ret;
	} 
	
	function validate_login(form)
	{
		var ret = true;
		var nome = form.username.value;
		var senha = form.password.value;
		var ru = /^[\w\.@]{6,100}$/;		
		
		if(!ru.test(nome)) //validar nome
		{
			$("#label_username_login").toggleClass("show");
			setTimeout(function(){ $("#label_username_login").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (senha==null || senha=="") //validar senha
		{
			$("#label_password_login").toggleClass("show");
			setTimeout(function(){ $("#label_password_login").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		return ret;
	} 
	  
	
	
</script>

<h2 class='accordion'>Fazer Cadastro</h2>
<div class="accordion">
<?php	
    echo form::open('vip/cadastrar',array("onsubmit"=>"return validate_cadastro(this)"));		
	echo "<fieldset class='form_vip_popup' id='form_contato'>";	
	if(isset($_GET['jaexiste']))
		echo "<p>Este nome de usário já esta sendo utilizado.</p>";
	elseif(isset($_GET['erro']))
			echo "<p>Ocorreu algum erro, verifique seus dados ou tente novamente mais tarde.</p>";
		
	echo "<p>Faça um cadastro e torne-se VIP!</p>";
	echo form::hidden('imovel', $imovel);
	echo form::hidden('pret', $pret);
	echo form::hidden('referrer', $referrer);
	echo '<span>'.form::input('username', '' , 'placeholder = "Usuário (mínimo de 5 carateres)"')."<label id='label_username_cadastro'>Digite um nome de usuário válido.</label></span>";
	echo '<span>'.form::password('password', '' , 'placeholder = "Senha"')."</span>";	
	echo "<small>Se quiser que a NEXT gere uma senha para você, deixe este campo em branco que a enviaremos por email.</small>";
	echo '<span>'.form::input('fone', '' , 'placeholder = "Telefone"')."<label id='label_tel_cadastro'>Digite seu telefone.</label></span>";	
	echo '<span>'.form::input('email', '' , 'placeholder = "E-mail"')."<label id='label_email_cadastro'>Digite um email válido.</label></span>";	
	echo form::button("button",'Cadastrar').'';	
	echo "</fieldset>";
	echo form::close();
?>
</div>

<h2 class='accordion'>Fazer Login</h2>
<div class="accordion" style='display:none'>
<?php	
    echo form::open('vip/login',array("onsubmit"=>"return validate_login(this)"));		
	echo "<fieldset class='form_vip_popup' id='form_contato'>";	
	if(isset($_GET['jaexiste']))
		echo "<p>Este nome de usário já esta sendo utilizado.</p>";
	elseif(isset($_GET['erro']))
			echo "<p>Ocorreu algum erro, verifique seus dados ou tente novamente mais tarde.</p>";
		
	echo "<p>Já é VIP? faça login pelo formulário abaixo</p>";
	echo form::hidden('imovel', $imovel);
	echo form::hidden('pret', $pret);
	echo form::hidden('referrer', $referrer);
	echo '<span>'.form::input('username', '' , 'placeholder = "Nome de Usuário"')."<label id='label_username_login'>Digite um nome de usuário válido.</label></span>";
	echo '<span>'.form::password('password', '' , 'placeholder = "Senha"')."<label id='label_password_login'>Digite sua senha.</label></span>";		
	echo form::button("button",'Entrar').'';	
	echo "</fieldset>";
	echo form::close();
?>
</div>