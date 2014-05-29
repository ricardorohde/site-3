<?php defined('SYSPATH') OR die('No direct access allowed.');

class Ajax_Controller extends Controller{
    function bairros_cidade( $cidade = null ) {
        $objs = ORM::factory('bairro')->where('slug_cidade', $cidade)->orderby('bairro')->find_all();

        $bairros = array();
        foreach ( $objs as $o ) {
            $bairros[ $o->slug ] = $o->bairro;
        }

      if(request::is_ajax())
       {
        $this->auto_render=false; //Disable the auto renderer, we don want a layout in our ajax response
         echo json_encode($bairros); //return a json encoded result
       }
    }


    function faixas_valor( $pret = null ) {
        $objs = ORM::factory('faixas_valor')->where('pret', $pret)->orderby('preco_min')->find_all();

        $faixas_valor = array();
        foreach ( $objs as $o ) {
            $faixas_valor[ $o->slug ] = $o->titulo;
        }

      if(request::is_ajax())
       {
        $this->auto_render=false; //Disable the auto renderer, we don want a layout in our ajax response
         echo json_encode($faixas_valor); //return a json encoded result
       }
    }

} // End Welcome Controller