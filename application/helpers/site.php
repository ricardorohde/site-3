<?php defined('SYSPATH') or die('No direct script access.');
 
class site_Core {
 
	public static function site_name()
	{	
		return Kohana::config('core.site_name');
	}
	
	public static function site_thumb()
	{	
		return "../../".Kohana::config('core.site_domain')."thumb_imoveis/"; //tá meio zuado isso
	}
	
	public static function desenvolvimento()
	{	
		return Kohana::config('core.desenvolvimento');
	}


	public static function url_padrao()
	{	
		return Kohana::config('core.url_padrao');
	}
	
	public static function site_email()
	{	
		return Kohana::config('core.site_email');
	}
 
}
?>