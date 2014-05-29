<?php
include '../geral/slugs.php';

    $conexao = mysql_pconnect("localhost","root") or die($msg[0]);
    mysql_select_db("next",$conexao) or die($msg[1]);

//    $conexao = mysql_pconnect("localhost","root","awk492") or die($msg[0]);
//	mysql_select_db("nextsim",$conexao) or die($msg[1]);
		
	$q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'conexão')";
	$resultado = mysql_query($q,$conexao);

	echo 'conectou ';

	$campos = "pkimovel,loc_longitude,loc_latitude,inf_cep,inf_referencia,inf_situacao,inf_tipo,inf_subtipo,inf_venda,inf_locacao,inf_valvenda,inf_vallocacao,inf_cidade,inf_uf,inf_bairro,det_sala,det_dormitorios,det_Suite,det_banheiros,det_garagens,inf_CondoNome,Cap_ValCondominio,det_AreaTerreno,det_AreaComum,det_AreaTotal,det_AreaConst,det_AreaUtil,int_anunciointernet,int_pubdestaque,inf_valsobconsulta";

	//conecta ao webservice
	$client = new SoapClient("http://www.centrina.com.br/WSConsumoPortal/Service.asmx?wsdl",array("encoding"=>"UTF-8"));
	// carrega o dados do webservice
	$imoveis = $client->getListaImoveis(array('fkempresa'=>'1390','senha'=>'NE1390' , 'campos'=>$campos));
	$imagens = $client->getFotos(array('fkempresa'=>'1390','senha'=>'NE1390'));   
	// carrega os imóveis
	
	$lista = load($imoveis->getListaImoveisResult);
	$lista_imagens = load($imagens->getFotosResult);

 /* echo '<pre>';
  print_r( $lista_imagens );
  exit;  */
  echo 'carregou o xml ';

  $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'load xml')";
  $resultado = mysql_query($q,$conexao);

  if ( sizeof( $lista ) > 0 ){

	$imoveis = array();
	$query = "SELECT pkimovel as pkimovel,cod_jb as cod_jb from imoveis";
    $resultado = mysql_query($query,$conexao);
	while($q = mysql_fetch_assoc($resultado))
		$imoveis[$q["pkimovel"]] = $q["cod_jb"];
	
	$imoveis_lista = array();
    $nimv = 0;
    foreach( $lista as $row ){
        $nimv++;
        echo 'imv: ' . $nimv . "  ";

      

	//print_r($row);exit;
      $obj = array();

      foreach (array_keys($row) as $k){
        $obj[$k] = $row[$k];
      }
	  $imoveis_lista[$obj["pkimovel"]] = $obj["cod_jb"];
      if ( preg_match('/RES/', strtoupper ($row['finalidade'])) ) {
          $obj['residencial'] = 1;
      }

      if ( preg_match('/COM/', strtoupper($row['finalidade'])) ) {
          $obj['comercial'] = 1;
      }

      if ( preg_match('/INDUSTRIAL/', strtoupper($row['finalidade'])) ) {
          $obj['industrial'] = 1;
      }

      if ( preg_match('/RURAL/', strtoupper($row['finalidade'])) ) {
          $obj['rural'] = 1;
      }
	 
	  if( array_key_exists($obj["pkimovel"],$imoveis) ) //se o imovel ja existe, vai atualizar
	  {
		$q = "UPDATE imoveis set ";
		unset($obj["alterado"]);
		$count = count($obj);
		$pos = 1;
		foreach ( array_keys($obj) as $k )			
		{			
			$q .= $k." = '".mysql_real_escape_string( $obj[$k], $conexao )."' ";
			if( $pos < $count )
				$q .= ",";
			$pos++;
		}
		
		$q .= "where pkimovel = ".$obj["pkimovel"];
		
		//echo $q;
		$resultado = mysql_query($q,$conexao);
	  }
	  else //inserir
	  {
	  
		$fields = implode(",", array_keys($obj));

		$values = "";
		foreach ( array_keys($obj) as $k ) {
		$values .= "'" . mysql_real_escape_string( $obj[$k], $conexao ) . "',";
		}
		$values = substr($values,0, strlen($values) - 1);
		  
		$q = "INSERT INTO imoveis ($fields) VALUES ($values)";
		//echo $q;
		$resultado = mysql_query($q,$conexao);
	  
	  }
		//echo "<br><br>";

    }

    $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'tabela imoveis atualizada')";
    $resultado = mysql_query($q,$conexao);


	foreach($imoveis as $k => $v)
		if( !array_key_exists($k,$imoveis_lista) )//se o imovel que est� no bd, n�o for encontrado no xml que veio, apaga
		{
			$q = "DELETE from imoveis where pkimovel = '".$k."'";
			//echo $q;
			$resultado = mysql_query($q,$conexao);
		}

    echo 'atualizou tabela imoveis ';

    }else{

      $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'problemas com o xml')";
      $resultado = mysql_query($q,$conexao);

      echo 'problemas com o xml dos imóveis';
    }

    if ( sizeof( $lista_imagens ) > 0 ){

    $query = "TRUNCATE TABLE fotos";
    $resultado = mysql_query($query,$conexao);

    foreach( $lista_imagens as $row ){
	//print_r($row);exit;

	  if($row["minia"]==1){
      //  $image = new SimpleImage($row['arqfoto']); 

          $img = file_get_contents($row['arqfoto']);
          $im = imagecreatefromstring($img);
          $width = imagesx($im);
          $height = imagesy($im);
          $newwidth = '200';
          $newheight = '120';
          $thumb = imagecreatetruecolor($newwidth, $newheight);
          imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
          imagejpeg($thumb,'../thumb_imoveis/r_'.$row["pkimovel"].'.jpg'); //save image as jpg
          imagedestroy($thumb); 
          imagedestroy($im);

        // $image->resize(200,120); 
        // $image->save('../thumb_imoveis/r_'.$row["pkimovel"].".jpg"); 
      }

      $obj = array();

      foreach (array_keys($row) as $k){
       // echo $k . '<br/>';
		if($k!="alterado")
			$obj[$k] = $row[$k];
      }

      $fields = implode(",", array_keys($obj));

      $values = "";
      foreach ( array_keys($obj) as $k ) {
        $values .= "'" . mysql_real_escape_string( $obj[$k], $conexao ) . "',";
      }
      $values = substr($values,0, strlen($values) - 1);

      $q = "INSERT INTO fotos ($fields) VALUES ($values)";
echo $q;
      $resultado = mysql_query($q,$conexao);
    }

    $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'tabela fotos atualizada')";
    $resultado = mysql_query($q,$conexao);

    echo 'atualizou tabela fotos ';

    }else{

      $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'problemas com o xml')";
      $resultado = mysql_query($q,$conexao);

      echo 'problemas com o xml das fotos';

    }
    // manutencao tabelas




    // EXTRAI OS BAIRROS
    $query = "TRUNCATE TABLE busca_bairros";
    $resultado = mysql_query($query,$conexao);

    $query = "INSERT INTO busca_bairros (UF,CIDADE,BAIRRO)
                SELECT uf,cidade,bairro
                FROM `imoveis`
                GROUP BY uf,cidade,bairro
                ORDER BY uf,cidade,bairro";
    $resultado = mysql_query($query,$conexao);


    $query = "INSERT INTO bairro_sinonimos (uf,bairro,cidade)
          SELECT bb.uf,bb.bairro,bb.cidade
          FROM busca_bairros AS bb
          LEFT OUTER JOIN bairro_sinonimos AS bs ON (bb.uf=bs.uf AND bb.cidade=bs.cidade AND bb.bairro=bs.bairro)
          WHERE bs.uf IS NULL";
    $resultado = mysql_query($query,$conexao);


    $query = "UPDATE bairro_sinonimos SET sinonimo = bairro WHERE sinonimo IS NULL;";
    $resultado = mysql_query($query,$conexao);


    // -- PREPARA A TABELA DE SLUGS PARA BAIRROS
    $query = "TRUNCATE TABLE bairros";
    $resultado = mysql_query($query,$conexao);


    $query = "INSERT INTO bairros (UF,CIDADE,BAIRRO)
          SELECT UF,CIDADE,SINONIMO
          FROM bairro_sinonimos
          GROUP BY UF,CIDADE,SINONIMO";
    $resultado = mysql_query($query,$conexao);


    // -- PREPARA A TABELA DE SLUGS PARA CIDADES
    $query = "TRUNCATE TABLE cidades";
    $resultado = mysql_query($query,$conexao);

    $query = "INSERT INTO cidades (UF,CIDADE)
          SELECT UF,CIDADE
          FROM bairro_sinonimos
          GROUP BY UF,CIDADE";
    $resultado = mysql_query($query,$conexao);


    // -- EXTRAI OS TIPOS
    $query = "TRUNCATE TABLE tipos";
    $resultado = mysql_query($query,$conexao);

    $query = "INSERT INTO tipos (TIPO)
          SELECT tipo
          FROM `imoveis`
          GROUP BY tipo";
    $resultado = mysql_query($query,$conexao);


    $query = "UPDATE imoveis AS im
              INNER JOIN faixas_valor_venda AS faixa ON (
              im.valvenda >= faixa.preco_min
              AND im.valvenda < faixa.preco_max )
              SET im.faixa_valor_venda_slug=faixa.slug";
    $resultado = mysql_query($query,$conexao);

    $query = "UPDATE imoveis AS im
              INNER JOIN faixas_valor_locacao AS faixa ON (
              im.vallocacao >= faixa.preco_min
              AND im.vallocacao < faixa.preco_max )
              SET im.faixa_valor_locacao_slug=faixa.slug";
    $resultado = mysql_query($query,$conexao);

    $query = "UPDATE imoveis AS im
              INNER JOIN banheiros AS banheiros ON (
              im.banheiro >= banheiros.min
              AND im.banheiro < banheiros.max )
              SET im.banheiros_slug=banheiros.slug";
    $resultado = mysql_query($query,$conexao);

    $query = "UPDATE imoveis AS im
              INNER JOIN garagens AS gar ON (
              im.garagem >= gar.min
              AND im.garagem < gar.max )
              SET im.garagens_slug=gar.slug";
    $resultado = mysql_query($query,$conexao);


    $query = "UPDATE imoveis AS im
              INNER JOIN dormitorios AS dormitorios ON (
              im.dorm >= dormitorios.min
              AND im.dorm < dormitorios.max )
              SET im.dormitorios_slug=dormitorios.slug";
    $resultado = mysql_query($query,$conexao);

    $query = "SELECT * FROM bairros";
    $resultado = mysql_query($query,$conexao);
    while ($linha = mysql_fetch_array($resultado)) {
      $uf = $linha['uf'];
      $cidade = $linha['cidade'];
      $bairro = $linha['bairro'];

      $slug = makeSlugs($linha['bairro']);
      $slug_cidade = trim(makeSlugs($linha['cidade']));
      mysql_query("UPDATE bairros SET slug='$slug',slug_cidade='$slug_cidade' WHERE uf='$uf' AND cidade='$cidade' AND bairro='$bairro'");

    }

    $query = "SELECT * FROM cidades";
    $resultado = mysql_query($query,$conexao);
    while ($linha = mysql_fetch_array($resultado)) {
      $uf = $linha['uf'];
      $cidade = $linha['cidade'];

      $slug = makeSlugs($linha['cidade']);

      mysql_query("UPDATE cidades SET slug='$slug' WHERE uf='$uf' AND cidade='$cidade'");

    }


    $query = "SELECT * FROM tipos";
    $resultado = mysql_query($query,$conexao);
    while ($linha = mysql_fetch_array($resultado)) {
      $tipo= $linha['tipo'];

      $slug = makeSlugs($linha['tipo']);


      mysql_query("UPDATE tipos SET slug='$slug' WHERE tipo='$tipo'");

    }

    $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() , 'tabelas de busca atualizada')";
    $resultado = mysql_query($q,$conexao);

    echo 'fim';

    $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() , 'sucesso')";
    $resultado = mysql_query($q,$conexao);

