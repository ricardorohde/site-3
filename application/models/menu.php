<?php defined('SYSPATH') or die('No direct script access.');

class Menu_Model extends ORM {
	
	/*
	 * table schema 
	 *
	 * 
CREATE TABLE `menus` (
  `id` int(11) NOT NULL auto_increment,
  `menu_type` int(2) NOT NULL default '1',
  `menu_item` varchar(50) character set utf8 NOT NULL,
  `url` varchar(50) character set utf8 NOT NULL,
  `link_title` varchar(50) character set utf8 NOT NULL,
  `ordering` tinyint(2) NOT NULL default '0',
  `sublevel` tinyint(2) NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
	 
	 */
}