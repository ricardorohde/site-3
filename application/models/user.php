<?php defined('SYSPATH') or die('No direct script access.');

class User_Model extends ORM{
		
    protected $primary_key = 'id';
	protected $table_name = 'users';
	protected $plural = 'users';		
	protected $has_and_belongs_to_many = array('roles','imoveis');	
	protected $has_many = array('alertas');	
 
	public function unique_key($id = NULL)
	{
		if ( ! empty($id) AND is_string($id) AND ! ctype_digit($id) )
		{
			return 'email';
		}
 
		return parent::unique_key($id);
	}
 
	
}
