<?php defined('SYSPATH') OR die('No direct access allowed.');

class Imoveis_Controller extends Template_Controller{

	// Seleciona venda ou locacao
	public $pret = NULL;	   
	function __construct(){
	
		parent::__construct();		
		$this->session = Session::instance();							
		
	}	
	
    public function index()
	{
		$this->template->title = 'Imobiliária Campinas, Venda e Locação de Imóveis';
		$this->template->layout = new View('home');

        // carrega painel de busca
		
		/*
		$this->template->layout->pesquisa = new View('painel_pesquisa');
		
		$this->template->layout->pesquisa->form_comprar = new View('form_pesquisa');
		$this->template->layout->pesquisa->form_comprar->tipos =  ORM::factory('tipo')->find_all()->select_list('slug','tipo');
		$this->template->layout->pesquisa->form_comprar->pret = 'venda';
		$this->template->layout->pesquisa->form_comprar->finalidades = ORM::factory('finalidade')->find_all()->select_list('slug','finalidade');          
		
		$cidades = ORM::factory('cidade')->orderby('cidade')->find_all();			
		$array_cidades = array();
		foreach($cidades as $c)
		{
			$cidade = new Cidade_Model($c->id);
			if($c->total_index("venda") > 0)
				$array_cidades[$c->slug] = $c->cidade;
		}
		$this->template->layout->pesquisa->form_comprar->cidades = $array_cidades;
		
		$faixas_valor_venda = ORM::factory('faixas_valor_venda')->orderby('ord');
		$this->template->layout->pesquisa->form_comprar->faixas_valor = $faixas_valor_venda->find_all()->select_list( 'slug' , 'titulo' );
		

		$this->template->layout->pesquisa->form_alugar = new View('form_pesquisa');
		$this->template->layout->pesquisa->form_alugar->tipos =  ORM::factory('tipo')->find_all()->select_list('slug','tipo');
		$this->template->layout->pesquisa->form_alugar->pret = 'locacao';
		$this->template->layout->pesquisa->form_alugar->finalidades = ORM::factory('finalidade')->find_all()->select_list('slug','finalidade');
							
		$array_cidades = array();
		foreach($cidades as $c)
		{
			$cidade = new Cidade_Model($c->id);
			if($cidade->total_index("locacao") > 0)
				$array_cidades[$c->slug] = $c->cidade;
		}
		$this->template->layout->pesquisa->form_alugar->cidades = $array_cidades;
		
		$faixas_valor_locacao = ORM::factory('faixas_valor_locacao')->orderby('ord');          
		$this->template->layout->pesquisa->form_alugar->faixas_valor = $faixas_valor_locacao->find_all()->select_list( 'slug' , 'titulo' );
		*/
        // seleciona imoveis
        /* */
		
		
		//contagem de arquivos no diretório de imagens de lançamento
		$dir = 'banner_home/';
		$i = 0; 		
		if ($handle = opendir($dir)) {
			while (($file = readdir($handle)) !== false){
				if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
					$i++;
			}
		}
		// prints out how many were in the directory
				
		$this->template->layout->lancamentos = $i;	
		$this->template->layout->dir = $dir;	
				
        $filtros = array( 'pret'=> 'venda','destaque'=>1 );
		$busca = busca::busca($filtros, 'recentes', 1, 20);   
        $this->template->layout->destaques =  $busca;		
	
	}
	
	//=============================forms
	public function seja_vip() 
	{
		$this->auto_render = FALSE;		
		$view = new View('contato/seja_vip_form');
		$view->im = (isset($_GET['im']))?($_GET['im'] ):("Nenhum escolhido");
		print $view;
	}
	
	public function vender_imovel() 
	{
		$this->auto_render = FALSE;		
		print new View('contato/vender_imovel_form');
	}
    //=======================================

	public function carrega_bairros() 
	{		
		header('Content-type: application/json');
		if(request::is_ajax() or $_POST['cidade'] !=null){				
			$this->auto_render=false;		
			$objs = ORM::factory('bairro')->where('slug_cidade', $_POST['cidade'])->orderby('bairro')->find_all(); // pega os bairros da cidade

			$bairros = array();
			foreach ( $objs as $o ) { //monta lista com os bairros
				$bairros[] = array("id" => $o->id , "slug" => $o->slug, "nome"=>$o->bairro);
			}			
			
			if(request::is_ajax() ) 
				print json_encode($bairros);
	
			else
				return $bairros;
		}
			
	}
	
