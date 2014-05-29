<?php
	if(!Auth::instance()->logged_in()) //se nao estiver logado
			url::redirect("vip");

	$user = Auth::instance()->get_user();
	
	$sql_venda = "SELECT count(*) as qtd from imoveis_users where pret = 'venda' and user_id =".$user->id;
	$sql_locacao = "SELECT count(*) as qtd from imoveis_users where pret = 'locacao' and user_id =".$user->id;
	$sql_sugeridos = "SELECT count(*) as qtd from imovel_sugerido where user_id =".$user->id;
	$sql_buscas_sugeridas = "SELECT count(*) as qtd from busca_sugerida where user_id =".$user->id;
	$db=new Database;
	$result = $db->query($sql_venda);		
	$venda = $result[0];
	$result = $db->query($sql_locacao);
	$locacao = $result[0];
	$result = $db->query($sql_sugeridos);
	$sugeridos = $result[0];
	$result = $db->query($sql_buscas_sugeridas);
	$buscas_sugeridas = $result[0];
	
	$c_imoveis_venda = "(".$venda->qtd.")";
	$c_imoveis_alugar= "(".$locacao->qtd.")";
	$c_imoveis_sugeridos = "(".$sugeridos->qtd.")";
	$c_busca_sugerida = "(".$buscas_sugeridas->qtd.")";
	$c_buscas_salvas = "(".count($user->alertas).")"; //quantidade de buscas salvas
	$c_vis_recentes = "(".(count( explode("/",cookie::get("imoveis_recentes")) )-1).")"; //quantidade de imoveis visualizados recentemente
	$c_buscas_recentes = "(".(count( explode("/",cookie::get("buscas_recentes")) )-1).")"; //quantidade de buscas recentes
	

	$tipo = (isset($_GET['tipo_imovel']))?($_GET['tipo_imovel']):("");
	
?>

<div class='left'>
	<h1>Área VIP</h1>
	<aside id='sidebar'>		
		<div>
			<ul>
				<li> <?php echo html::anchor("vip/imoveis_seguidos?tipo_imovel=venda","Imóveis a venda ".$c_imoveis_venda,array("class"=>($tipo=="venda")?("ativo"):("")) );?> </li>
				<li> <?php echo html::anchor("vip/imoveis_seguidos?tipo_imovel=locacao","Imóveis para alugar ".$c_imoveis_alugar,array("class"=>($tipo=="locacao")?("ativo"):("")));?> </li>
				<li> <?php echo html::anchor("vip/visualizacoes_recentes","Visualizações recentes ".$c_vis_recentes,array( "class"=> (uri::segment("vip")=="visualizacoes_recentes")?("ativo"):("")) );?> </li>
				<li> <?php echo html::anchor("vip/buscas_salvas","Buscas salvas ".$c_buscas_salvas,array( "class"=> (uri::segment("vip")=="buscas_salvas")?("ativo"):("")));?> </li>
				<li> <?php echo html::anchor("vip/buscas_recentes","Buscas recentes ".$c_buscas_recentes,array( "class"=> (uri::segment("vip")=="buscas_recentes")?("ativo"):("")));?> </li>
				<li> <?php echo html::anchor("vip/imoveis_sugeridos","Imóveis Sugeridos ".$c_imoveis_sugeridos,array( "class"=> (uri::segment("vip")=="imoveis_sugeridos")?("ativo"):("")));?> </li>
				<li> <?php echo html::anchor("vip/buscas_sugeridas","Buscas Sugeridas ".$c_busca_sugerida,array( "class"=> (uri::segment("vip")=="buscas_sugeridas")?("ativo"):("")));?> </li>
			</ul>
		</div>
	</aside>

	<div id='ajuda'>
		<h2>Let us Do</h2>
		<p>Se preferir, deixe que nossos especialistas encontrem por você, basta dizer o que quer e todo o resto é por nossa conta.</p>
		<button class="green" onclick="javascript:window.open('http://webservices.blap.com.br/liguegratis.aspx?id=551925120000&cid=10005','liguegratis','width=430,height=378,top=0,left=0,scrollbars=no,status=no,toolbar=no,location=no,directories=no, menubar=no,resizable=no,fullscreen=no')"><span>Ligue grátis</span></button>
	</div>
</div>