<?php defined('SYSPATH') OR die('No direct access allowed.');

class Welcome_Controller extends Template_Controller{

    public $show_header = true;
   	
	public function index()
	{
		$this->template->title = 'Imobiliária Campinas, Venda e Locação de Imóveis';
	}
	


} 