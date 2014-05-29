<?php defined('SYSPATH') or die('No direct script access.');

class Site_Config_Model extends ORM{


    public static function info( $chave ) {

        $obj = ORM::factory('site_config')->where('chave',$chave)->find();

        $ret = null;
        if ( $obj ) {
            $ret = $obj->valor;
        }

        return $ret;
    }


    public static function set_info( $chave, $valor ) {

        $obj = ORM::factory('site_config')->where('chave',$chave)->find();

        if ( $obj ) {
            $obj->valor = $valor;
            $obj->save();
        }
    }



}


?>