<?php defined('SYSPATH') OR die('No direct access allowed.');

class Exclusividade_Controller extends Template_Controller{

	public $template = 'main';

    public function __construct()
	{
		session_start();
		parent::__construct();
	}

	public function index()
	{
		$this->template->layout = new View('exclusividade');	   
		$this->template->body_id = "exclusividade";
		$this->template->title_important = 'Vender imovel em Campinas | Exclusividade Next Imoveis';		
	}  


}