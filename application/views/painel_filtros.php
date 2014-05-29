<script type="text/javascript" src="<?=url::base();?>js/oneup.js"> </script>  
<script>

var logado = <?php echo (Auth::instance()->logged_in())?1:0; ?>;

function load_bairros(a)
{		
	valor = "cidade_"+a.value;
	pesquisa(valor);
	
	c = a.value;
	$.ajax({
	  type:'POST',
	  url: "<?php echo url::base(true); ?>imoveis/carrega_bairros",
	  data: ({cidade:c}),	
	  dataType:"json",	
	  beforeSend: function(){			  
		$('#aviso').removeClass("txt_hidden");
		$('#aviso').addClass("txt_show");
		},						  
	  success: function(ret)
	  {			
		if(ret)
		{   			
			$('#aviso').removeClass("txt_show");
			$('#aviso').addClass("txt_hidden");
			//$("#li_bairro >:not(a)").remove();
			
			document.getElementById("li_bairro").innerHTML = "";
			$("a.filtro_ativo").remove();
						
			 for (var i = 0; i < ret.length; i++) {
							
				var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.class = "check_options";
				checkbox.name = "check_bairro-"+ret[i]["slug"];
				checkbox.value = "bairro_"+ret[i]["slug"];
				checkbox.id = "label_"+ret[i]["id"];

				var label = document.createElement('label');
				label.htmlFor = "check_bairro-"+ret[i]["slug"];
				label.appendChild(document.createTextNode( ret[i]["nome"]));

				var li = document.createElement('li');
				li.appendChild(checkbox);
				li.appendChild(label);				
				document.getElementById("li_bairro").appendChild(li);
			 }
			 
			 $('#menu1 :checkbox').click(function(){  	
				pesquisa($(this).val());	
			  });
		}
		else
		 alert("Ocorreu algum erro, tente novamente.");
	  }
	});			
}

function pega_url()
{
	var path = window.location.pathname.split("/")[4]; //index da url com os filtros
	path = (path.substring(0,(path.length-5)));
	return path;
}

