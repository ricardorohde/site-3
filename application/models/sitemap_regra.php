<?php defined('SYSPATH') or die('No direct script access.');

class sitemap_regra_Model extends ORM {


    public function links() {
        $grupos = array();

        foreach( ORM::factory('sitemap_regra')->orderby('ordem')->find_all() as $regra ) {
            $filtros = array('pretencao', 'tipo', 'finalidade', 'cidade', 'bairro');

            $links = array();

            $base_titulo = $regra->titulo;
            $base_slug = $regra->slug;
            $base_link_title = $regra->link_title;

            foreach ( $filtros as $filtro ) {
                $valor = $regra->$filtro;

                $valores = explode(';', $valor);

                $ph = "%" . $filtro . '%';

                $titulos = array();
                if ( strpos($base_titulo, $ph) > 0 ) {
                  foreach ( $valores as $v ) {
                      $titulo = $base_titulo;
                      $titulo = str_replace($ph, $v, $titulo );
                      $titulos[$v] = $titulo;
                  }
                }

                $slugs = array();
                if ( strpos($base_slug, $ph) > 0 ) {
                  foreach ( $valores as $v ) {
                      $slug = $base_slug;
                      $slug = str_replace($ph, $v, $slug );
                      $slugs[$v] = $slug;
                  }
                }

                $link_titles = array();
                if ( strpos($base_link_title, $ph) > 0 ) {
                  foreach ( $valores as $v ) {
                      $link_title = $base_link_title;
                      $link_title = str_replace($ph, $v, $link_title );
                      $link_titles[$v] = $link_title;
                  }
                }


                  foreach ( $valores as $v ) {
                    if ( array_key_exists($v, $titulos) ) {
                        $links[] = array('titulo' => $titulos[$v], 'slug' => $slugs[$v], 'link_title' => $link_titles[$v] );
                    }
                  }

            }

            $grupos[] = array('titulo' => $regra->titulo_geral, 'links' => $links );

        }






        return $grupos;
    }






}