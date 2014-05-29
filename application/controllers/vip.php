<?php defined('SYSPATH') OR die('No direct access allowed.');

// *** PRM ****
//require_once dirname(__FILE__) . '/../../prm/PrmClient.php';
//require_once dirname(__FILE__) . '/../../prm/prm_api_config.php';
// *** PRM ****


class Vip_Controller extends Imoveis_Controller{
	
	function __construct(){	
		parent::__construct();		
		$this->template->layout = new View('vip/index');
		$this->template->body_id = "vip";				
	}	
	
    public function index()
	{		
		if(Auth::instance()->logged_in()) // se o usuario estiver logado
		{
			$this->template->title = 'Área Vip';			
			$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
			$this->template->layout->content->sidebar = new View("vip/sidebar");			
			$this->template->layout->content->conteudo = new View('vip/buscas_salvas'); //esse é o conteudo real da pagina
			$_GET["tipo_imovel"] = "venda";
			$this->template->layout->content->titulo_conteudo = "Buscas Salvas";					
		
		}
		else // se não estiver logado
		{
			$this->template->title = 'Login - Área Vip';
			$this->template->footer = null;
			$this->template->body_id = "vip_cadastro";			
			$this->template->layout->content = new View('vip/login'); //mostra form de login
		}
	}
	
	public function buscas_recentes()
	{
		$this->template->title = 'Buscas Recentes - Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/buscas_recentes'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Buscas Recentes";		
	}
	
	public function buscas_salvas()
	{
		$this->template->title = 'Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/buscas_salvas'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Buscas Salvas";	
	}
	
	public function buscas_sugeridas()
	{
		$this->template->title = 'Buscas sugeridas - Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/buscas_sugeridas'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Buscas Sugeridas";	
	}
	
	public function visualizacoes_recentes()
	{
		$this->template->title = 'Visualizações Recentes - Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/vis_recentes'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Visualizações Recentes";		
	}
	
	public function imoveis_seguidos()
	{
		$this->template->title = 'Imóveis seguidos - Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/imoveis_seguidos'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Imóveis seguidos";		
	}
	
	public function imoveis_sugeridos()
	{
		$this->template->title = 'Imóveis sugeridos - Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/imoveis_sugeridos'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Imóveis sugeridos";		
	}
	
	public function login() //loga o usuario atraves da senha e do username
	{	
		$email = $this->input->post("email", $this->input->post("username",0) );
		$password = $this->input->post("password");
		
		$user = ORM::factory('User', $email); //tentar achar o usuario com esse username
		$auth = new Auth();
		 
		if (!$user->loaded) //se nao achou			
			url::redirect("vip?usuario=1");		
		elseif ($auth->login($user, $password))
			{				
				if($this->input->post("imovel",false))	
					$this->seguir_imovel($this->input->post("imovel"),$this->input->post("pret"));
				url::redirect( $this->input->post("referrer","vip") );		
			}
		else
			url::redirect("vip?erro=1");
	
	}
	
	public function form_cadastro() // pagina de cadastro e login para o popup em ajax
	{	
		$this->auto_render = FALSE;
		$view = new View('vip/form_popup');		
		$view->imovel = $_GET['imovel'];
		$view->pret = $_GET['pret'];
		$view->referrer = $_GET['referrer'];
		print $view;
	}
	
	public function cadastro() // pagina de cadastro
	{	
		$this->template->footer = null;
		$this->template->body_id = "vip_cadastro";			
		$this->template->title = 'Cadastro - Área Vip';
		$this->template->layout->content = new View('vip/cadastro');	
		$this->template->layout->content->mostrar_corretor = false;
	}

	public function cadastro_corretor() // pagina de cadastro
	{	
		$this->template->footer = null;
		$this->template->body_id = "vip_cadastro";			
		$this->template->title = 'Cadastro - Área Vip';
		$this->template->layout->content = new View('vip/cadastro');	
		$this->template->layout->content->mostrar_corretor = true;
	}
	