function pesquisa(a,pagina,ordem,search)
{	
	if(typeof ordem == 'undefined')
		ordem = "valor";	
	if(typeof search == 'undefined')
			search = "nada";	
	
	if(typeof pagina == 'undefined')
		pagina = 1;
	
	pret = $("input[name='pret']").val(); //pega o pret

	path = pega_url(); //pega a url nova
	
	$(".radio_pret").attr("href",window.location+"#"); //atualizar o link dos botoes VENDA e LOCACAO
	$('.radio_pret').unbind();
	$(".radio_pret").click(function(){
		var pret = "pret_"+$(this).attr("name");
		$("input[name='pret']").val($(this).attr("name"));
		$(".radio_pret").removeClass("ativo");
		$("#btn_"+$(this).attr("name")).addClass("ativo");
		//$(this).toggleClass("active");		
		pesquisa(pret);
		var max = (pret=="pret_venda")?(13):(22);	
		start_slider_valores(0,max,max);	//reinicia o slider	
	});
	
	$.ajax({
	  type:'POST',
	  url: "<?php echo url::base(true); ?>imoveis/analisa_busca",
	  data: ({dado:a,pret:pret,filtros:path,ord:ordem,pag:pagina,search:search}),	
	  dataType:"json",	
	  beforeSend: function(){	
		$("#bloglist").fadeOut("fast");
		var h = $(document).height(); 
		$('#loading').css("height",h);
		$('#loading').addClass("show");
		
		//$(".paginador").empty();
		//$("#ordenacao").empty();
		$(".previous2").empty();
		$(".next2").empty();
		
		},						  
	  success: function(ret) {	
	  
		if(ret)
		{  
			$('#loading').removeClass("show");			
			var imoveis = ret['objs'];			
			var paginador = ret['paginador'];
						
			$('div.heading h2 span').html(ret["total"]); //atualiza o total
			history.pushState( null, "Title", ret["url"] );
			$(document).attr('title', ret["titulo"] ); //muda o título
			$("input[name='maior_pkimovel']").val(ret["maior_id"]); //muda o maior imovel
			//window.history.pushState(null, "Title", ret["url"]); //atualiza a url
			
			$("#bloglist").empty();
			$(".topinfo p#mostrando").html("Mostrando "+paginador["current_first"]+"-"+paginador["current_last"]);
			
			$("#ordenacao").html(ret["ordenacao"]);
			
			$(".paginador").html(paginador["objeto"]);
			$(".paginador a").attr("href",window.location+"#");
			$(".paginador a").attr("id",$(this).html());
			
			if(paginador["previous_page"]!==false) //mostrar só se possuir pagina anterior/próxima
				$(".previous2").html("<a href='"+window.location+"#' onclick=pesquisa('nao-entrar',"+paginador["previous_page"]+",'"+ret["ord_atual"]+"','"+search+"')></a>");	
				
			if(paginador["next_page"]!==false)
			$(".next2").html("<a href='"+window.location+"#' onclick=pesquisa('nao-entrar',"+paginador["next_page"]+",'"+ret["ord_atual"]+"','"+search+"')></a>");	
			
			$('.paginador a').unbind();
			$(".paginador a").click(function(){
				pesquisa("nao-entrar",$(this).html(),ret["ord_atual"]);				
			});			
			
			//alert(previous+"-"+next);					
			
			var str = "";
			
			if(imoveis.length > 0)
			{			
				for (var i = 0; i < imoveis.length; i++) { //for dos imoveis
					var article = document.createElement('article');
						detalhes = "";		
					if(imoveis[i]['tipo'].match("APARTAMENTO|CASA|PREDIO")) 
						detalhes = "<p><span>Dormitórios:</span> "+imoveis[i]['dorm']+" </p> <p> <span>Banheiros:</span> "+imoveis[i]['banheiro']+" </p> ";
						
					if(imoveis[i]['tipo'].match("APARTAMENTO|SALA|LOJA|PREDIO")) 
						detalhes += "<p> <span>Área útil:</span> "+imoveis[i]['area_util']+"<span class='metros'>m2</span></p>";
					else
						detalhes += "<p> <span>Área Construída:</span> "+imoveis[i]['area_construida']+"<span class='metros'>m2</span></p> <p> <span>Terreno:</span> "+imoveis[i]['area_terreno']+"<span class='metros'>m2</span></p>";
								
					var texto_seguir = "Seguir imóvel";
					var class_seguir = "seguir_imovel";
					var name_seguir = imoveis[i]["pkimovel"];
					var link_seguir = "";
					if(logado == 1)	//se esta logado				
					{	if(imoveis[i]['seguindo']===1) //se esta seguindo o imovel
						{
							texto_seguir = "Seguindo";
							class_seguir = "seguir_imovel remove";
							name_seguir = imoveis[i]["pkimovel"]+"_remove";
						}
					}		
					else		
					{					
						class_seguir = "fancybox_ajax";
						link_seguir = "href='<?php echo url::base(true); ?>vip/form_cadastro?imovel="+imoveis[i]["pkimovel"]+"&pret="+pret+"&referrer="+window.location.href+"'";
					}
						
					var part1 = "<aside> <figure>"+imoveis[i]['miniatura']+" </figure> <div class='info'> <h3>"+imoveis[i]['link_tit']+"</h3> <p> <em>"+imoveis[i]['tipo']+"</em> "+detalhes+"  </div>";	
					var part2 = "<div class='priceinfo'> <h3>"+imoveis[i]["preco"]+"</h3> <p><span>Código:</span>"+imoveis[i]["cod_jb"]+" </p> <div class='buttons'> <span class='plusone' id='plusone_"+imoveis[i]["pkimovel"]+"'>+1</span> <div class='button'> <button class='"+class_seguir+"' name='"+name_seguir+"' "+link_seguir+"><span>"+texto_seguir+"</span></button> </div> <div class='button'>"+imoveis[i]["link"]+"</div> </div></div> </aside>";
					
					article.innerHTML = part1+""+part2;
					document.getElementById("bloglist").appendChild(article);
					//console.log(item);
				}				
				
				
				jQuery('button.seguir_imovel').click(function(){  	
					var cod = $(this).attr("name");	
					var pret = $("input[name='pret']").val();					
					var el = this;
					$.ajax({
					  type:'POST',
					  url: "<?php echo url::base(true); ?>vip/seguir_imovel",
					  data: ({cod:cod,pret:pret}),	
					  dataType:"json",	
					  beforeSend: function(){
						if(logado == 1)						
							$(el).children().html("Carregando");
						
					  },						  
					  success: function(ret){
						
						if(ret)
						{
							cod = cod.split("_");
							if(logado == 1)			
								$(el).toggleClass("remove");
							if(cod[1] == "remove") //se o usuario estava seguindo , agora não esta mais
							{
								$(el).attr("name",cod[0]); //muda o nome para somento o código
								$(el).children().html("Seguir imóvel");	
							}
							else
							{
								if(logado == 1)
								{
									$("#plusone_"+cod[0]).oneUp({speed:2500,distance:50});
									$(el).attr("name",cod[0]+"_remove"); //muda o nome para código_remove
									$(el).children().html("Seguindo");		
								}
							}
						}
						else alert("Ocorreu algum erro, tente novamente em alguns instantes");
					  }			
					  
					});
				});
			
				
			
			}
			else
				document.getElementById("bloglist").innerHTML = "<h3>Busca</h3> <p>Nenhum imóvel foi encontrado para essa busca.</p>";
				
			$("#bloglist").fadeIn("fast");			
		}
		else
			alert("Ocorreu algum erro.");
		
	  }
	  });
}

