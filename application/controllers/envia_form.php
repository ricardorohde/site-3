<?php defined('SYSPATH') OR die('No direct access allowed.');

class Envia_Form_Controller extends Controller{

    public function __construct()
	{
		parent::__construct();

        // prepara filtros para painel lateral

	}


    public function teste() {
        $v = new View('form_assinatura');

        $v->render(TRUE);
    }

    public function send( $formulario )
	{
		$post = $this->input->post();
		if(count($post) == 0) //previne que mande o form sem ter dados (spam)
			exit;
        $form = Kohana::config('formularios_dados.' . $formulario );

        $titulo = $form['titulo'];
        $campos = $form['campos'];
		
		
		
        
        $view_email = new View('view_email');
        $view_email->post = $post;
        $view_email->campos = $campos;
        $view_email->titulo = $titulo;       
				
        $mensagem = $view_email->render(false);

        $info = array();
        foreach( $campos as $k => $v ) {
            if ( array_key_exists($k, $post) && $post[$k] != '' ) {

                $info[ $v['label'] ] = $post[$k];
            }
        }
		
        ORM::factory('site_evento')->adiciona($titulo, $info );

        // Use connect() method to load Swiftmailer and connect using the parameters set in the email config file
		$swift = email::connect();

		// From, subject and HTML message
		$from = new Swift_Address ( site::site_email() , 'Site '. site::site_name() );
		$subject = $titulo;

		// Build recipient lists
		$recipients = new Swift_RecipientList;
        $recipients->addTo( $form['para'] );
        $recipients->addTo("igor@templum.com.br");
        $recipients->addTo("nextsim.site@gmail.com");

		// Build the HTML message
		$message = new Swift_Message( $subject , $mensagem , "text/html" );
		
		if ( $swift->send( $message , $recipients , $from) )
		{
			echo 'deu certo';
			$my_view->main_content = '<div class="notice">Mensagem enviada com sucesso</div>';
		}
		else
		{
		  // Failure
          echo 'Não deu certo';
          $my_view->main_content = View::factory( 'forms/info' );
		}
        // Disconnect
		$swift->disconnect();

			
		$parse = parse_url($_SERVER['HTTP_REFERER']);
		//print_r($parse);exit;
		$parse['path'] = str_replace("index.php/","",$parse['path']);
		
		if( (!isset($parse['query'])) || ($parse['query']=="busca=1") )
		$parse['query'] = "enviado=1&tipo=".$formulario;		
		else				
			$parse['query'] .= "&enviado=1&tipo=".$formulario;				
				
        url::redirect($parse['path']."?".$parse['query'] );

    }
	
	public function send_senha()
	{			
		$auth = Auth::instance();
		$user = ORM::factory("user",( isset($_POST["username"]) )?($_POST["username"]):($_GET['username']) );
		if($user->loaded) //se encontrou o usuario
		{
			$password = substr(md5(uniqid()), 0, 7);//gera senha aleatória			
			$email = $user->email; 
			$user->password = $auth->hash_password($password); //muda a senha no bd		
			$user->save();
			
			$email = $user->email;			
			
			$view_email = new View('view_email_senha');
			$view_email->titulo = "Alteração de senha";
			$view_email->user = $user->username;  
			$view_email->senha = $password;

			$mensagem = $view_email->render(false);
			
			//ORM::factory('site_evento')->adiciona($titulo, $info );

			// Use connect() method to load Swiftmailer and connect using the parameters set in the email config file
			$swift = email::connect();

			// From, subject and HTML message
			$from = new Swift_Address ( site::site_email() , 'Site '. site::site_name() );
			$subject = "Senha Área VIP - Next Soluções Imobiliárias";

			// Build recipient lists
			$recipients = new Swift_RecipientList;
			$recipients->addTo( $email );

			// Build the HTML message
			$message = new Swift_Message( $subject , $mensagem , "text/html" );
			
			if ( $swift->send( $message , $recipients , $from) )
			{
				if(isset($_GET['username']))
					url::redirect("vip");	
				else				
					url::redirect("vip/esqueci_minha_senha?msg_enviada=1");				
			}
			else
				url::redirect("vip/esqueci_minha_senha?nao_enviado=1");
			// Disconnect
			$swift->disconnect();			
		}		
		else url::redirect("vip/esqueci_minha_senha?nao_encontrado=1");			

    }
	
	public function email()
	{
		$v = new View('vip/email_alertas');
		$v->imovel = ORM::factory("imovel")->where("pkimovel >=","1777743")->find_all();
		$v->pret = "venda";
		print $v;
	}
    
}
















