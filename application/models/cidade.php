<?php defined('SYSPATH') or die('No direct script access.');

class Cidade_Model extends ORM{
	
	public function total(){
		
		$obj = ORM::factory('imovel')
			->where('cidade',$this->cidade);

            if(uri::segment(1)=='venda') $obj->where('venda',1);

		if(uri::segment(1)=='locacao') $obj->where('locacao',1);
		
		if(uri::segment(3)!='imovel') $obj->where('tipo',uri::segment(3));
			
		if(uri::segment(4)!='finalidade') $obj->where('finalidade',uri::segment(4));		
		
		if(uri::segment(6)) $obj->where('bairro',uri::segment(6));
			
		$obj = $obj->find_all();
			
		return count($obj);
		
	}
	
	public function total_index($tipo){
		
		$obj = ORM::factory('imovel')
			->where('cidade',$this->cidade);			
			
		if($tipo == "venda")
			$obj->where('venda',1);
		else
			$obj->where('locacao',1);
		
		$obj = $obj->find_all();
			
		return count($obj);
		
	}
	
}
