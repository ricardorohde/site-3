<?php defined('SYSPATH') or die('No direct script access.');

class busca_Core {

	public function busca($filtros, $ord = NULL, $pag = 1, $itens_por_pag = 10, $tipo_resultado = 'lista_imoveis', $agrupa_por = null,$ajax=false)
	{			
		$pret = array_key_exists('pret', $filtros) ? $filtros['pret'] : null;
		$tipo = array_key_exists('tipo', $filtros) ? $filtros['tipo'] : null;
		$finalidade = array_key_exists('finalidade', $filtros) ? $filtros['finalidade'] : null;
		$slug_cidade = array_key_exists('cidade', $filtros) ? $filtros['cidade'] : null;
		$slug_bairro = array_key_exists('bairro', $filtros) ? $filtros['bairro'] : null;
		$slug_faixa_valor = array_key_exists('faixa_valor', $filtros) ? $filtros['faixa_valor'] : null;
        $destaque = array_key_exists('destaque', $filtros) ? $filtros['destaque'] : null;
        $exclusividade = array_key_exists('exclusividade', $filtros) ? $filtros['exclusividade'] : null;
        $dorm = array_key_exists('dormitorios', $filtros) ? $filtros['dormitorios'] : null;
        $banheiros = array_key_exists('banheiros', $filtros) ? $filtros['banheiros'] : null;
        $garagens = array_key_exists('garagens', $filtros) ? $filtros['garagens'] : null;
        $condominio = array_key_exists('condominio', $filtros) ? $filtros['condominio'] : null;
	
		
		
		$ord = explode("-", (($ord == null) ? 'valor' : $ord) );
    	$ordem = array(
            'at' => 'area_total',
            'valor' => 'val'.$pret,            
            'ac' => 'area_construida',
            'au' => 'area_util',
            'tipo_tipo' => 'tipo.tipo',
            'fvpmin' => 'faixa.preco',
            'dorm_min' => 'dormitorios.min',
            'banheiros_min' => 'banheiros.min',
            'garagens_min' => 'garagens.min',
            'bairro_cidade' => 'bairro.cidade',
            'bairro_bairro' => 'bairro.bairro',
            'aleatorio' => 'RAND()',
            'recentes' => 'pkimovel DESC'
             );
    	$campo_ordem = $ordem[$ord[0]].( ( array_key_exists(1,$ord) )?(" ".$ord[1]):("") );

    	$where = "1=1";


    	if ( $pret == 'venda' ) {
    		$where .= " AND im.venda='1'";
    	}
        if ( $pret == 'locacao' ) {
    		$where .= " AND im.locacao='1'";
    	}
    	if ( $tipo ) {
			//se tiver MOVEIS troca para *, pois seleciona qualquer coisa
			
			$key = array_search("imoveis",$tipo);
			
			if($key === false) // nao achou nada
			{
				if(sizeof($tipo)>1) //varios tipos
					$tipo = implode("', '",$tipo); 
				else
					$tipo = implode("''",$tipo); 
				$where .= " AND im.tipo in ('$tipo')";	
			}  
			
    	}
    	if ( $slug_cidade ) {
    		$where .= " AND bairro.slug_cidade='$slug_cidade'";
    	}
		
    	if ( $slug_bairro ) {
			if(is_array($slug_bairro)) //varios bairros				
			{
				$b = implode("', '",$slug_bairro);    //varios bairros		
				$where .= " AND bairro.slug in ('$b')";
			}
			else{}
    	}
		if ( $finalidade ) {
			if(is_array($finalidade)) //varias finalidades		
			{
				$b = implode("', '",$finalidade);  
				$where .= " AND im.finalidade in ('$b')";
			}
			else{}
    	}
        if ( $destaque ) {
    		$where .= " AND im.destaque='1'";
    	}
        if ( $exclusividade ) {
    		$where .= " AND im.exclusividade='E'";
    	}
		
    	if ( $slug_faixa_valor ) {
		
			$a = explode("-a-",$slug_faixa_valor);
			
			if($a[0] != "qualquer-valor")
			{
				 //slug do preço minimo
				$min = 0;
				$w = "slug = '".$a[0]."'";		
				$sql = "SELECT preco as preco FROM faixas_valor_".$pret." where $w";
				$db=new Database;
				$result = $db->query($sql);						
				foreach ( $result as $kr ) 			
					$min = $kr->preco; 
				$where .= " AND im.val".$pret." > $min";
			}
			
			if($a[1] != "qualquer-valor")
			{
				 //slug do preço minimo
				$max = 0;
				$w = "slug = '".$a[1]."'";		
				$sql = "SELECT preco as preco FROM faixas_valor_".$pret." where $w";
				$db=new Database;
				$result = $db->query($sql);						
				foreach ( $result as $kr ) 			
					$max = $kr->preco; 
				$where .= " AND im.val".$pret." < $max";
			} 	
			
    	}
		
		
        if ( $dorm ) {
    		$where .= " AND im.dormitorios_slug='$dorm'"; // isso é para lugares que tem 6 quartos mas é tratado como 4 ou mais    		
    	} 
		if ( $banheiros ) {
    		$where .= " AND im.banheiros_slug='$banheiros'";    		
    	}
		if ( $garagens ) {
    		$where .= " AND im.garagens_slug='$garagens'";    		
    	}	
		if ( $condominio ) {
    		$where .= " AND im.valor_cond > 0";    		
    	}	
		
        /*
    	if ( array_key_exists('finalidade', $filtros) ) {
            $k = "";
            if ( $filtros['finalidade'] == 'residencial' ) {
                $k = 'residencial';
            } elseif ( $filtros['finalidade'] == 'comercial' ) {
                $k = 'comercial';
            } elseif ( $filtros['finalidade'] == 'industrial' ) $k = 'industrial';

            if ( strlen($k) > 0 ) {
        		$where .= " AND im.$k=1";
            }
    	} */

        // ---> conta o numero de itens
       	$sql = "
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE $where
	    ";
		//echo $sql;exit;
    	$db=new Database;
    	$results = $db->query($sql);
        $total_itens = $results[0]->total_itens;

        $paginador = new Pagination( array('items_per_page' => $itens_por_pag, 'total_items' => $total_itens, 'query_string' => 'pagina', 'style' => 'punbb' , 'uri_segment' => 1) );
				
        // ---> obtem os itens
    	$offset = ( $pag - 1 ) * $itens_por_pag;
        $objs = array();
		
        if ( $tipo_resultado == 'lista_imoveis' ) {
        	$sql = "
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
					
					LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE $where
    	    	ORDER BY $campo_ordem
    	    	LIMIT $offset, $itens_por_pag
    	    ";
			
        	$db=new Database;
        	$results = $db->query($sql);
        	$ids = array(-1);
        	foreach($results as $row)
            {
            	$ids[] = $row->pkimovel;
            }			
						
			foreach($ids as $id)
			{
				if($ajax)
				{
					$im = ORM::factory('imovel')->find( $id );
					
					$miniatura = $im->pega_miniatura();
					
					$a = array(
						"cod_jb" => $im->cod_jb ,
						"dorm" => $im->dorm , 
						"valor_cond" => $im->valor_cond,						
						"garagem" => $im->garagem,
						"preco" => number_format( ($pret=="venda")?($im->valvenda):($im->vallocacao) ,2,',','.'),
						"area_construida" => $im->area_construida,
						"area_construida" => $im->area_construida,
						"bairro" => $im->bairro,					
						"cidade" => $im->cidade,					
						"miniatura" => (!$miniatura)?("images/sem_foto.gif"):($miniatura->arqfoto ),					
						"descricao_miniatura" => (!$miniatura)?(""):($miniatura->descricao )		
						//"link" => html::anchor($im->gera_url(), '<span>Mais Info</span>' , array('class' => 'plus'))
						 );
					$objs[] = $a;
				
				}
				else	
					$objs[] = ORM::factory('imovel')->find( $id );
					
				//print_r($objs);exit;
			}

            $objs = array_slice($objs,1);
        } else if ( $tipo_resultado == 'total_categoria' ) {
			
			//if($pret == "venda")
			if($slug_faixa_valor != null)
				$faixa_valor = "INNER JOIN faixas_valor_".$filtros["pret"]." AS faixa ON faixa.slug=im.faixa_valor_".$filtros["pret"]."_slug";
			
        	$sql = "
        	SELECT $agrupa_por as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE $where
    	    	GROUP BY $agrupa_por
    	    	ORDER BY $campo_ordem
    	    ";
			//echo $sql;
        	$db=new Database;
        	$results = $db->query($sql);
        	$ids = array(-1);
        	foreach($results as $row)
            {
                $objs[ $row->chave ] = $row->total;
            }			
        }					

        if($ajax)
		{		
			$firephp = FirePHP::getInstance(true);
 			$firephp->log($paginador, 'Iterators');
		
			$json = array();
			$json['resultados'] = $objs;
			$json['paginador'] = array ("current_first" => $paginador->current_first_item , 
										"current_last" => $paginador->current_last_item, 
										"previous_page" => $paginador->previous_page,
										"next_page" => $paginador->next_page,
										"objeto" => $paginador->render());
			$json['total_itens'] = $total_itens;
			$json['ordenacao'] =  $this->campos_ordenacao($ord,$paginador->current_page);
			
			return $json;
				
		}
		else		
			return array('resultados' => $objs, 'paginador' => $paginador, 'total_itens' => $total_itens , "ordenacao" => $this->campos_ordenacao($ord,$paginador->current_page));
	}

	
	

