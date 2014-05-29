<?php defined('SYSPATH') OR die('No direct access allowed.');

class Quem_somos_Controller extends Template_Controller{

	public $template = 'main';

    public function __construct()
	{
		session_start();
		parent::__construct();
	}

	public function index()
	{
		$this->template->layout = new View('quem_somos');	   
		$this->template->body_id = "quem_somos";
		$this->template->title = 'Quem somos';		
	}  


}