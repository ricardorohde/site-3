<?php defined('SYSPATH') or die('No direct script access.');

class Bairro_Model extends ORM{
	
	public function total(){
		
		$obj = ORM::factory('imovel')
			->where('bairro',$this->bairro);

            if(uri::segment(1)=='venda') $obj->where('venda',1);

		if(uri::segment(1)=='locacao') $obj->where('locacao',1);
		
		if(uri::segment(3)!='imovel') $obj->where('tipo',uri::segment(3));
			
		if(uri::segment(4)!='finalidade') $obj->where('finalidade',uri::segment(4));		
		
		if(uri::segment(5)) $obj->where('cidade',uri::segment(5));
			
		$obj = $obj->find_all();
			
		return count($obj);
		
	}
	
}