	public function perfil()
	{
		$this->template->title = 'Meu Cadastro - Área Vip';			
		$this->template->layout->content = new View('vip/home');	//só um esquema de posicionamento
		$this->template->layout->content->sidebar = new View("vip/sidebar");			
		$this->template->layout->content->conteudo = new View('vip/perfil'); //esse é o conteudo real da pagina
		$this->template->layout->content->titulo_conteudo = "Meu cadastro";		
		$this->template->layout->content->conteudo->user = Auth::instance()->get_user();		
	}
	
	public function alterar_perfil()
	{
		$auth = Auth::instance();
		$user = $auth->get_user();	
		$user->fone = $this->input->post("fone");
		//$user->email = $this->input->post("email");	
		$user->nome = $this->input->post("nome");	
		$user->nascimento = $this->input->post("nascimento");	
		$user->endereco = $this->input->post("endereco");	
		$user->cidade = $this->input->post("cidade");	
		if($this->input->post("password")!=null)
			if($this->input->post("password") == $this->input->post("password_confirm"))			
			{$user->password = $auth->hash_password($this->input->post("password"));}
			else
				url::redirect("vip/perfil?senha=1");
				
			
		if($user->save())
			url::redirect("vip/perfil?sucesso=1");
		else
			url::redirect("vip/perfil?erro=1");
		
		
	}
	
	public function esqueci_minha_senha() // pagina de cadastro
	{
		$this->template->footer = null;
		$this->template->body_id = "vip_cadastro";			
		$this->template->title = 'Esqueci minha senha - Área Vip';
		$this->template->layout->content = new View('vip/form_esqueci');
	}

	public function cadastrar() //cadastrar o usuario no banco de dados
	{		

		if(Auth::instance()->logged_in()) //se estiver logado
			url::redirect("vip");
	
		$this->auth = new Auth();
		$username = $this->input->post('nome');
		$corretor = $this->input->post('corretor',"");
		$email = $this->input->post('email');	
		$fone = $this->input->post('fone');	
		$enviar_email = false;		
		if($this->input->post('password')!=null)
			$password = $this->input->post('password');
		else
		{			
			$password = substr(md5($username."".$email), 0, 7);//gera senha aleatória			
			$enviar_email = true;
		}
						
		$u = ORM::factory("User")->where("email",$email)->find(); //vamos ver se o email já existe;		
		if($u->loaded) //já existe
			url::redirect('vip/cadastro?jaexiste=1');
		
		//caso o nome de usuário esteja disponível
		$user = ORM::factory('User'); //cria um model de usuario
		$user->nome = $username;
		$user->email = $email;
		$user->username = $email;
		$user->fone = $fone;
		$user->corretor = $corretor;
		$user->password = $this->auth->hash_password($password);
		
		// if the user was successfully created...
		if ($user->add(ORM::factory('role','login')) AND $user->save()) {		//adiciona como role LOGIN e depois salva	
			$this->auth->login($email, $password); // loga o usuário	 

			// *** PRM ****
			/*$prm_api = new PrmClient($GLOBALS['prm_api_endpoint'], $GLOBALS['prm_api_key'] );

			// adiciona o cliente ao cadastro
			$prm_api->criarOuAtualizarCliente(
			    array(
			        'referencia' => $user->id,
			        'nome' => $user->nome,
			        'email' => $user->email,
			        'contatos' => array(
			                array('nome' => $user->nome, 'email' => $user->email, 'telefone1' => $user->fone )
			            )
			    )
			);

			// cria uma oportunidade para este cliente
			$prm_api->clienteAdicionarProdutoInteresse( array('cliente_referencia' => $user->id ));
*/
			// ********** 
			if($enviar_email)			
				$this->send_email("senha",$password);//envia email para o usuário	
			else
				$this->send_email("bemvindo");//envia email para o usuário		
				$this->send_email("aviso_adm");	//envia email de aviso para a equipe next de um novo cadastro
			
			if($this->input->post('imovel',false))//se tem imovel pra seguir
			{
				$this->seguir_imovel($this->input->post("imovel"),$this->input->post("pret"));
				url::redirect( $this->input->post("referrer","vip?tipo=vip&enviado=sucesso") );		
			}			
			
			url::redirect('vip?enviado=sucesso&tipo=vip'); //redireciona pra página inicial
		}
		else
			url::redirect('vip/cadastro?erro=1'); //volta pra página de cadastro e fala que deu erro
	
	}
	