	public function analisa_busca()
	{				
		$this->auto_render = FALSE;
		$_SESSION['usuario'] = 1;		
		$pret = $_POST['pret'];
		$_GET['pagina'] = $_POST['pag'];		
		$_GET['ord'] = $_POST['ord'];		
		$_GET['search'] = $this->input->post('search','nada');		
		$filtros = tools::gera_fitro_da_url_amigavel($_POST['filtros']); //gera o filro a partir da url atual para saber oq está selecionado;		
		$url = "";
		$parametro = null;
			
		$dado = ($_POST["dado"]=="nao-entrar")?(false):(true);
		
		//daqui pra baixo o valor novo é tratado, em alguns casos é feita uma pesquisa. Só no final é que vamos gerar uma url nova, junto com o novo valor
		if($dado)
		{
			$dado = explode("_",$_POST["dado"]);
			$nome = $dado[0];
			$valor = $dado[1];			
						
			//reset de filtros
			
			if($nome == "cidade") //se outra cidade for selecionada, vamos zerar os bairros da url
				$filtros["bairro"] = null;
				
			if($nome == "pret") //se a pret for selecinada vamos zerar as faixas de valor						
				$filtros["faixa_valor"] = null;			
	
		//================== faixa valor
			$faixa_valor = "";
			if( $nome == "faixa-valor" )
			{
				$nome = "faixa_valor";
				$a = explode("/",$valor);		
				$min = $a[0];		
				$max = $a[1];
				
				if($min != "qualquer-valor" || $max != "qualquer-valor") //faixa toda	
				{
					$faixa_valor = "";
					$where = "preco = ".$min;			
					if($min == "qualquer-valor")
						$where = "preco = 0";			
							
					$sql = "SELECT slug as slug FROM faixas_valor_".$pret." where $where";
					$db=new Database;
					$result = $db->query($sql);	
							
					foreach ( $result as $kr ) 			
						$faixa_valor = $kr->slug; 
						
					$faixa_valor .= "-a-";
					
					$where = "preco = ".$max;			
					if($max == "qualquer-valor")
						$where = "preco = 0";	
					
					$sql = "SELECT slug as slug FROM faixas_valor_".$pret." where $where";
					$db=new Database;
					$result = $db->query($sql);	
							
					foreach ( $result as $kr ) 			
						$faixa_valor .= $kr->slug; 
				}
				$valor = $faixa_valor;
			}	
			
			//================== areas
			$area = "";
			if( $nome == "area-construida" ||  $nome == "area-total")
			{						
				$a = explode("/",$valor);		
				$min = ($a[0]==0)?("qualquer-tamanho"):($a[0]."m2");		
				$max = ($a[1]==0)?("qualquer-tamanho"):($a[1]."m2");	
				if($min != "qualquer-tamanho" || $max != "qualquer-tamanho")				
					$area = $min."-ate-".$max;
			
				$nome = str_replace("-", "_", $nome);	
				$valor = $area;
			}
			
			$parametro = $nome."=".$valor;
		}
	    
		//========================
		
		foreach(array_keys($filtros) as $k) //montar a url despedaçada
		{
			$url.= $k."=";
			if( is_array($filtros[$k]) ) //se tiver mais de um item na posiçao
			{
				$count = 0;
				foreach($filtros[$k] as $v)
				{
					if(++$count>1)
						$url .= ",";
					$url .= $v;					
				}
			}
			else
				$url .= $filtros[$k];	
			$url.="&";
		}					
				
		$url = tools::trata_url_imovel($url,$parametro,false); //nova url da pesquisa, com o filtro novo
		$_POST['nova_url'] = $url;
		$filtros = tools::gera_fitro_da_url_amigavel($url); //refaz o filtro, agora da nova url	
				
		$objs = busca::busca($filtros,$_POST['ord'],$_POST['pag'],10,"lista_imoveis",null,true,true,$_GET['search']); //busca
		$titulo = busca::gera_title($filtros);		
		$maior_id = busca::busca($filtros,"recentes",1,10,"alerta_ultimos");
				
		//print_r($objs);exit;
		$url = "index.php/".$url.".html?"; //arrumar isso!!
		if($_POST['pag'] > 1)
			$url.="pagina=".$_POST['pag']."&";
		
		if($_GET['search'] != "nada")
			$url.="search=".$_GET['search']."&";

		$url.="ord=".$_POST['ord'];
				
		$dados = array( "url"=> $url, "objs"=>$objs["resultados"] , "paginador"=>$objs["paginador"], "total"=>$objs["total_itens"], "ordenacao" => $objs["ordenacao"], "ord_atual" => $_POST['ord'], "titulo" => $titulo,"maior_id"=>$maior_id );
		$dados = json_encode($dados);				
		print($dados);			
		
	}

