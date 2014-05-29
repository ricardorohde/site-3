<?php defined('SYSPATH') OR die('No direct access allowed.');

$config['assinatura'] = array(
                              'titulo' => 'Quero assinar a revista',
                              'campos' => array('nome_empresa' => array('label' => 'Nome da empresa'),
                                                'endereco' => array('label' => 'Endereço'),
                                                'bairro' => array('label' => 'Bairro'),
                                                'cidade' => array('label' => 'Cidade'),
                                                ),
                        );


$config['teste'] = array(
                              'titulo' => 'Quero assinar a revista mesmo',
                              'campos' => array('nome_empresa' => array('label' => 'Nome da empresa'),
                                                'cidade' => array('label' => 'Cidade'),
                                                ),
                        );

$config['contato'] = array(
                              'titulo' => 'Contato do site',
                              'campos' => array('nome' => array('label' => 'Nome'),
                                                'email' => array('label' => 'Email'),
                                                'departamento' => array('label' => 'Departamento'),
                                                'tel' => array('label' => 'Telefone'),
                                                'mensagem' => array('label' => 'Mensagem')                                                
                                                ),								
								'para' => 'mb82br@gmail.com'
                        );
$config['seja_vip'] = array(
                              'titulo' => 'Seja VIP',
                              'campos' => array('nome' => array('label' => 'Nome'),
                                                'email' => array('label' => 'Email'),                                               
                                                'tel' => array('label' => 'Telefone'),
												'imovel' => array('label' => 'Imóvel')
                                                ),							
								'para' => 'mb82br@gmail.com'
                        );
$config['vender_imovel'] = array(
                              'titulo' => 'Venda seu imóvel',
                              'campos' => array('nome' => array('label' => 'Nome'),
                                                'email' => array('label' => 'Email'),
                                                'tel' => array('label' => 'Telefone'),
												 'check_venda' => array('label' => 'Disponível para venda'),
                                               'check_locacao' => array('label' => 'Disponível para locação'),
                                                
                                                ),								
								'para' => 'mb82br@gmail.com'
                        );
$config['agente'] = array(
                              'titulo' => 'Interesse em Imóvel do Site',
                              'campos' => array('nome' => array('label' => 'Nome'),
                                                'email' => array('label' => 'Email'),
                                                'fone' => array('label' => 'Telefone'),
                                                'mensagem' => array('label' => 'Mensagem'),
                                                'imovel' => array('label' => 'Imóvel'),
                                                ),								
								'para' => 'mb82br@gmail.com'
                        );

