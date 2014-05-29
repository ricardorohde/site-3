<?php defined('SYSPATH') OR die('No direct access allowed.');

class Impressao_Controller extends Controller{

    public function __construct()
	{
		parent::__construct();

        // prepara filtros para painel lateral

	}


    public function info( $cod_jb = null )
	{
        $my_view = new View( 'simples' );
        $my_view->body_id = 'ferramentas';
        $my_view->title = 'Solicitar informações';
        $my_view->layout = View::factory( 'contato/form' );
        $my_view->layout->imovel = $cod_jb ;
        $my_view->layout->tipo = 'contato_informacoes';
        $my_view->layout->title = 'Solicitar informações';
        $my_view->layout->label_mensagem = 'Mensagem';
        $my_view->render(TRUE);

    }


    public function imovel( $cod_jb )
    {
        $my_view = new View( 'simples' );
        $my_view->body_id = 'detalhes';
        $my_view->layout = new View('detalhes_impressao');

        $row = ORM::factory('imovel')->where('cod_jb', $cod_jb)->find();

        $my_view->title = 'Ficha do imóvel: ' . $row->cod_jb;

        /*
        // Create a new Gmap
		$map = new Gmap('map', array
		(
			'ScrollWheelZoom' => FALSE,
            'GoogleBar' => FALSE
		));

		list ($lat, $lon) = Gmap::address_to_ll($row->endereco.','.$row->cidade.','.$row->uf);

		// Set the map center point
		$map->center($lat, $lon, 15)->controls('large')->types('G_PHYSICAL_MAP', 'add');

		// Add a custom marker icon
		$map->add_icon('tinyIcon', array
		(
			'image' => url::base().'images/hh_20_red.png',
            //'image' => 'http://localhost/homehunters/images/hh_20_red.png',
			'shadow' => 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
			'iconSize' => array('20', '34'),
			'shadowSize' => array('22', '20'),
			'iconAnchor' => array('10', '35'),
			'infoWindowAnchor' => array('5', '1')
	    ));

		// Add a new marker
		$map->add_marker($lat, $lon, '<strong>Home Hunters</strong><p></p>', array('icon' => 'tinyIcon', 'draggable' => true, 'bouncy' => true));

        $js = '<script src="'.Gmap::api_url().'" type="text/javascript"></script>';
        $js .= '<script type="text/javascript">'.$map->render().'</script>';


        $my_view->extra_header = $js;

        */

        $my_view->layout->row = ORM::factory('imovel')->where('cod_jb', $cod_jb)->find();  

        $my_view->render(TRUE);
    }





}