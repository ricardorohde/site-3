<?php 
 
class tools_Core {
 
	// limit as frases sem cortar as palavras ao meio
	public function cutText($string, $length) {
	        if($length<strlen($string)){
	            while ($string{$length} != " ") {
	                $length--;
	            }
	            return substr($string, 0, $length);
	        }else return $string;
	    }


	public function verifica_lista_multiplos($k)
	{			
		return ($k == "bairro" || $k =="tipo" || $k == "finalidade");
	}
	
	public function filtros_simples($k)
	{			
		return ($k == "cidade" || $k =="tipo"); //só
	}
	
	public function filtros_dropdown($k)
	{			
		return ($k == "banheiros" || $k =="dormitorios" || $k == "garagens" || $k == "faixa_valor" || $k == "cidade"); //que são drop down e só pode selecionar um
	}
	
	public function lista_finalidades()
	{			
		return "comercial|rural|residencial|industrial";
	}

    public function trata_url_imovel( $url,$add=null,$html=true,$like=false) { //add é o campo que quer se adicionar/remover
		
		$add_tipo = null;
		$add_valor = null;		        

        $param = array();		
        $l = explode('&', $url); //joga os parametros agora separados
		
		if($add != null){ //se tem coisa pra adicionar
			$add_vetor = explode("=",$add);
			
			$add_tipo = $add_vetor[0]; //tipo da prop que quer se incluir
			$add_valor = $add_vetor[1]; //valor dela
		}
		//print_r($add_valor);exit;
		
        foreach( $l as $arg ) { // cada prop ex tipo=casa
            $propriedade = explode('=', $arg); //separa
						
            if ( sizeof($propriedade) == 2 ) { // se a propriedade tem um valor atribuido
			
              $k = $propriedade[0]; //nome da propriedade ex tipo
              $v = $propriedade[1]; //valor dela ex casa
				
			  if($k != "faixa_valor"){	// melhorar isso - O VALOR PODE CONTER VÍRGULAS, ISSO DÁ PAU POIS NOS OUTROS A VIRUGULA SIGNIFICA VARIOS VALORES
				
				  $a = explode(",",$v); // vamos ver se o valor é multiplo
				
				  if( (sizeof($a) > 1) || tools::verifica_lista_multiplos($k)) //se tiver mais de uma opçao ex casa,terreno
					$v =$a; //joga o vetor			  				 		
				  else
					$v = $a[0];	//joga o valor sozinho		
				}
              $param[$k] = $v;
            }
        }		
		
		if($add != null) //se é um link do filtro. Vamos colocar os parametros novos de cada filtro
		{				
			if( isset($param[$add_tipo]) and $param[$add_tipo] != null)	 //se a propriedade já tiver algum valor	
				
				if(is_array($param[$add_tipo])) //se for um vetor
				{					
					$key = array_search($add_valor,$param[$add_tipo]);	
					
					if( $key === false) //verifica se já existe o valor, caso exista, remove, se nao, adiciona											
						$param[$add_tipo][] = $add_valor; //adiciona novo							
					else		
					{						
						array_splice($param[$add_tipo],$key,1); //remove
						if(sizeof($param[$add_tipo])==0)
							$param[$add_tipo] = null;					
					}	
			
				}
				else 
				{	// se for um valor unico
					if($add_valor != $param[$add_tipo]) //se for diferente, substitui
						$param[$add_tipo] = $add_valor; //valor simples
					else
						if(!tools::filtros_simples($add_tipo))
							$param[$add_tipo] = null; //se nao remove
				}
			else
			{				
				if(tools::verifica_lista_multiplos($add_tipo)) //se for um vetor
				{					
					$param[$add_tipo] = array(); //cria um vetor nesse campo
					$param[$add_tipo][] = $add_valor; //adiciona um valor
				}
				else // se for um valor simples
					$param[$add_tipo] = $add_valor; //valor simples			
			}
			
		}		
		
        // ----> monta a url    
//verifica_lista_multiplos
        $url_parte = array();
		$pretencao = array('venda' => 'a-venda', 'locacao' => 'para-alugar');
		
		//======================== varios tipos
		
		if(!array_key_exists('tipo',$param))
			$param["tipo"] = array("imoveis");
		$tipo = "";
	
		if(sizeof($param['tipo'] ) > 1) //remove imoveis da lista caso tenha outro
		{
			$key = array_search("imoveis",$param['tipo']);
			if( $key!==false )
				array_splice($param['tipo'],$key,1); 
		}	
			//print_r($param);exit;
		
		if($param['tipo'][0] != '')
		{				
			$count = 1;	
			$p = "";
			foreach($param['tipo'] as $opcao) //monta uma url com opçoes multiplas
			{ 
				if($count>1) $p.=",";
				$p .= $opcao;
				$count++;					
			}	
			$tipo = $p;// varios tipos
		}		
		
		$url_parte[] = $tipo;
		//=======================================
		

        //if ( array_key_exists('finalidade',$param ) and strlen( $param['finalidade'] ) > 0 ) $tipo .= '+' . $param['finalidade'];
       // if ( array_key_exists('finalidade',$param )) $url_parte[] .= $param['finalidade'];
	  	if ( array_key_exists('condominio',$param) && $param['condominio'] != '' ) $url_parte[] = 'em-condominio';  
		$url_parte[] = array_key_exists('pret',$param) ? $pretencao[ $param['pret'] ] : '';
        if ( array_key_exists('cidade',$param) && $param['cidade'] != '' ) $url_parte[] = 'em_' . $param['cidade'];
        if ( array_key_exists('bairro',$param) && $param['bairro'] != '' )
		{
			$count = 1;	
			$p = "";
			foreach($param['bairro'] as $opcao) //monta uma url com opçoes multiplas
			{ 
				if($opcao != null)
				{
					if($count>1) $p.=",";
					
					if($like)					
					{
						$sql = "SELECT slug as bairro FROM bairros where bairro like '%".$opcao."%'";						
						$db=new Database;
						$query = $db->query($sql)->result();					
						$result = $query[0];
						$opcao = $result->bairro;
					}
					
					$p .= $opcao;
					$count++;					
				}
			}	
			$url_parte[] = $p;// varios bairros
		}
		//print_r($url_parte);exit;
		//============= varias finalidades
	   
	   if ( array_key_exists('finalidade',$param) && $param['finalidade'] != '' )
		{
			$count = 1;	
			$p = "";
			foreach($param['finalidade'] as $opcao) //monta uma url com opçoes multiplas
			{ 
				if($opcao != null)
				{
					if($count>1) $p.=",";
					$p .= strtolower($opcao);
					$count++;					
				}
			}	
			$url_parte[] = $p;// varias finalidades
		}
	   
	   //==================================
		
		
        if ( array_key_exists('dormitorios',$param) ) 			
			$url_parte[] = $param['dormitorios'];
		
        if ( array_key_exists('banheiros',$param) ) 
			$url_parte[] = $param['banheiros'];			
	
        if ( array_key_exists('garagens',$param) )
			$url_parte[] = $param['garagens'];
		
		if ( array_key_exists('faixa_valor',$param) ) $url_parte[] = $param['faixa_valor'];
		if ( array_key_exists('area_construida',$param) ) $url_parte[] = $param['area_construida'];
		
		
		
        $url_parte_trat = array();
        foreach($url_parte as $u) {
            if ( strlen($u) > 0 ) $url_parte_trat[] = $u;
        }

        $url_amigavel = join('_', $url_parte_trat);
		if($html)
			$url_amigavel .= ".html";
		//echo($url_amigavel);exit;
		//print_r($param);exit;
        return $url_amigavel;
    }


