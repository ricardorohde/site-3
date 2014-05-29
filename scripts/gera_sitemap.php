<?php
    $url_base = "http://homehunters.com.br";

  $conexao = mysql_pconnect("localhost","root","") or die($msg[0]);
  mysql_select_db("imobiliaria",$conexao) or die($msg[1]);



  //
  //  ---> obtem os possiveis componentes para as URLs
  //
  $finalidades = array("");
  $query = "SELECT * FROM finalidades";
  $resultado = mysql_query($query,$conexao);
  while ($linha = mysql_fetch_array($resultado)) {
    $finalidades[] = "+" . $linha['slug'];
  }

  $tipos = array('imoveis');
  $query = "SELECT * FROM tipos";
  $resultado = mysql_query($query,$conexao);
  while ($linha = mysql_fetch_array($resultado)) {
    $tipos[] = $linha['slug'];
  }


  $faixas_valor = array("");
  $query = "SELECT * FROM faixas_valor";
  $resultado = mysql_query($query,$conexao);
  while ($linha = mysql_fetch_array($resultado)) {
    $faixas_valor[] = "_" . $linha['slug'];
  }



  $dormitorios = array("");
  $query = "SELECT * FROM dormitorios";
  $resultado = mysql_query($query,$conexao);
  while ($linha = mysql_fetch_array($resultado)) {
    $dormitorios[] = "_" . $linha['slug'];
  }


  $cidades = array("");
  $query = "SELECT * FROM cidades";
  $resultado = mysql_query($query,$conexao);
  while ($linha = mysql_fetch_array($resultado)) {
    $cidades[] = "_em_" . $linha['slug'];
  }



    $paginas = array();

    //
    //  ----> padrao 1:   homehunters.com.br/pretencao
    //
    $pretencoes = array('venda', 'locacao');
    foreach ( $pretencoes as $o ) {
        $url = sprintf('%s/%s', $url_base, $o);
        $paginas[] = array('url' => $url );
    }



    //
    // ----> padrao 2: http://localhost/imoveis/imoveis+residencial_a-venda.html
    //
    $pretencoes = array('_a-venda', '_para-alugar');
    foreach ( $faixas_valor as $faixa_valor ) {
      foreach ( $tipos as $tipo ) {
        foreach ( $finalidades as $fin ) {
          foreach ( $pretencoes as $pret ) {
              foreach ( $dormitorios as $dormitorio ) {
                $url = implode('', array($url_base, '/index.php/', $tipo, $fin, $pret, $faixa_valor, $dormitorio) ) . ".html";
                $paginas[] = array('url' => $url );
              }
          }
        }
      }
    }







    foreach ( $paginas as $p ) {
        $url = $p['url'];

        print $url . "\r\n";
    }





// print_r($paginas);


//exit;













  $query = "SELECT * FROM bairros";
  $resultado = mysql_query($query,$conexao);
  while ($linha = mysql_fetch_array($resultado)) {
    $uf = $linha['uf'];
    $cidade = $linha['cidade'];
    $bairro = $linha['bairro'];
  }





?>