	public function painel($filtros)
	{
		
	    // filtros é oq foi selecionado para filtrar o imovel
	
		$pret = array_key_exists('pret', $filtros) ? $filtros['pret'] : ($filtros['pret']=null); //alugar e vender
		$finalidade = array_key_exists('finalidade', $filtros) ? $filtros['finalidade'] : ($filtros['finalidade']=null);
		$tipo = array_key_exists('tipo', $filtros) ? $filtros['tipo'] : ""; 
		$slug_cidade = array_key_exists('cidade', $filtros) ? $filtros['cidade'] : ($filtros['cidade']=null);
		$slug_bairro = array_key_exists('bairro', $filtros) ? $filtros['bairro'] : "";
		$slug_faixa_valor = array_key_exists('faixa_valor', $filtros) ? $filtros['faixa_valor'] : ($filtros['faixa_valor']=null);
        $dorm = array_key_exists('dormitorios', $filtros) ? $filtros['dormitorios'] : ($filtros['dormitorios']=null);
        $ban = array_key_exists('banheiros', $filtros) ? $filtros['banheiros'] : ($filtros['banheiros']=null);
        $gar = array_key_exists('garagens', $filtros) ? $filtros['garagens'] : ($filtros['garagens']=null);
					
		//print_r($filtros);exit;
		// tipos
		
		//============================== TIPOS
        $tipos = array();		
		$sql = "SELECT * FROM tipos ORDER BY tipo";
		$db=new Database;
        $result = $db->query($sql);		
        foreach ( $result as $kr )            
            $tipos[$kr->slug] = $kr->tipo;
				
		
          $finalidades = array(
              'residencial' => 'Residencial',
              'comercial' => 'Comercial',
              'industrial' => 'Industrial',
              'rural' => 'Rural',
          );


       /* $res = self::busca($filtros, 'bairro_cidade', null, null, 'total_categoria',
             "concat_ws('__', CASE WHEN residencial=1 THEN 'residencial' ELSE '0' END,
                              CASE WHEN comercial=1 THEN 'comercial' ELSE '0' END,
                              CASE WHEN rural=1 THEN 'rural' ELSE '0' END,
                              CASE WHEN industrial=1 THEN 'industrial' ELSE '0' END  )");
        $finalidades = array();
        foreach ( array_keys($res['resultados']) as $k ) {
            $l = split('__', $k);
            foreach ( $l as $o ) {
                if ( $o != '0' ) $finalidades[$o] = $finalidades0[$o];
            }
        }*/
		
		 // ==========================CIDADES
		
		$cidades = array();		
		$sql = "SELECT slug,cidade FROM cidades ORDER BY cidade";
		$db=new Database;
        $result = $db->query($sql);		
        foreach ( $result as $kr )            
            $cidades[$kr->slug] = $kr->cidade;		
		

        // trata finalidade
        $finalidade = null;
    	if ( array_key_exists('finalidade', $filtros) ) {
       		$finalidade = $filtros['finalidade'];
    	}


        // ==========================BAIRROS
		
		$bairros = array();		
		$sql = "SELECT slug,bairro FROM bairros WHERE slug_cidade = '".$slug_cidade."' ORDER BY cidade";
		$db=new Database;
        $result = $db->query($sql);		
        foreach ( $result as $kr )            
            $bairros[$kr->slug] = $kr->bairro;		
		
			
		// ==========================FAIXA DE VALOR
		$min = null;
		$max = null;
		
		if($slug_faixa_valor != "" || $slug_faixa_valor != null)
		{
			$a = explode("-a-",$slug_faixa_valor);		
			
			$sql = "SELECT ord FROM faixas_valor_".$pret." where slug = '".$a[0]."'";
			$db=new Database;
			$result = $db->query($sql);		
			foreach ( $result as $kr )  				
				$min = $kr->ord;		

			$sql = "SELECT ord FROM faixas_valor_".$pret." where slug = '".$a[1]."'";
			$db=new Database;
			$result = $db->query($sql);		
			foreach ( $result as $kr )  				
				$max = $kr->ord;			
		}
		// ==========================DORMITORIOS
		
		$dormitorios = array();		
		$sql = "SELECT slug,titulo FROM dormitorios ORDER BY min";
		$db=new Database;
        $result = $db->query($sql);		
        foreach ( $result as $kr )            
            $dormitorios[$kr->slug] = $kr->titulo;		
	  
        // ==========================BANEHHEIROS
		
		$banheiros = array();		
		$sql = "SELECT slug,titulo FROM banheiros ORDER BY min";
		$db=new Database;
        $result = $db->query($sql);		
        foreach ( $result as $kr )            
            $banheiros[$kr->slug] = $kr->titulo;		
		
		// ==========================GARAGENS
		
		$garagens = array();		
		$sql = "SELECT slug,titulo FROM garagens ORDER BY min";
		$db=new Database;
        $result = $db->query($sql);		
        foreach ( $result as $kr )            
            $garagens[$kr->slug] = $kr->titulo;		 


        $campos = array(
				 'cidade' => array('titulo'=>'Cidade',
                                'valor'=>$slug_cidade,
                                'opcoes'=> $cidades,
                                ),
				 'bairro' => array('titulo'=>'Bairro',
                                'valor'=>$slug_bairro,
                                'opcoes'=> $bairros,
                                ),
                'tipo' => array('titulo'=>'Tipo',
                                'valor'=>$tipo,
                                'opcoes'=> $tipos,
                                ),
				 'faixa_valor' => array('titulo'=>'Valor',
								'opcoes' => null,
                                'valor'=>$slug_faixa_valor,                                
								"min" => $min,
								"max" => $max,
                                ),
                'finalidade' => array('titulo'=>'Finalidade',
                                'valor'=>$finalidade,
                                'opcoes'=> $finalidades,
                                ),               
                'dormitorios' => array('titulo'=>'Dormitórios',
                                'valor'=>$dorm,
                                'opcoes'=> $dormitorios,
                                ),
				'banheiros' => array('titulo'=>'Banheiros',
                                'valor'=>$ban,
                                'opcoes'=> $banheiros,
                                ),
				'garagens' => array('titulo'=>'Garagens',
                                'valor'=>$gar,
                                'opcoes'=> $garagens,
                                )
                );
				//	echo "<pre>";
				//		print_r($campos);exit;
        return $campos;
		
    }