    public function gera_fitro_da_url_amigavel( $q ) {
		
        $args = explode('_', $q);
	
        $filtro = array();
		
		$filtro['pret'] = array_key_exists('pret', $filtro) ? $filtro['pret'] : ($filtro['pret']=null); //alugar e vender
		$filtro['finalidade'] = array_key_exists('finalidade', $filtro) ? $filtro['finalidade'] : ($filtro['finalidade']=null);
		$filtro['tipo'] = array_key_exists('tipo', $filtro) ? $filtro['tipo'] : ""; 
		$filtro['cidade'] = array_key_exists('cidade', $filtro) ? $filtro['cidade'] : ($filtro['cidade']=null);
		$filtro['bairro'] = array_key_exists('bairro', $filtro) ? $filtro['bairro'] : "";
		$filtro['faixa_valor'] = array_key_exists('faixa_valor', $filtro) ? $filtro['faixa_valor'] : ($filtro['faixa_valor']=null);
        $filtro['dormitorios'] = array_key_exists('dormitorios', $filtro) ? $filtro['dormitorios'] : ($filtro['dormitorios']=null);
        $filtro['banheiros'] = array_key_exists('banheiros', $filtro) ? $filtro['banheiros'] : ($filtro['banheiros']=null);
        $filtro['garagens'] = array_key_exists('garagens', $filtro) ? $filtro['garagens'] : ($filtro['garagens']=null);
        $filtro['condominio'] = array_key_exists('condominio', $filtro) ? $filtro['condominio'] : ($filtro['condominio']=null);
        $filtro['area_construida'] = array_key_exists('area_construida', $filtro) ? $filtro['area_construida'] : ($filtro['area_construida']=null);
        $filtro['area_total'] = array_key_exists('area_total', $filtro) ? $filtro['area_total'] : ($filtro['area_total']=null);
		
		
        $tipo = null;
        //$finalidade = null;

		$indice = 0; //indice inicial
		
        if ( preg_match('/^(.+)\+(.+)/',$args[$indice], $r) ) {			
            $tipo = $r[1];
            //$finalidade = $r[2];
        } else
            $tipo = explode(",",$args[0]); //pega todos tipos, separado por ,		
       			
		//procura no vetor tipo
        if ( sizeof($tipo)==0) //se nao tem nenhum
			$filtro['tipo'][] = "imoveis"; //poe imoveis como padrao
		else
		{
			if(sizeof($tipo)>1)
			{
				$key = array_search("imoveis",$tipo);
				if($key!==false)
					array_splice($tipo,$key,1);
			}
					
			$filtro['tipo'] = $tipo; //ou poe oq procuraram
		}
		
		$indice++;//próximo	
		
		if($args[$indice] == "em-condominio") //verifica se o próximo é condominio
		{
			$filtro["condominio"] = $args[$indice];
			$indice++;
		}
			
        //if ( $finalidade ) $filtro['finalidade'] =  $finalidade;
		
        $pretencao = array('a-venda' => 'venda', 'para-alugar' => 'locacao');
        $filtro['pret'] = $pretencao[ $args[$indice++] ];	
			
		if(isset($args[$indice+1]))
		{		
			if($args[$indice] == "em")	
				$filtro['cidade'] = $args[++$indice];
		}
		else $indice--;
		
		//echo $indice;exit;
        for( $i = ($indice); $i<sizeof($args); $i++ ) {
		
			if ( array_key_exists($i+1, $args) )
			{
				$slug = $args[$i+1];
				if ( preg_match('/[0-9a-z]+\-(a|ou)\-[0-9a-z]+/', $slug, $r ) ) $filtro['faixa_valor'] = $slug;
				elseif ( preg_match('/('.tools::lista_finalidades().')/', $slug, $r ) )
				{
					$v = explode(",",$args[$i+1]);
					$filtro['finalidade'] = array();
					foreach($v as $a)							
					$filtro['finalidade'][] = $a;						
				}
				elseif ( preg_match('/(dormitorios)\-[0-9a-z]+/', $slug, $r ) ) $filtro['dormitorios'] = $slug;
				elseif ( preg_match('/(banheiros)\-[0-9a-z]+/', $slug, $r ) ) $filtro['banheiros'] = $slug;
				elseif ( preg_match('/(garagens)\-[0-9a-z]+/', $slug, $r ) ) $filtro['garagens'] = $slug;
				elseif ( preg_match('/(-a-)/', $slug, $r ) ) $filtro['faixa_valor'] = $slug;
				elseif ( preg_match('/(-ate-)/', $slug, $r ) ) $filtro['area_construida'] = $slug;
				else
				{
					$v = explode(",",$args[$i+1]);
					$filtro['bairro'] = array();
					foreach($v as $a)							
					$filtro['bairro'][] = $a;	
				}
				
				
			}
          
        }	
	
        return $filtro;
    }
	
	

