<script>
	 
	function validate_vip(form)
	{
		var ret = true;
		var email = form.email.value;		
		var senha = form.password.value;	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if(!re.test(email))		//validar email		
		{
			$("#label_email").toggleClass("show");
			setTimeout(function(){ $("#label_email").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (senha==null || senha=="") //validar telefone
		{
			$("#label_password").toggleClass("show");
			setTimeout(function(){ $("#label_password").toggleClass("show"); }, 5000);
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
	echo form::open('vip/login',array("onsubmit"=>"return validate_vip(this)"));		
	echo "<fieldset id='form_cadastro'>";
	if(isset($_GET['usuario']))
		echo "<p class='aviso'>Usuário não encontrado.</p>";
	else
		if(isset($_GET['erro']))
		echo "<p class='aviso'>Senha incorreta.</p>";
	
	echo '<p><span>Email:</span>'.form::input('email')."<label id='label_email'>Digite um email válido.</label></p>";
	echo '<p><span>Senha:</span>'.form::password('password')."<label id='label_password'>Digite sua senha.</label></p>";	
	echo form::button("button",'<span>Entrar</span>').'';		
	echo "<p id='sem_cadastro'>Não tem cadastro? ".html::anchor("vip/cadastro","clique aqui e seja VIP!")."</p>";	
	echo html::anchor("vip/esqueci_minha_senha","<p>Esqueci minha senha.</p>",array("id"=>"esqueci"));
	echo "</fieldset>";
	echo form::close();	
?>