    public function gera_title( $filtros )
    {
        $pret = array_key_exists('pret', $filtros) ? $filtros['pret'] : null;;
		$tipo = array_key_exists('tipo', $filtros) ? $filtros['tipo'] : null;;
		$cidade = array_key_exists('cidade', $filtros) ? $filtros['cidade'] : null;
		$bairro = array_key_exists('bairro', $filtros) ? $filtros['bairro'] : null;
		$faixa_valor = array_key_exists('faixa_valor', $filtros) ? $filtros['faixa_valor'] : null;
        $dormitorios = tools::reverse_qtd( array_key_exists('dormitorios', $filtros) ? $filtros['dormitorios'] : null );
        $banheiros = tools::reverse_qtd( array_key_exists('banheiros', $filtros) ? $filtros['banheiros'] : null );
        $garagens = tools::reverse_qtd( array_key_exists('garagens', $filtros) ? $filtros['garagens'] : null );
        $finalidade = array_key_exists('finalidade', $filtros) ? $filtros['finalidade'] : null;
		
		$page_title = "";
		
		if($tipo != null || $tipo != ''):
			$tipo_atual = ORM::factory('tipo')->in('slug', $tipo)->find_all();					
			$c = 1;
			foreach($tipo_atual as $v)
			{
				if($c>1)$page_title .= ", ";
				$page_title .= $v->tipo;				
				$c++;
			}
		endif;
		
		//prepara o nome do tipo do imovel
		/*if(array_search('galpao',$tipo)):
			$page_title = 'Galpões';
		elseif(array_search('salao',$tipo)):
			$page_title = 'Salões';
		elseif($tipo == null || $tipo == ''):
			$page_title = 'Imóveis';
		else:
			$tipo_atual = ORM::factory('tipo')->in('slug', $tipo)->find_all();
			foreach($tipo_atual as $v)
				$page_title .= $v->tipo.'s ';
		endif;  */


		// prepara pretenção
		if($pret == 'venda'):
    		$page_title .= ' a venda';
    	elseif($pret == 'locacao'):
    		$page_title .= ' para alugar';
    	endif;

       // if( $finalidade ) $page_title .= ' - ' .$finalidade;


		//prepara o nome da Cidade
		if($cidade != null || $cidade != ''):
			$cidade_atual = ORM::factory('cidade')->where('slug', $cidade)->find();
			$page_title .= ' em '.$cidade_atual->cidade;
		endif;

        //prepara o nome do bairro
		if($bairro != null || $bairro != ''):
			$bairro_atual = ORM::factory('bairro')->in('slug', $bairro)->find_all();			
			$page_title .= ', bairro(s): ';
			$c = 1;
			foreach($bairro_atual as $v)
			{
				if($c>1)$page_title .= ", ";
				$page_title .= $v->bairro;				
				$c++;
			}
		endif;
	
        //prepara a quantidade de dormitorios
		if($dormitorios != null):
            $db = Database::instance();
			$dorm = $db->select()->from('dormitorios')->where('min', $dormitorios)->get(); 			
            $dorm_atual = $dorm->current();
			$page_title .= '. Dormitorios: '.$dorm_atual->titulo;
			//$page_title .= '. Dormitorios: '.$dormitorios;			
		endif;
		
		
		if($banheiros != null):          
			$db = Database::instance();
			$ban = $db->select()->from('banheiros')->where('min', $banheiros)->get(); 
            $ban_atual = $ban->current();
			$page_title .= '. Banheiros: '.$ban_atual->titulo;		
		endif;
		
		if($garagens != null):          
			$db = Database::instance();
			$gar = $db->select()->from('garagens')->where('min', $garagens)->get(); 
            $gar_atual = $gar->current();
			$page_title .= '. Garagens: '.$gar_atual->titulo;		
		endif;
		
        /* valor está atrapalhando o SEO
        if( $faixa_valor != null ):
            $db =  new Database();
            $db->select()->from('faixas_valor')->where('slug', $faixa_valor);
            $query = $db->get();
            foreach( $query as $row ):
                $page_title .= '. Valor: '.$row->titulo;
            endforeach;

        endif;
        */
		//echo $page_title;exit;
        return $page_title;

    }
	
