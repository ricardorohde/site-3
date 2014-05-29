<?php defined('SYSPATH') OR die('No direct access allowed.');

class Negocie_Controller extends Template_Controller{

	// Set the name of the template to use
	public $template = 'main';

    public function __construct()
	{
		parent::__construct();
		$this->template->body_id = 'imoveis';
        // carrega painel de busca

        $this->template->before_content = new View('painel_contato');


	}


     public function index()
    {
        $this->template->title = 'Negocie seu imóvel';
        $this->template->layout = new View( 'contato/negocie' );
        $this->template->layout->tipo = 'contato_negocie';
        $this->template->layout->tipos = ORM::factory( 'tipo' )->find_all()->select_list('slug','tipo');
        $this->template->layout->finalidades = ORM::factory( 'finalidade' )->find_all()->select_list('slug','finalidade');

    }



    public function send_negocie()
	{
        $this->template->title = 'Negocie seu imóvel';

        // Use connect() method to load Swiftmailer and connect using the parameters set in the email config file
		$swift = email::connect();

		// From, subject and HTML message
		$from = new Swift_Address ( site::site_email() , 'Site '. site::site_name() );
		$subject = 'Negocie seu imóvel ' . date("d/m/Y");
		$mensagem = '<h2>Dados pessoais</h2>';
        $mensagem .= 'Nome: '.$this->input->post('nome').'<br/>';
		$mensagem .= 'Email: '.$this->input->post('email').'<br/>';
        $mensagem .= 'Tel: '.$this->input->post('tel').'<br/>';
        $mensagem .= 'Cidade: '.$this->input->post('cidade').'<br/>';
        $mensagem .= 'Endereço: '.$this->input->post('endereco').'<br/>';

        $mensagem .= '<h2>Dados do imóvel</h2>';

        $mensagem .= 'Tipo: '.$this->input->post( 'tipo' ) .'<br />';
        $mensagem .= 'Cobertura: '.$this->input->post( 'cobertura' ) .'<br />';
        $mensagem .= 'Finalidade: '.$this->input->post( 'finalidade' ) .'<br />';
        $mensagem .= 'Pretenção: '.$this->input->post( 'pretencao' ) .'<br />';
        $mensagem .= 'Financiado: '.$this->input->post( 'financiado' ) .'<br />';
        $mensagem .= 'Endereço: '.$this->input->post( 'end_imovel' ) .'<br />';
        $mensagem .= 'Bairro: '.$this->input->post( 'bairro' ) .'<br />';
        $mensagem .= 'Área: '.$this->input->post( 'area' ) .'<br />';
        $mensagem .= 'Valor: '.$this->input->post( 'valor' ) .'<br />';
        $mensagem .= 'Paga condomínio: '.$this->input->post( 'paga_condominio' ) .'<br />';
        $mensagem .= 'Valor condomínio: '.$this->input->post( 'valor_condominio' ) .'<br />';
        $mensagem .= 'Descrição:'.$this->input->post( 'descricao' ) .'<br />';
        $mensagem .= 'Observações: '.$this->input->post( 'obs' ) .'<br />';
        $mensagem .= 'Exclusividade: '.$this->input->post( 'exclusividade' ) .'<br />';

		$mensagem .= $this->input->post('mensagem');

		// Build recipient lists
		$recipients = new Swift_RecipientList;
        $recipients->addTo( site::site_email() );

		// Build the HTML message
		$message = new Swift_Message( $subject , $mensagem , "text/html" );

		if ( $swift->send( $message , $recipients , $from) )
		{
          ORM::factory('site_evento')->adiciona('contato_negocie', $this->input->post() );
          $this->template->layout = '<div class="notice">Mensagem enviada com sucesso</div>';
		}
		else
		{
		  // Failure
          $this->template->layout = View::factory( 'forms/info' );
		}

        // Disconnect
		$swift->disconnect();

    }



} // End Welcome Controller