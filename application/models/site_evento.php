<?php defined('SYSPATH') or die('No direct script access.');

class Site_Evento_Model extends ORM {

    public static function adiciona( $tipo = null, $metas = array() ) {

        $obj = ORM::factory('site_evento');
        $obj->quando = Date('Y-m-d H:i:s');
        $obj->tipo_evento = $tipo;
        $obj->save();


        foreach ( array_keys($metas) as $k ) {
            $o = ORM::factory('site_eventos_meta');
            $o->site_eventos_id = $obj->id;
            $o->chave = $k;
            $o->valor = $metas[$k];
            $o->save();
        }



    }



/*

CREATE TABLE IF NOT EXISTS `site_eventos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quando` datetime DEFAULT NULL,
  `tipo_evento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


*/



}


?>