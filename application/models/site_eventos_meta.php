<?php defined('SYSPATH') or die('No direct script access.');

class Site_Eventos_Meta_Model extends ORM{


}


/*

CREATE TABLE IF NOT EXISTS `site_eventos_metas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_eventos_id` int(10) unsigned NOT NULL,
  `chave` varchar(255) DEFAULT NULL,
  `valor` mediumtext,
  PRIMARY KEY (`id`),
  KEY `eventos_site_meta_FKIndex1` (`site_eventos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

*/


?>