	public function checar_seguindo($id=null)
	{
		if(isset($_SESSION['imoveis_usuario']))
		{			
			$imoveis = $this->session->get("imoveis_usuario",array());
			if(count($imoveis)>0)
				return (array_key_exists($id,$imoveis))?1:0;		
		}
		return 0;
	}
	
	
	public function get_qtd($n=null,$tipo)
	{			
		switch($tipo)
		{
			case "dormitorios": return ($n!=null)?("dormitorios-".$n):(null) ;break;
			case "banheiros": return ($n!=null)?("banheiros-".$n):(null) ;break;
			case "garagens": return ($n!=null)?("garagens-".$n):(null) ;break;
		}
	}
	
	public function reverse_qtd($n)
	{	
		if($n!=null){
			$a = explode("-",$n);
			return $a[1]; //retorna somente o numero
		}
	}

	public function formata_comodos($q)
	{
		$q = explode("-",$q);
		return $q[1]."+ ".substr($q[0],0,4);
	}
	
	public function addDayIntoDate($date,$days) {
		 $thisyear = substr ( $date, 0, 4 );
		 $thismonth = substr ( $date, 4, 2 );
		 $thisday =  substr ( $date, 6, 2 );
		 $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday + $days, $thisyear );
		 return strftime("%Y%m%d", $nextdate);
	}

	public function gera_str_dos_filtros($filtros,$like=false)
	{		
		$tipos = ORM::factory("tipo")->select_list("slug","tipo");	
		//print_r($filtros);exit;
		$ret = array();

		if(isset($filtros["cidade"]))
		{
			$cidade = ORM::factory("cidade")->where("slug",$filtros["cidade"])->find();
			$ret["cidade"] = $cidade->cidade;
		}

		$tipo = "Imóveis";			
		if($filtros["tipo"][0] != "imoveis")	
		{
			$tipo = "";
			foreach($filtros["tipo"] as $t)				
				$tipo .= ucfirst(strtolower($tipos[strtolower($t)])).", ";	//usa o tipo de lá de cima					
		}
				
		$ret["tipo"] = $tipo;
		
		$pret = ($filtros["pret"]=="venda")?(" A Venda"):(" Para Alugar");
		$ret["pret"] = $pret.", ";
		
		$db=new Database;			
		
		$bairro = "";
		if($filtros["bairro"] != null)				
			foreach($filtros["bairro"] as $ba)
			{
				/*if(!$like)
					$sql = "SELECT bairro as bairro FROM bairros where slug = '".$ba."'";
				else
					$sql = "SELECT bairro as bairro FROM bairros where slug like '%".$ba."%'";*/
				$sql = "SELECT bairro as bairro FROM bairros where slug = '".$ba."'";
				$query = $db->query($sql)->result();					
				$result = $query[0];
				$bairro .= $result->bairro.", ";
			}							
		$ret["bairro"] = $bairro;
		
		if($filtros["finalidade"] != null)			
			$ret["finalidade"] = implode(", ",$filtros["finalidade"]).", ";
		else
			$ret["finalidade"] = "";
		
		$faixa_valor = "Qualquer valor";			
		if($filtros["faixa_valor"]!=null)
		{			
			$faixas = explode("-a-",$filtros["faixa_valor"]);
			
			//minimo 
			$sql = "SELECT titulo as titulo FROM faixas_valor_".$filtros["pret"]." where slug = '".$faixas[0]."'";
			$db=new Database;
			$minimo = $db->query($sql)->result();					
			$minimo = $minimo[0];
			//maximo 
			$sql = "SELECT titulo as titulo FROM faixas_valor_".$filtros["pret"]." where slug = '".$faixas[1]."'";
			$db=new Database;
			$maximo = $db->query($sql)->result();	
			$maximo = $maximo[0];
			
			$faixa_valor = $minimo->titulo." - ".$maximo->titulo;
		}			
		$ret["faixa_valor"] = $faixa_valor;	
		
		$ret["dormitorios"] = ($filtros["dormitorios"]!=null)?(" ,".tools::formata_comodos($filtros["dormitorios"])):"";
		$ret["banheiros"] = ($filtros["banheiros"]!=null)?(" ,".tools::formata_comodos($filtros["banheiros"])):"";
		$ret["garagens"] = ($filtros["garagens"]!=null)?(" ,".tools::formata_comodos($filtros["garagens"]) ):"";
		$ret["condominio"] = ($filtros["condominio"]!=null)?("em condomínio, "):"";
		return $ret;
	}

		
	function make_slug($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}
}

?>