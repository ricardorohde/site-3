<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Template_Controller extends Controller {

	// Template view name
	public $template = 'main';

	// Default to do auto-rendering
	public $auto_render = TRUE;

    // pretenção
    public $pret = 'venda';

    //mostra o header
    public $show_header = true;

	/**
	 * Template loading and setup routine.
	 */
	public function __construct()
	{
		parent::__construct();

        if ( Site_Config_Model::info('em_manutencao') == 1 ) {
            echo 'em manutencao';
            exit;
        }

		// Load the template
		$this->template = new View($this->template);
		
		$this->template->title = 'Imobiliária, Venda e Locação de Imóveis, Casas, Apartamentos, Salas, Terrenos, Chacaras, Casas em condominio';

        if( $this->show_header ){
            $this->template->header = new View( 'header' );
        }


		$this->template->body_id = 'imoveis';

        $this->template->stylesheet = 'estilos';

		$this->template->footer = new View('footer');
		


		if ($this->auto_render == TRUE)
		{
			// Render the template immediately after the controller method
			Event::add('system.post_controller', array($this, '_render'));
		}
	}

	/**
	 * Render the loaded template.
	 */
	public function _render()
	{

    //if (expires::check(10) === FALSE) expires::set(10);

        if ($this->auto_render == TRUE)
		{
			// Render the template when the class is destroyed
			$this->template->render(TRUE);
		}
	}

    public function __call($method, $arguments)
	{
		// Disable auto-rendering
		$this->auto_render = FALSE;

		// By defining a __call method, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}

} // End Template_Controller