	public function remove_sugerido($pkimovel=null)
	{
		$cod = $this->input->post("cod",$pkimovel);				
		$this->auto_render = FALSE;
		if(Auth::instance()->logged_in()) //se o usuario estiver logado
		{				
			$user = Auth::instance()->get_user();
			$sql = "DELETE from imovel_sugerido where user_id=".$user->id." and pkimovel=".$cod;				
			$db=new Database;
			$results = $db->query($sql);
			print true;
		}
		print false;
	}
	
	// se a pessoa selecionar o mesmo imovel para alugar e comprar, (vai) provavelmente dar pau
	public function seguir_imovel($pkimovel=null,$pretencao=null,$redirect=null)
	{	
	
		$cod = $this->input->post("cod",$pkimovel);
		$pret = $this->input->post("pret",$pretencao);
				
		$this->auto_render = FALSE;
		$imoveis = $this->session->get("imoveis_usuario");
		
		if(Auth::instance()->logged_in()) //se o usuario estiver logado
		{			
			$codigo = explode("_",$cod); //se o usuario já esta seguindo
			$user = Auth::instance()->get_user();
			
			if( (isset($codigo[1])) and ($codigo[1]=="remove")) //se o usuario ja esta seguindo o imovel
			{					
				$imovel = ORM::factory('Imovel',$codigo[0]);
				$user->add($imovel);				 	

				// *** PRM ****
				// ---> remove o imovel do PRM
				/*
				$prm_api = new PrmClient($GLOBALS['prm_api_endpoint'], $GLOBALS['prm_api_key'] );
				$prm_api->clienteRemoveProdutoInteresse( array('cliente_referencia' => $user->id,
																  'produto_referencia' => $imovel->cod_jb
																)
				);*/

				unset($imoveis[$codigo[0]]); //remove do array o elemento de codigo $codigo[0]					
				$user->remove(ORM::factory('imovel',$codigo[0]));					
			}
			else
			{	
				$imovel = ORM::factory('Imovel',$codigo[0]);
				$user->add($imovel);				 	

				// *** PRM ****
				/*
				// ---> notifica o PRM a respeito do interesse sobre o imovel ----
				$prm_api = new PrmClient($GLOBALS['prm_api_endpoint'], $GLOBALS['prm_api_key'] );
				$prm_api->clienteAdicionarProdutoInteresse( array('cliente_referencia' => $user->id,
																  'produto_referencia' => $imovel->cod_jb, 
																  'params' => array('canal' => 'site_vip') 
																)
				);*/
			}
			 
			$this->session->set("imoveis_usuario",$imoveis); //adiciona na session	de novo
			
			if($user->save())
			{
				
				//atualiza os dados da tabela imoveis_users com o pret e a data criada
				$sql = "UPDATE imoveis_users set pret ='".$pret."', created = '".date("Y-m-d")."' where id=".mysql_insert_id();
				//"' where user_id = ".$user->id." and imovel_pkimovel = ".$codigo[0];
				$db=new Database;
				$results = $db->query($sql);
				print true;
			}
				
			print false;					
		}
		
	}
	
