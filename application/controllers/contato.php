<?php defined('SYSPATH') OR die('No direct access allowed.');

class Contato_Controller extends Template_Controller{

	public $template = 'main';

    public function __construct()
	{
		session_start();
		parent::__construct();
	}

	public function index()
	{
		$this->auto_render = FALSE;	
		print new View('contato/form');		
		
	}  
}