	public function zera_filtros() //hardcoded, mas tá simples e rápido
	{				
		$url = "imoveis_para-alugar";		
		if($_GET['pret'] == "venda")
			$url = "imoveis_a-venda";		
		
		url::redirect ( $url.".html" );	
	}
	
	public function lista( $pag = 1 ,$q = null )
    {            
		if(Auth::instance()->logged_in()) // se o usuario estiver logado pega a lista de imoveis que ele segue
			$this->session->set("imoveis_usuario",Auth::instance()->get_user()->imoveis->select_list("pkimovel","cod_jb"));	
	//print_r($_SESSION);
		$this->template->robots = 'noindex,follow' ;	 
		$this->template->canonical = $q.'.html';
		$filtros = tools::gera_fitro_da_url_amigavel( $q ); //gerar um filtro com a url atual
		  
		$this->pret = $filtros['pret'];
		$tipo = array_key_exists('tipo', $filtros) ? $filtros['tipo'] : null;
		$finalidade = array_key_exists('finalidade', $filtros) ? $filtros['finalidade'] : null;	

		 // monta lista de imoveis
		$this->template->header->pret = $filtros['pret'];
		$this->template->layout = new View('layout_lista');	       
		$this->template->layout->pesquisa_cod = new View('pesquisa_cod_jb');
		$this->template->layout->pesquisa_cod->pret = $filtros['pret'];
		$this->template->layout->filtros = new View('coluna_lateral'); //filtros laterais		
		$this->template->layout->filtros->filtros = $filtros;
		$this->template->layout->filtros->campos = busca::painel($filtros);
		 
		// gera title
		$titulo = busca::gera_title( $filtros );		
		// $this->template->h1 = $titulo;

		$this->template->body_id = "listaImoveis";
		if( $pag >1 ) $titulo .= ', página '.$pag;
		$this->template->title = $titulo;
		//$this->template->layout->lista->h1 = $titulo;

    }


    public function busca()
    {		
		//print_r($_POST);exit;
        $cod_jb = preg_replace('/\s+/', '_', $this->input->post('cod_jb',"nada") );
		$venda	= ($this->input->post('pret_busca') == "venda")?1:0;
		$locacao = ($this->input->post('pret_busca') == "locacao")?1:0;
		$cidade =  ($this->input->post('cidade') != "" )?($this->input->post('cidade')):(null);
		$pret = $this->input->post('pret_busca');
		$q_search = false;

		$pag_imoveis = preg_match("/venda.html|alugar.html/",$_SERVER['HTTP_REFERER']);
		
    	$url_final = "";
    	if($pag_imoveis == 1) //se veio da página de busca
    	{
    		$url = parse_url($_SERVER['HTTP_REFERER']);
    		$url = explode("/",$url["path"]);            		
    		$url_final = $url[count($url)-1];
    	}
		else
			$url_final = "/imoveis_a-venda.html";

        if($cod_jb){

            $row = ORM::factory('imovel')->where('cod_jb',$cod_jb)->find();
			
            if( $row->loaded ){	//
			
				if($pret=="venda" AND $row->venda==0) //se estamos procurando por venda, mas ele nao esta a venda, manda pra locacao
					url::redirect($row->gera_url("locacao"));
				else
					if($pret=="locacao" AND $row->locacao==0) //idem
						url::redirect($row->gera_url());
				                
                url::redirect ($row->gera_url($pret));
			}
            else // se não achou nada    
            	//vamos ver se ele veio da página de busca de imóveis ou de outra
				url::redirect ( $url_final."".( ( in_array($cod_jb, array("nada","",null,"+") ) )?(""):("?search=".$cod_jb) ) );           
		
		}
        else //daqui pra baxio era aquele form cheio de campos de filtragem			
			url::redirect ( $url_final);           

     }