	public function salvar_busca()
	{	
		if(!Auth::instance()->logged_in()) //se nao estiver logado
			url::redirect("vip");
			
		$this->auto_render = FALSE;
		$maior_id = $this->input->post("maior_pkimovel");
		$url_amigavel = parse_url($_SERVER['HTTP_REFERER']);
		$url_amigavel = substr( end(explode("/",$url_amigavel["path"])),0, -5 );
		
		$user_id = Auth::instance()->get_user()->id; //pega o id do usuario
				
		$a = ORM::factory("Alerta")->where("user_id",$user_id)->where("alerta",$url_amigavel)->find(); //vamos ver se o alerta já existe para esse usuario;		
		if(!$a->loaded) //se não existe ainda
		{
			$alerta = ORM::factory('Alerta');								
			$alerta->alerta = $url_amigavel; //poe a url da busca
			$alerta->user_id = $user_id; //poe o id do usuario
			$alerta->created = date("Y-m-d"); //poe a data
			$alerta->proximo_envio = date("Y-m-d"); //poe a data para o proximo envio como hoje
			$alerta->frequencia = 0; //			
			$filtros = tools::gera_fitro_da_url_amigavel($url_amigavel);						
			$im = busca::busca($filtros,"recentes",1,10,"alerta_maior_pkimovel"); //atualiza com o ultimo id dessa busca	
			$im	= ORM::factory("Imovel",$im);
			$alerta->maior_pkimovel = $im->alterado;

			$filtros = tools::gera_fitro_da_url_amigavel($url_amigavel);
			foreach($filtros as $key=>$value)
				if($value == "" || $value == null)				
					unset($filtros[$key]);			
			
			$alerta->filtros_json = json_encode($filtros);

			if($alerta->save()) //salva a busca 
				print 1;
			else
				print 0;
		}
		else print 0;
		
	}	
	
	public function remover_busca()
	{
		$id = uri::segment("remover_busca");
		$user = Auth::instance()->get_user();			
		if($id=="todas")		
			foreach($user->alertas as $alerta)
				ORM::factory('Alerta')->delete($alerta->id);				
		else
		{			
			$busca = ORM::factory("Alerta",$id)->where("user_id",$user->id);
			if($busca->loaded)		
				ORM::factory('Alerta')->delete($id);						
		}
		url::redirect("vip/buscas_salvas");
	}
	public function remover_busca_sugerida()
	{
		$id = uri::segment("remover_busca_sugerida");
		$user = Auth::instance()->get_user();			
		if($id=="todas")
		{
			$sql = "DELETE from busca_sugerida where user_id =".$user->id;
			$db=new Database;
			$result = $db->query($sql);
				
		}
		else
		{			
			$sql = "DELETE from busca_sugerida where user_id=".$user->id." and id=".$id;
			$db=new Database;
			$result = $db->query($sql);						
		}
		url::redirect("vip/buscas_sugeridas");
	}
	
	public function logout()
	{
		Auth::instance()->logout();
		url::redirect('vip');
	}
	
	public function call()
	{	
	//cookie::delete('imoveis_recentes');
	 print_r($_COOKIE);
	 exit;
	}
	
	public function troca_frequencia()
	{
		$this->auto_render = FALSE;
		$frequencia = $this->input->post("frequencia");
		$id = $this->input->post("id");
		$alerta = ORM::factory("Alerta",$id);
		$alerta->frequencia = $frequencia;
		
		$date = implode("",explode("-",date("Y-m-d")));
		switch($frequencia) //vamos mexer na data do proximo dsparo de acordo com a frequencia
		{
			case 0://diario
				$nextdate = tools::addDayIntoDate($date,1);break;
			case 1://semanal
				$nextdate = tools::addDayIntoDate($date,7);break;
			case 2://mensal
				$nextdate = tools::addDayIntoDate($date,30);break;
		}
	
		$alerta->proximo_envio = $nextdate;	
		
		$alerta->save();
		print "1";
	}
	
