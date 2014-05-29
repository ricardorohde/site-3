<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package  Core
 *
 * Sets the default route to "welcome"
 */
$config['_default'] = 'imoveis';
$config['([^.]+)\.html'] = 'imoveis/lista/1/$1';

$config['comprar-imoveis'] = 'venda/lista';
$config['alugar-imoveis'] = 'locacao/lista';
$config['quero-negociar'] = 'negocie';
$config['comprar-apartamento-(.*)$'] = 'imoveis/lista/1/apartamento_a-venda_em_campinas_$1';
$config['comprar-casa-(.*)$'] = 'imoveis/lista/1/casa_a-venda_em_campinas_$1';
$config['alugar-casa-(.*)$'] = 'imoveis/lista/1/casa_para-alugar_em_campinas_$1';
$config['alugar-apartamento-(.*)$'] = 'imoveis/lista/1/casa_para-alugar_em_campinas_$1';




