<?php defined('SYSPATH') or die('No direct script access.');

class Alerta_Model extends ORM {    
 
	protected $table_name = 'alertas';
	protected $plural = 'alertas';
	protected $belongs_to = array('user');		
 
	public function unique_key($id = NULL)
	{
		if ( ! empty($id) AND is_string($id) AND ! ctype_digit($id) )
		{
			return 'id';
		}
 
		return parent::unique_key($id);
	}
 
}