	public function campos_ordenacao($get_ord,$pag)
	{		
		$get_ord[1] = ( array_key_exists(1,$get_ord) )?($get_ord[1]):("");
		
		$campos = array(
			"valor"=>"Preço",
			"dorm_min"=>"Dormitórios",
			"ac"=>"Área Construída"
		);
		
		$p = "<ul>";		
		$p .= "<li><span>Ordenar por:</span></li>";
		foreach(array_keys($campos) as $k )
		{
			/*$ord = "?";
			$pagina = "";
			
            if($_GET['pagina'])
			{
				$pagina = "&pagina=".$_GET['pagina'];
				//$ord = "&";
			}
			*/
			$ord = $k;
			if( isset($_GET['ord']) && ($_GET['ord'] == $k) ) //se ele já estive definido
				$ord = $k."-desc"; //poe para ser decrescente
				
			//else ( isset($_GET['ord']) && ($_GET['ord'] == ($k."-desc") ) ) //se for o desc

			$class =  (isset($_GET['ord']) && ($get_ord[0] == $k))?("active")?("");
			$p .= "<li>".html::anchor( url::current(true)."#" ,$campos[$k], array("id"=>"ordenacao" , "class" => "$class" , "onclick"=>"pesquisa('".url::current()."','".$pag."','".$ord."')" ) )."</li>";
		}
		
		$p .= "<ul>";
		
		return $p;
	}




}

?>