$(document).ready(function() {


	var search = '<?php echo $this->input->get("search","nada") ?>';

	pesquisa("nao-entrar",<?php echo ( isset($_GET['pagina']) )?($_GET['pagina']):("1"); ?>,'<?php echo ( isset($_GET['ord']) )?($_GET['ord']):("valor-desc"); ?>',search); 
    
  	$('#menu1 :checkbox').click(function(){  	//click dos checkboxes
		pesquisa($(this).val());	
	  });
	  
	jQuery('#salvar_busca').click(function(){  			
		var maior_id = $("input[name='maior_pkimovel']").val(); //muda o maior imovel
		$.ajax({
		  type:'POST',
		  url: "<?php echo url::base(true); ?>vip/salvar_busca",
		  data: ({maior_pkimovel:maior_id}),	
		  dataType:"json",
			beforeSend: function(){						
				$("#salvar_busca").html("Carregando...");			
		  },		  
		  success: function(ret){
			$("#salvar_busca").html("Salvar esta busca");	
			if(ret==1)
			{
				$(".label_busca_salva").toggleClass("hide");
				setTimeout(function() {$(".label_busca_salva").toggleClass("hide");}, 5000);
			}
			else
			{
				$(".label_busca_salva_erro").toggleClass("hide");
				setTimeout(function() {$(".label_busca_salva_erro").toggleClass("hide");}, 5000);
			}									
		  }			
		});
	});
  
   $('.dropdown_options').change(function() {  	   //change dos dropdowns
		var v = $(this).val();
		v = v.split("_");
		nome = v[0];
		valor = v[1].split("-")[1];
		
		if(valor!="0")
			$('input[name='+nome+']').val(nome+"_"+nome+"-"+valor);
		
		pesquisa($('input[name='+nome+']').val());	
  }); 
  
  //change das áreas
 
	$('.input_areas').keyup(function() {  			
		
		var n = $(this).attr("name");
		n = n.split("_");
		nome = n[0];
		tipo = n[1];
		
		var min = $("#"+nome+"_min").val();
		var max = $("#"+nome+"_max").val();
				
		if(!min)
			min = 0;
		if(!max)
			max = 0;		
		
		var area = min+"/"+max;			
		pesquisa(nome+"_"+area);  
		 
	});	
});


</script>

