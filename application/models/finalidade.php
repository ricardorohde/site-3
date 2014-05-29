<?php defined('SYSPATH') or die('No direct script access.');

class Finalidade_Model extends ORM{
	
	public function total(){

		$obj = ORM::factory('imovel')
            ->where('finalidade',$this->finalidade);

            if(uri::segment(1)=='venda') $obj->where('venda',1);

		if(uri::segment(1)=='locacao') $obj->where('locacao',1);

		if(uri::segment(3)!='imovel') $obj->where('tipo',uri::segment(3));	
		
		if(uri::segment(5)) $obj->where('cidade',uri::segment(5));	
		
		if(uri::segment(6)) $obj->where('bairro',uri::segment(6));
			
		$obj = $obj->find_all();
			
		return count($obj);
		
	}

}