	public function script_alertas()
	{
		$this->auto_render = FALSE;
		$hoje = date("Y-m-d"); //ver o lance da diferença de horários
		$alertas = ORM::factory("Alerta")->where("proximo_envio",$hoje)->find_all();			
		$tipos = ORM::factory("tipo")->select_list("slug","tipo");	//array com os filtros, pra nao carregar toda vez, já que é pequeno	
		foreach($alertas as $alerta) //para cada alerta
		{				
			$filtros = tools::gera_fitro_da_url_amigavel($alerta->alerta);
			$filtros['maior_pkimovel'] = $alerta->maior_pkimovel;
			$busca = busca::busca($filtros,"recentes",1,10,"alerta");	
	
			$date = implode("",explode("-",$alerta->proximo_envio));
			switch($alerta->frequencia) //vamos mexer na data do proximo dsparo de acordo com a frequencia
			{
				case 0://diario
					$nextdate = tools::addDayIntoDate($date,1);break;
				case 1://semanal
					$nextdate = tools::addDayIntoDate($date,7);break;
				case 2://mensal
					$nextdate = tools::addDayIntoDate($date,30);break;
			}
		
			$alerta->proximo_envio = $nextdate;			
		//echo sizeof($busca);exit;
			if(sizeof($busca) > 0)// se tem imoveis novos no alerta
			{				
				$im = busca::busca($filtros,"recentes",1,80,"alerta_ultimos");				
				$alerta->maior_pkimovel = $im;
				
				$array_imoveis = array();
				foreach($busca as $imovel) //para cada imovel
					$array_imoveis[] = ORM::factory("Imovel",$imovel);
				
				$email = new View("vip/email_alertas");				
				$email->imovel = $array_imoveis;
				$email->busca = implode("",tools::gera_str_dos_filtros($filtros,$tipos));
				$email->pret = $filtros["pret"];
				$mensagem = $email->render(false);
				//print $mensagem;exit;
				$swift = email::connect();

				// From, subject and HTML message
				$from = new Swift_Address ( site::site_email() , 'Site '. site::site_name() );
				$subject = "Novos imóveis para você!";

				// Build recipient lists
				$recipients = new Swift_RecipientList;
				$recipients->addTo( $alerta->user->email );

				// Build the HTML message
				$message = new Swift_Message( $subject , $email , "text/html" );
				
				if ( $swift->send( $message , $recipients , $from) )				
					echo 'deu certo';				
				else								  
				  echo 'Não deu certo';				  			
				
				$swift->disconnect();						
			}

			$alerta->save();
			
		}
		//$this->auto_render = FALSE;
	}
	
	public function send_email($tipo = "senha",$password=null)
	{				
		if(Auth::instance()->logged_in()) //se encontrou o usuario
		{
			$user = Auth::instance()->get_user();				
			$email = $user->email;				
		
			if($tipo == "senha")
			{
				$view_email = new View('view_email_senha');				
				$view_email->nome = $user->nome;  
				$view_email->senha = $password;
				$sub = "Área VIP - Next Soluções Imobiliárias";
			}
			elseif($tipo == "bemvindo")
			{
				$view_email = new View('view_email_bem_vindo');				
				$view_email->nome = $user->nome;  				
				$sub = "Área VIP - Next Soluções Imobiliárias";
			}
			else
			{
				$view_email = new View('view_email_aviso_adm');
				$view_email->nome = $user->nome;  
				$view_email->telefone = $user->fone;  
				$view_email->email = $user->email;
				$email = array("site" => site::site_email(),"bola"=>"mb82br@gmail.com","igor" => "igor@templum.com.br");
				$sub = "Área VIP - Novo cadastro";
				
			}
			
			$mensagem = $view_email->render(false);
			
			//ORM::factory('site_evento')->adiciona($titulo, $info );

			// Use connect() method to load Swiftmailer and connect using the parameters set in the email config file
			$swift = email::connect();

			// From, subject and HTML message
			$from = new Swift_Address ( site::site_email() , 'Site '. site::site_name() );
			$subject = $sub;

			// Build recipient lists
			$recipients = new Swift_RecipientList;
			$recipients->addTo( $email );

			// Build the HTML message
			$message = new Swift_Message( $subject , $mensagem , "text/html" );	
			$swift->send( $message , $recipients , $from);		
			$swift->disconnect();			
		}		
    }

} // End Vip Controller