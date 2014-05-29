<script>

function trocapret(e)
{		

	var tipo = "";
	
	if(e=="venda") tipo = "comprar";
	else tipo = "alugar";
	
	$('dl.tabs #locacao').parent().removeClass('active');
	$('dl.tabs #venda').parent().removeClass('active');
	
	
	$('#comprarTab').removeClass('active');
	$('#alugarTab').removeClass('active');
	$('#'+tipo+'Tab').addClass('active');	
	
	var a = 'dl.tabs #'+e;
	$(a).parent().addClass("active");	
	
	var form = document.getElementById('form_pesquisa');
	form.pret.value = v;	
}

</script>


<?php
    echo form::open('imoveis/busca' , array('class'=>'custom',"id"=>"form_pesquisa"));
		echo "<fieldset>";
			echo "<aside>";

				// isso será substituído por um hidden field em cada tab
				//$pret = array('venda' => 'Comprar', 'locacao' =>'Alugar');
				//echo form::dropdown( 'pret', $pret , uri::segment(1), 'onChange = "carrega_faixas_valor(this)"' );
				echo form::hidden( "pret" , $pret ,array("id"=>"pret"));

				echo form::input('cod_jb', '' , 'class="input" placeholder = "Código"') ;

				$selecione = array(null => 'Cidade');
				$array_cidades = array_merge($selecione,$cidades);
				echo '<div class="selectlist1">';
				echo form::dropdown( 'cidade' , $array_cidades , $this->input->get('cidade'), "class='select' id='form_cidade'" );
				echo "</div>";

				?>
				<div class="selectlist2">
					<select name="dorm" class="select" id='form_dorm' >
						<option value="0">Dorm</option>
						<option value="dormitorios-1">1 Dorm</option>
						<option value="dormitorios-2">2 Dorm</option>
						<option value="dormitorios-3">3 Dorm</option>
						<option value="dormitorios-4">4 Dorm</option>
						<option value="dormitorios-5">5 Dorm</option>
					</select>
				</div>

				<div class="selectlist2 selectlist2">
				 <select name="banheiros" class="select small" id='form_banh'>
				  <option value="0">Banh.</option>
				  <option value="banheiros-1">1 Banh.</option>
				  <option value="banheiros-2">2 Banh.</option>
				  <option value="banheiros-3">3 Banh.</option>
				  <option value="banheiros-4">4 Banh.</option>
				  <option value="banheiros-5">5 Banh.</option>
				  </select>
				</div>

				<?php

				/*
				$selecione = array(null => 'Finalidade');

				$array_finalidades = array_merge($selecione,$finalidades);
				echo form::dropdown('finalidade',$array_finalidades,$this->input->get('finalidade'));
				*/

			   // $selecione = array(null => 'Valor');
				//$array_faixas_valor = array_merge($selecione, $faixas_valor_venda);
				
				echo "<div id='faixas'>";
					echo '<div class="selectlist1 ">';
					echo form::dropdown('faixa_valor_min_'.$pret , $faixas_valor , $this->input->get('faixa_valor'), "class='select small faixa_valor_'".$pret." id='form_valor_min_".$pret."'");
					echo "</div>";

					//$selecione = array(null => 'Valor');
				   // $array_faixas_valor = array_merge($selecione, $faixas_valor_venda);
					echo '<p class="ate">até</p>';
					echo '<div class="selectlist1 faixa_valor_max">';
					echo form::dropdown('faixa_valor_max_'.$pret , $faixas_valor , $this->input->get('faixa_valor'), "class='select small faixa_valor_".$pret."' id='form_valor_max_".$pret."'");
					echo "</div>";
							
					echo '<div class="selectlist4">';
					$selecione = array(null => 'Tipo do im&oacute;vel');
					$array_tipos = array_merge($selecione,$tipos);		
					echo form::dropdown('tipo',$array_tipos,$this->input->get('tipo'), "class='select' id='form_tipo'");					
					echo "</div>";
					
					?>
					
					<div class="selectlist5">
					 <select name="finalidade" class="select small" id='finalidade'>
					  <option value="" selected="selected">Finalidade</option>
					  <option value="residencial">Residencial</option>
					  <option value="comercial">Comercial</option>
					  <option value="industrial">Industrial</option>
					  <option value="rural">Rural</option>					 
					  </select>
					  </div>
					
					
					
					<?php
					
					
				echo "</div>";
				/*
				$selecione = array(null => 'Bairro');
				echo form::dropdown('bairro',$selecione, null, 'disabled="true"');
				*/

				echo ''.form::button(array('id'=>'buscar', 'type'=>'submit', 'class' => 'buttonsearch'), 'buscar').'';
				
				//echo "</aside>";
			echo "</aside>";
		echo "</fieldset>";
	echo form::close();

		?>