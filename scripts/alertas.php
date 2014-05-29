<?php
	include '../geral/slugs.php';
	include '../application/helpers/tools.php';
	include '../application/helpers/busca.php';

	/*$conexao = mysql_pconnect("localhost","root","") or die($msg[0]);
	mysql_select_db("next",$conexao) or die($msg[1]);*/

	$conexao = mysql_pconnect("localhost","root","") or die($msg[0]);
	mysql_select_db("next",$conexao) or die($msg[1]);

	//$q = "INSERT INTO logs_manutencao (quando, evento) VALUES ( NOW() ,'conexão')";
	//$resultado = mysql_query($q,$conexao);
	
	$q = "SELECT * from alertas where proximo_envio = CURDATE()"; //selecionar todos os eventos que foram programados para hoje
	$resultado = mysql_query($q,$conexao);
	
	while($alerta = mysql_fetch_assoc($resultado))
	{		
		$filtros = tools_Core::gera_fitro_da_url_amigavel($alerta["alerta"]);
		$filtros['maior_pkimovel'] = $alerta["maior_pkimovel"];
		$busca = busca_Core::busca($filtros);
		print_r($busca);
	}

?> 