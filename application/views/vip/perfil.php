<script>

function validate_cadastro(form)
	{
		var ret = true;		
		//var email = form.email.value;	
		var fone = form.fone.value;	
		
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		/*if(!re.test(email))		//validar email		
		{
			$("#label_email_cadastro").toggleClass("show");
			setTimeout(function(){ $("#label_email_cadastro").toggleClass("show"); }, 5000);
			ret = false;
		}*/		
		
		if (fone==null || fone=="") //validar telefone
		{
			$("#label_tel_cadastro").toggleClass("show");
			setTimeout(function(){ $("#label_tel_cadastro").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		return ret;
	} 

	function mask(e,src,mask) {
        if(window.event) { _TXT = e.keyCode; } 
        else if(e.which) { _TXT = e.which; }
        if(_TXT > 47 && _TXT < 58) { 
  var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i)
  if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); } 
     return true; } else { if (_TXT != 8) { return false; } 
  else { return true; }
        }
}

</script>

<?php
	
	echo form::open('vip/alterar_perfil',array("onsubmit"=>"return validate_cadastro(this)"));
	echo "<fieldset id='form_perfil'>";	
		if(isset($_GET['sucesso']))
		echo "<p class='aviso'>Dados atualizados com sucesso.</p>";
	elseif(isset($_GET['erro']))
			echo "<p class='aviso'>Ocorreu algum erro, verifique seus dados ou tente novamente em alguns instantes.</p>";
	elseif(isset($_GET['senha']))
			echo "<p class='aviso'>Digite a mesma senha nos dois campos.</p>";
		
	echo "<p>Altere os dados abaixo, caso queira, e clique em Alterar.</p>";
	//echo "<span>Nome de usuário: ".$user->username."</span>";
	echo '<span>'.form::input('nome', $user->nome , 'placeholder = "Nome Completo"' )."</span>";	
	echo '<span>'.form::input('nascimento', $user->nascimento , 'placeholder = "Data de nascimento" maxlength="10" onkeypress="return mask(event,this,\'##/##/####\');" ' )."</span>";
	echo '<span>'.form::input('endereco', $user->endereco , 'placeholder = "Endereço"' )."</span>";
	echo '<span>'.form::input('cidade', $user->cidade , 'placeholder = "Cidade"' )."</span>";	
	//echo "<small>Se quiser que a NEXT gere uma senha para você, deixe este campo em branco que a enviaremos por email.</small>";
	echo '<span>'.form::input('fone', $user->fone , 'placeholder = "Telefone"')."<label id='label_tel_cadastro'>Digite seu telefone.</label></span>";	
	//echo '<span>'.form::input('email', $user->email , 'placeholder = "E-mail"')."<label id='label_email_cadastro'>Digite um email válido.</label></span>";	
	echo "<br>";
	echo '<span>'.form::password('password', '', 'placeholder = "Senha" autocomplete="off"')."</span>";	
	echo '<span>'.form::password('password_confirm', '', 'placeholder = "Repita a senha"  autocomplete="off"')."</span>";	
	echo form::button("button",'Alterar').'';		
	echo "</fieldset>";
	echo form::close();

?>