    public function detalhes( $slug, $cod_jb )
    {				
		//print_r($_SESSION);exit;		
		//print_r($_SERVER);exit;
		
		//vamos checar se o usuario veio de uma busca ou de uma url.
		// se veio de uma busca salvaremos a busca.
		
		
		$this->template->layout = new View('imovel_detalhes');
		$this->template->layout->mostra_semelhantes = false;
		$pret = uri::segment(1);
		
		if(isset($_SESSION['usuario']))
		{		
			if(!isset($_SESSION["session_busca_url"])) //caso a session ainda nao tenha sido inicializada, pode ser a 1a vez que ele foi para a pagina detalhe, ou veoi de outro lugar
			$_SESSION["session_busca_url"] = 0; //vamos iniciá-la			
				//ele pode ter vindo do site					
				//ou de outro lugar, nesse caso a session fica como zero, e nao é mostrado o botao de voltar para a pesquisa		
					
			if(isset($_GET['busca']))
				$_SESSION["session_busca_url"] = (isset($_SERVER['HTTP_REFERER']))?($_SERVER['HTTP_REFERER']):($_SESSION["session_busca_url"]);							
			$busca_url = $_SESSION["session_busca_url"];			
		}
		else
			$busca_url = 0;
		//echo $busca_url;exit;
		
		$url_amigavel = parse_url($busca_url);
		$url_amigavel = substr( end(explode("/",$url_amigavel["path"])),0, -5 );
		
		if($busca_url!==0) //se entrou é pq o usuario veio de uma busca
		{	
			$this->template->layout->mostra_semelhantes = true;			
			$_SESSION['session_busca_url'] = $busca_url;
			$this->template->layout->busca_url = '<a href="'.$busca_url.'">Voltar aos resultados</a>';
				
			parse_str(parse_url($busca_url, PHP_URL_QUERY), $params); //pegar os params da URL
			
			if(!isset($params["pagina"]))
				$params["pagina"] = 1;		
	
			$filtros = tools::gera_fitro_da_url_amigavel($url_amigavel);	
			
			$objs = busca::busca($filtros,$params["ord"],$params["pagina"],10,'posicao_query'); //pega um array como todos os imoveis (10 em 10)
			$cod_jb = strtoupper($cod_jb);
			$pos = array_search($cod_jb,$objs); //vamos saber em qual posição está o imovel atual
			
			$index = 0;	
			
			if($pos==0)
				$index = (count($objs))-1;
			else
				$index = ($pos-1);
			
			$imovel_prev = ORM::factory('imovel')->where('cod_jb', $objs[$index] )->find();
			
			if(!isset($objs[$pos+1]))
				$index = 0;	
			else
				$index = ($pos+1);
				
			$imovel_next = ORM::factory('imovel')->where('cod_jb', $objs[$index] )->find();	
			
			$this->template->layout->imovel_prev_url = $imovel_prev->gera_url($pret);
			$this->template->layout->imovel_next_url = $imovel_next->gera_url($pret);
		}
				
		//vamos salvar nos cookies as buscas recentes (a busca anets de ele clicar no imovel) e cada imovel que ele visitou recentemente			
		//os cookies ficarão dentro de uma mesma variavel, separados por /
		
		
	
		$path_info = explode("/",$_SERVER['PATH_INFO']);
		
		$cod_jb = end($path_info); //pega o codigo do imovel
		//$pret = $path_info[count($path_info)-4]; //pega o pret
		
		$sql_codjb = "SELECT pkimovel as pkimovel from imoveis where cod_jb = '".$cod_jb."'";
		$db=new Database;
		$result = $db->query($sql_codjb);
		$codigo_imovel = $result[0];
		
		//cookie da busca recente
		$cookie = "buscas_recentes";
		$valores = cookie::get($cookie,"");
		$valores_explode = explode( "/",$valores);
		$achou = false;
		if(count($valores_explode)>0) //se tiver algum
			foreach($valores_explode as $a) //para cada um 
				if($a == $url_amigavel) //se existe
					$achou = true; //por que achou
		
		if(!$achou) //caso nao tenha achado
			$valores .= $url_amigavel."/";				
		cookie::set($cookie,$valores); //salva o cookie
		//=================cookie do imovel recente			
		
		$cookie = "imoveis_recentes";
		$valores = cookie::get($cookie,"");
		$valores_explode = explode("/",$valores);
		$achou = false;
		if(count($valores_explode)>0) //se tiver algum
			foreach($valores_explode as $a) //para cada um 
				if($a == ($codigo_imovel->pkimovel."_".$pret)) //se existe
					$achou = true; //por que achou
		
		if(!$achou) //caso nao tenha achado
			$valores .= $codigo_imovel->pkimovel."_".$pret."/";				
		cookie::set($cookie,$valores); //salva o cookie
		
		//===============================================================			
					
		//$pret = explode("/",url::current());
		$seguindo = false;
		if(Auth::instance()->logged_in())
		{
			$user = Auth::instance()->get_user();
			$sql_pret = "SELECT pret as pret from imoveis_users where imovel_pkimovel = ".$codigo_imovel->pkimovel." and user_id =".$user->id;
			$db=new Database;
			$result = $db->query($sql_pret);	
			if(count($result) >0 )
			{
				$pret_imovel = $result[0];
				$seguindo = ($pret_imovel->pret == $pret);
			}
		}					
				
		$this->template->layout->imovel_seguindo = $seguindo;
				
        //print_r($_SESSION);	
		
        $obj = ORM::factory('imovel')->where('cod_jb', $cod_jb);
        if( $this->pret == "locacao" ) 
			$obj->where('locacao' , 1);
		else
			$obj->where('venda' , 1);
        $row = $obj->find();

        // prepara title
        if($this->pret == 'venda'):
    		$pretencao = 'a venda ';
    	elseif($this->pret == 'locacao'):
    		$pretencao = 'para alugar ';
    	else:
    		$pretencao = '';
    	endif;
		
        $this->template->title = $row->tipo.' '.strtolower($row->finalidade).' '.$pretencao.' no bairro '.$row->bairro.', '.$row->cidade.' - '.$row->uf.' - '.$row->cod_jb;
        $this->template->layout->h1 = $row->tipo.' '. $pretencao.' , '.$row->bairro;
        $this->template->layout->row = $row;
        $this->template->layout->pret = $pret;
		$this->template->layout->logado = ((Auth::instance()->logged_in())?(1):(0));

        //===================== seleciona imoveis semelhantes		
				
		$this->template->layout->semelhantes = $this->imoveis_semelhantes($obj);
		
        //$filtros = array(  'finalidade' => $row->finalidade, 'cidade' => $row->cidade, 'pret' => $this->pret );
         //=  busca::busca( $filtros, 'aleatorio', 2, 10 );
    }

	
	function imoveis_semelhantes($obj)
	{	
		$url = explode("/",url::current());
		$filtros = explode("_",$url[2]);		
		$pret = $url[0];
		$ord = "valor"; //ordenacao a partir dos mais baratos
		
		$valor = ($pret=="venda")?$obj->valvenda:$obj->vallocacao;
		$str_count = strlen((string)$valor); // ve qa9ntos numeros tem no valor do imovel
		$faixa_valor = round($valor,-($str_count-1));
			
		
		$sql = "SELECT ord FROM faixas_valor_".$pret." where preco <= '".$faixa_valor."' order by ord desc";
		$db=new Database;
		$result = $db->query($sql);		
		$result = $result[0];
		$faixa_valor = $result->ord; 		
		
		$faixa_valor_min = 0;		
		$limite_max = ($pret=="locacao")?(21):(12);
		$faixa_valor_max = ($faixa_valor==$limite_max)?(0):($faixa_valor); //se for o limite, joga para todos.
		//vamos pegar uma faixa de valor acima e abaixo
		//echo $faixa_valor_max;exit;	
		if($faixa_valor != 0 && $faixa_valor!=$limite_max)
		{
			$faixa_valor_min = $faixa_valor-1;
			$faixa_valor_max = $faixa_valor+1;
		}	
		else
			$ord = "valor-desc"; // se estiverem no limite a ordenaçao inverte, mostrando primeiro os mais caros
						
		$sql = "SELECT slug FROM faixas_valor_".$pret." where ord = '".$faixa_valor_min."'";
		$db=new Database;
		$result = $db->query($sql);
		foreach ( $result as $kr ) 			
				$faixa_valor_min = $kr->slug; 	
				
		$sql = "SELECT slug FROM faixas_valor_".$pret." where ord = '".$faixa_valor_max."'";
		$db=new Database;
		$result = $db->query($sql);
		foreach ( $result as $kr ) 			
				$faixa_valor_max = $kr->slug; 
		
		
		$filtros = array(
			"id_imovel" => $obj->pkimovel,
			"faixa_valor"=> $faixa_valor_min."-a-".$faixa_valor_max,	
			"cidade" => $filtros[3],												
			"pret" => $pret,
			"finalidade" => $filtros[1],			
			"tipo" => array(0=>$filtros[0]),
			"condominio" => (isset($filtros[4]) && $filtros[4]=="em-condominio")?$filtros[4]:false,
			"bairro" => array(0=>$filtros[2])
		);				
		//print_r($filtros);exit;
		return busca::busca( $filtros,$ord, 2, 10 ,"relacionados");
		
		//$filtros = ;		
	}


    function bairros_cidade( $cidade = null ) {
        $objs = ORM::factory('bairro')->where('slug_cidade', $cidade)->orderby('bairro')->find_all();

        $bairros = array();
        foreach ( $objs as $o ) {
            $bairros[ $o->slug ] = utf8_encode($o->bairro);
        }
        print json_encode($bairros);
        exit;
    }   
} // End Welcome Controller