function load( $arquivo ,$limit=0) {

   // $document = file_get_contents($arquivo);
    $document = $arquivo;

    $lista_imoveis = array();

    $xml = $document;
    if ($xml == '') {
      return false;
    }
	
   // $xml = htmlentities($xml);
   // $xml = str_replace("&lt;", "<", $xml);
   // $xml = str_replace("&gt;", ">", $xml);
   // $xml = str_replace("&quot;", '"', $xml);
//    $xml = utf8_decode($xml);
	//$xml = utf8_encode($xml);
    //$xml = preg_replace('/\&([^;]+);/',"--\\1;", $xml);

    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->encoding = "UTF-8";
    /*
    echo '<pre>';
    print_r($xml);
    break;*/
    if ( $doc->loadXML ($xml) ) {
   // if ( $xml ) {

        /*
        $campos_uteis = array('cod_imb','tipo','pret','finalidade','endereco','cidade','uf','cep','bairro', );
        $campo_util = array();
        foreach ( $campos_uteis as $k ) {
            $campo_util[$k] = 1;
        }
        */
         $integra = $doc->childNodes->item(0);
        $limit = ($limit==1)?(20):($integra->childNodes->length);
       
        for($i=0; $i<$limit; $i++) {
            $imovel = $integra->childNodes->item($i);

            $campos_processados = array();

            $campos_imovel = $imovel->childNodes;
            for( $j = 0; $j<$campos_imovel->length; $j++ ) {
                $campo_node = $campos_imovel->item($j);

                $campo_nome = $campo_node->nodeName;

                // converte os nomes dos campos xml da Next para o padrão do sistema
                //if ( $campo_node->nodeName == 'pkimovel' ) $campo_nome = 'id';
                if ( $campo_node->nodeName == 'inf_referencia' ) $campo_nome = 'cod_jb';
                elseif ( $campo_node->nodeName == 'inf_tipo' ) $campo_nome = 'tipo';
                elseif ( $campo_node->nodeName == 'inf_subtipo' ) $campo_nome = 'finalidade';
                elseif ( $campo_node->nodeName == 'inf_venda' ) $campo_nome = 'venda';
                elseif ( $campo_node->nodeName == 'inf_locacao' ) $campo_nome = 'locacao';
                elseif ( $campo_node->nodeName == 'inf_valvenda' ) $campo_nome = 'valvenda';
                elseif ( $campo_node->nodeName == 'inf_vallocacao' ) $campo_nome = 'vallocacao';
                elseif ( $campo_node->nodeName == 'inf_cidade' ) $campo_nome = 'cidade';
                elseif ( $campo_node->nodeName == 'inf_uf' ) $campo_nome = 'uf';
                elseif ( $campo_node->nodeName == 'inf_bairro' ) $campo_nome = 'bairro';
                elseif ( $campo_node->nodeName == 'det_sala' ) $campo_nome = 'sala';
                elseif ( $campo_node->nodeName == 'det_dormitorios' ) $campo_nome = 'dorm';
                elseif ( $campo_node->nodeName == 'det_Suite' ) $campo_nome = 'suite';
                elseif ( $campo_node->nodeName == 'det_banheiros' ) $campo_nome = 'banheiro';
                elseif ( $campo_node->nodeName == 'det_garagens' ) $campo_nome = 'garagem';
                elseif ( $campo_node->nodeName == 'inf_CondoNome' ) $campo_nome = 'nome_cond';
                elseif ( $campo_node->nodeName == 'Cap_ValCondominio' ) $campo_nome = 'valor_cond';
                elseif ( $campo_node->nodeName == 'det_AreaTerreno' ) $campo_nome = 'area_terreno';
                elseif ( $campo_node->nodeName == 'det_AreaComum' ) $campo_nome = 'area_comum';
                elseif ( $campo_node->nodeName == 'det_AreaTotal' ) $campo_nome = 'area_total';
                elseif ( $campo_node->nodeName == 'det_AreaConst' ) $campo_nome = 'area_construida';
                elseif ( $campo_node->nodeName == 'det_AreaUtil' ) $campo_nome = 'area_util';
                elseif ( $campo_node->nodeName == 'int_anunciointernet' ) $campo_nome = 'descricao';
				elseif ( $campo_node->nodeName == 'inf_valsobconsulta' ) $campo_nome = 'consulta';
                elseif ( $campo_node->nodeName == 'int_pubdestaque' ) $campo_nome = 'destaque';
				elseif ( $campo_node->nodeName == 'inf_situacao' ) $campo_nome = 'situacao';
				elseif ( $campo_node->nodeName == 'loc_latitude' ) $campo_nome = 'latitude';
                elseif ( $campo_node->nodeName == 'loc_longitude' ) $campo_nome = 'longitude';
                elseif ( $campo_node->nodeName == 'inf_cep' ) $campo_nome = 'cep';


                //$campo_nome = $campo_node->nodeName;
                $campo_valor = trim($campo_node->nodeValue);
								
				//$campo_valor = preg_replace('/^$\b/', "", $campo_valor);
                //$campo_valor = preg_replace('/--([^;]+);/', "&\\1;", $campo_valor);
                //$campo_valor = html_entity_decode($campo_valor,ENT_QUOTES,'UTF-8');
				
				//$campo_valor = utf8_decode($campo_valor);
                 // ignora campos inuteis
                 //if ( ! array_key_exists($campo_nome, $campo_util) ) continue;

                // processamento  dos campos
               if ( $campo_nome == 'descricao' ) {					
                   // $campo_valor = str_replace('chr13',"\r\n", $campo_valor);
                   // $campo_valor = htmlentities($campo_valor,ENT_NOQUOTES,'UTF-8');

                   // muda de "AMPLA SALA. WC SOCIAL." para "Ampla sala. Wc social."
                   // $campo_valor = preg_replace('/([A-Z])([^.]+)\.{0,1}/e', "'\\1'.strtolower('\\2').'.'", $campo_valor);
                   // $campo_valor = html_entity_decode($campo_valor,ENT_QUOTES,'UTF-8');
					$campo_valor = utf8_decode($campo_valor);	

                } else if ( $campo_nome == 'bairro' ) {
                    $campo_valor = ucwords(mb_strtolower( utf8_decode($campo_valor),"windows-1252"));
					
                }else if ( $campo_nome == 'tipo' ) {
                   $campo_valor = htmlentities( utf8_decode($campo_valor),ENT_NOQUOTES,'UTF-8');
                  // $campo_valor = ucwords(strtolower($campo_valor));
                   $campo_valor = html_entity_decode($campo_valor,ENT_QUOTES,'UTF-8');					
                }
				else
				{	$campo_valor = utf8_decode($campo_valor);}
				
                //$campos_processados[ $campo_nome ] = preg_replace("/[Ç-ç]/i","ç",utf8_decode($campo_valor));
                $campos_processados[ $campo_nome ] =  $campo_valor;
            }   // campos	
			 $campos_processados["alterado"] = date("Y-m-d H:i:s");
            $lista_imoveis[] = $campos_processados;

        } // imoveis
    }
	else
		echo "problema ao carregar o objeto";

    return $lista_imoveis;
}

?>