<?php
    		
	//filtros é o que esta ativo no momento
	//campos são as opçoes disponiveis de cada filtro (contando com os já selecionados)
	
	//====================================================================================================================	
	
	print form::open("imoveis/analisa_busca");
	echo '<ul id="menu1" class="example_menu">';
	//echo "<input type='submit' class='btn_busca' value='Busca'>";
	
	print form::hidden("pret",$filtros["pret"]);
	print form::hidden("maior_pkimovel");
		
	//================================== drop down das cidades
	
	echo "<a href='#' class='radio_pret ".(($filtros["pret"]=="locacao")?("ativo"):(""))."' id='btn_locacao' name='locacao'><span>Locação</span></a>";
	echo "<a href='#' class='radio_pret ".(($filtros["pret"]=="venda")?("ativo"):(""))."' id='btn_venda' name='venda'><span>Venda</span></a>";
	
	echo "<div class='cb'></div>";
	//================================== drop down das cidades
	echo "<li>";
	
	$cidades = $campos["cidade"];
	
	$list = array();
	$list[''] = "Todas as cidades";	
	foreach( array_keys($cidades['opcoes']) as $chave )			
		$list[$chave] = $cidades['opcoes'][$chave];			
	print form::dropdown('cidade_dropdown',$list, $filtros['cidade'] , 'onChange = "load_bairros(this)"' );	
	echo "<div id='aviso' class='txt_hidden'><p>Aguarde, carregando a lista de bairros</p></div>";
	echo "</li>";
	
	//=============================================================
	
    foreach( array_keys($campos) as $apelido ){ //para cada campo. ex: tipo, finalidade, etc
	
		$campo = $campos[$apelido];	// um item apenas ex 'tipo'
		if ( ((sizeof($campo['opcoes']) == 0) || tools::filtros_dropdown($apelido)) && $apelido != 'bairro') continue; //se nao tem nenhuma opçao já sai direto, nem mostra no menu,exceto bairro		     
		
		echo "<li id='item_".$apelido."'>";
		
		echo '<a class="title collapsed btn_accordion"> '. $campo['titulo'] . '</a>';				
		if($apelido == "tipo")
		{
			echo "<div id='condominio'>";
			print form::checkbox('condominio', 'condominio_em-condominio' , ( $filtros["condominio"] == "em-condominio" )?(true):(""), "class='check_options'" );
			print form::label('condominio', 'Em condomínio');				
			echo "</div>";					
		}
			
		//listar as opções			
			
		echo '<ul class="filtro_' . $apelido . ' "> <article><aside id="li_'.$apelido.'">';		
				
			foreach( array_keys($campo['opcoes']) as $chave ){				
				
				//verificar se o filtro já esta ativo na url, se sim poe o check=true
				$checked = false;
				if(is_array($filtros[$apelido]))
					if(array_search($chave,$filtros[$apelido]) !== false)
						$checked = true;
						
				echo "<li>";						
					print form::checkbox($apelido.'_'.$chave, $apelido.'_'.$chave , $checked, "class='check_options'");
					print form::label($apelido.'_'.$chave, utf8_encode($campo['opcoes'][$chave]));																			
				echo "</li>";
				
			}		
					
		echo '</article></aside></ul>';
		
		echo "</li>";     	 
   }   
	
	echo "<li>";
	echo '<a class="title">Valor do imóvel</a>';	
			
	$pret = $filtros["pret"];	
	$max_scale = ($pret == 'venda')?(13):(22);
	$min = ($campos["faixa_valor"]["min"] != null)?($campos["faixa_valor"]["min"]):(0);
	$max = ($campos["faixa_valor"]["max"] == null || $campos["faixa_valor"]["max"] == 0 )?($max_scale):($campos["faixa_valor"]["max"]);		
	
	?>
		<script type="text/javascript" src="<?php echo url::base();?>js/nouislider.js"></script>
		<div id='price_show'></div>
		<div id='slider-valor'></div>
		<script>	
		
			String.prototype.splice = function( idx, rem, s ) {
				return (this.slice(0,idx) + s + this.slice(idx + Math.abs(rem)));
			};
					
			$(function(){		//iniciar o slider	
				start_slider_valores(<?php echo $min; ?>,<?php echo $max; ?>,<?php echo $max_scale; ?>);				
			});	
			
			function start_slider_valores(min,max,max_scale)
			{	
				var pret = $("input[name='pret']").val();
				$("#slider-valor").noUiSlider('disable');
				$('#slider-valor').empty();
				
				atualiza_valores(min,max,pret);
				
				$('#slider-valor').noUiSlider('init', {
					step: 1,
					scale: [0,max_scale],
					start: [min,max],
					change: function()
							{	
								var value = $(this).noUiSlider( 'value' );	
								atualiza_valores(value[0],value[1],pret);							
							},
					end: function(){
					
						var v = $("#faixa_valor_id").val();	
						pesquisa("faixa-valor_"+v);
					
					}
				});		
				$("#slider-valor").noUiSlider('enable');				
			}

			
			
			function atualiza_valores(min,max,tipo)
			{				
				var min_str = "";
				var max_str = "";
				
				if(tipo == 'venda') //se for VENDA
				{
						switch(min)
						{
							case 13: 
							case 0: min_str = "qualquer valor";min="x";break;
							case 1: 
							case 2: 
							case 3: 
							case 4: 
							case 5: 
							case 6: 
							case 7: 
							case 8: 
							case 9: min_str = "R$"+min+"00.000,00"; min=min*100000; break;
							case 10: min_str = "1 milhão"; min=1000000;break;
							case 11: min_str = "1,5 milhão"; min=1500000;break;
							case 12: min_str = "3 milhões"; min=3000000;break;											
						}
						
						switch(max)
						{
							case 13: 
							case 0: max_str = "qualquer valor"; max = "x";break;
							case 1: 
							case 2: 
							case 3: 
							case 4: 
							case 5: 
							case 6: 
							case 7: 
							case 8: 
							case 9:  max_str = "R$"+max+"00.000,00";  max=max*100000;break;
							case 10: max_str = "1 milhão";max=1000000;break;
							case 11: max_str = "1,5 milhão";max=1500000;break;
							case 12: max_str = "3 milhões"; max=3000000;break;
											
						}
						
						
				
				}
				else				
				{
						switch(min)
						{
							case 0: min_str = "qualquer valor";min="x";break;
							case 1: 
							case 2: 
							case 3: 
							case 4: 
							case 5: 
							case 6: 
							case 7: 
							case 8: 
							case 9: min_str = "R$"+min+"00,00"; min = min*100; break;
							case 10: min_str = "R$1.000,00"; min = min*100; break;
							case 11: min_str = "R$1.250,00"; min= 1250; break;
							case 12: min_str = "R$1.500,00"; min = 1500;break;
							case 13: min_str = "R$2.000,00"; min = 2000;break;							
							case 14: min_str = "R$2.500,00"; min = 2500;break;							
							case 15: min_str = "R$3.000,00"; min=3000;break;							
							case 16: min_str = "R$5.000,00"; min=5000;break;							
							case 17: min_str = "R$7.500,00"; min=7500;break;							
							case 18: min_str = "R$10.000,00"; min=10000;break;							
							case 19: min_str = "R$12.500,00"; min=12500;break;							
							case 20: min_str = "R$15.000,00"; min=15000;break;							
							case 21: min_str = "R$30.000,00"; min=30000;break;							
							case 22: min_str = "qualquer valor";min="x"; break;							
						}
						
						switch(max)
						{
							case 0: max_str = "qualquer valor"; max = "x";break;
							case 1: 
							case 2: 
							case 3: 
							case 4: 
							case 5: 
							case 6: 
							case 7: 
							case 8: 
							case 9: max_str = "R$"+max+"00,00";  max = max*100; break;
							case 10: max_str = "R$1.000,00";  max = max*100; break;
							case 11: max_str = "R$1.250,00"; max = 1250; break;
							case 12: max_str = "R$1.500,00"; max= 1500;break;
							case 13: max_str = "R$2.000,00"; max=2000;break;							
							case 14: max_str = "R$2.500,00"; max=2500;break;							
							case 15: max_str = "R$3.000,00"; max=3000;break;							
							case 16: max_str = "R$5.000,00"; max=5000;break;							
							case 17: max_str = "R$7.500,00"; max=7500;break;							
							case 18: max_str = "R$10.000,00"; max=10000;break;							
							case 19: max_str = "R$12.500,00"; max=12500;break;							
							case 20: max_str = "R$15.000,00"; max=15000;break;							
							case 21: max_str = "R$30.000,00"; max=30000;break;							
							case 22: max_str = "qualquer valor";  max = "x";break;					
						}
				
				}				
			
				if(min == "x")
					min = "qualquer-valor";
				if(max == "x")
					max = "qualquer-valor";
					
				$("#faixa_valor_id").val(min+"/"+max);			
					
				$("#price_show").html("De <span>"+min_str+"</span> até <span>"+max_str+"</span>");	
				
			}
			
		</script>
		
	<?php		
	
	echo "<input type='hidden' name='faixa_valor' id='faixa_valor_id' value='' />";	
	
	echo "<div id='div_comodos'>";
	echo '<a class="title">Dormitórios, banheiros e garagens</a>';
		
	//===========================
	
	$campo = $campos["dormitorios"];	// um item apenas ex 'tipo'
	
	$list = array();
	$list["dormitorios_dormitorios-0"] = "---";
	foreach( array_keys($campo['opcoes']) as $chave )			
		$list["dormitorios_".$chave] = $campo['opcoes'][$chave];			
	print "<div class='div_drop'><span class='tit_drop'>Dorm. </span>".form::dropdown('dormitorios',$list,"dormitorios_".$filtros["dormitorios"],"class='dropdown_options'")."</div>";	
	print form::hidden('dormitorios',"dormitorios_".$filtros["dormitorios"]);
	//===============================
	
	$campo = $campos["banheiros"];	// um item apenas ex 'tipo'
	
	$list = array();
	$list["banheiros_banheiros-0"] = "---";
	foreach( array_keys($campo['opcoes']) as $chave )			
		$list["banheiros_".$chave] = $campo['opcoes'][$chave];			
	print "<div class='div_drop'><span class='tit_drop'>Banh.</span> ".form::dropdown('banheiros',$list,"banheiros_".$filtros["banheiros"],"class='dropdown_options'")."</div>";	
	print form::hidden('banheiros',"banheiros_".$filtros["banheiros"]);
	//===============================
	
	$campo = $campos["garagens"];	// um item apenas ex 'tipo'
	
	$list = array();
	$list["garagens_garagens-0"] = "---";
	foreach( array_keys($campo['opcoes']) as $chave )			
		$list["garagens_".$chave] = $campo['opcoes'][$chave];			
	print "<div class='div_drop'><span class='tit_drop'>Gar.</span> ".form::dropdown('garagens',$list,"garagens_".$filtros["garagens"],"class='dropdown_options'")."</div>";
	print form::hidden('garagens',"garagens_".$filtros["garagens"]);
	
	echo "<div class='cl'></div>";
	echo "</div>";
	
	
	//===========================
	$campo = array("qualquer-tamanho","qualquer-tamanho");
	if(isset($filtros["area_construida"]))
		$campo = explode("-ate-",$filtros["area_construida"]);
	if($campo[0]=="qualquer-tamanho")
		$campo[0] = "";
	else $campo[0] = substr($campo[0],0,-2);
		
	if($campo[1]=="qualquer-tamanho")
		$campo[1] = "";
	else $campo[1] = substr($campo[1],0,-2);

			
	print "<div class='div_areas'>";
	print '</br><a class="title">Áreas</a>';
	print "<span class='tit_drop'>m2:</span>";	
	print "<span class='tit_drop'>De</span>".form::input('area-construida_min',$campo[0],"class='input_areas'");	
	print "<span class='tit_drop'>até</span>";
	print form::input('area-construida_max',$campo[1],"class='input_areas'")."</div>";	
	
	//print form::hidden('dormitorios',"dormitorios_".$filtros["dormitorios"]);
	
	echo "<div class='cb'></div>";			
	echo "</li>";
	
	echo html::anchor("imoveis/zera_filtros?pret=".$filtros["pret"],"Limpar filtros",array("class"=>"limpar_filtros"));				
	
	//echo "<input type='submit' class='btn_busca' value='Busca'>";			
	echo '</ul>';	
	print form::close();
	
	if(Auth::instance()->logged_in()) //se o usuario estiver logado, mostrar o botao para salvar busca
		echo "<div class='button'> <button id='salvar_busca'>Salvar esta busca</button> </div>";
	echo "<span class='hide aviso_busca label_busca_salva'>Busca salva</span>";
	echo "<span class='hide aviso_busca label_busca_salva_erro'>Esta busca já existe</span>";
?>