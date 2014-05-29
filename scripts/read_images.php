<?php
require dirname(__FILE__) . '../geral/slugs.php';

    $conexao = mysql_pconnect("localhost","root") or die($msg[0]);
    mysql_select_db("next",$conexao) or die($msg[1]);

//    $conexao = mysql_pconnect("localhost","root","awk492") or die($msg[0]);
//	mysql_select_db("nextsim",$conexao) or die($msg[1]);
		
	$q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'conexão')";
	$resultado = mysql_query($q,$conexao);

	echo 'conectou ';
	//conecta ao webservice
	$client = new SoapClient("http://www.centrina.com.br/WSConsumoPortal/Service.asmx?wsdl",array("encoding"=>"UTF-8"));
	// carrega o dados do webservice
	$imagens = $client->getFotos(array('fkempresa'=>'1390','senha'=>'NE1390'));   
	// carrega os imóveis
		
	$lista_imagens = load($imagens->getFotosResult);

 /* echo '<pre>';
  print_r( $lista_imagens );
  exit;  */
  echo 'carregou o xml ';

  $q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'load xml')";
  $resultado = mysql_query($q,$conexao);

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


function load( $arquivo ,$limit=0) {

   // $document = file_get_contents($arquivo);
    $document = $arquivo;

    $lista_imoveis = array();

    $xml = $document;
    if ($xml == '') {
      return false;
    }
	

    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->encoding = "UTF-8";
    
  
    if ( $doc->loadXML ($xml) ) {

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
                $campo_valor = trim($campo_node->nodeValue);             
				        $campo_valor = utf8_decode($campo_valor);             
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
