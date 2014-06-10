<section id="header">
<header>
<section class="wrapper">

    <div class="logo"><a href="<?=url::base();?>"><img src="images/logo.png" alt="Next" /></a></div>

    <nav>
		<ul id='menu'>
            <li><?= html::anchor('imoveis_a-venda.html','Comprar' ); ?></li>
            <li><?= html::anchor('imoveis_para-alugar.html','Alugar'); ?></li>
            <li><?= html::anchor('exclusividade','Negociar' ); ?></li>
            <!--li><?= html::anchor('blog','Blog' ); ?></li-->
            <!--li><?= html::anchor('#','Mobile'); ?></li-->
        </ul>
		
		<?php
			if(Auth::instance()->logged_in()) //se tiver alguem logado
			{
				echo "<div id='profile'>";
					//echo html::image("images/profile_pic.jpg");
					echo "<span>Minha área VIP<button>opções</button>";
							echo "<ul id='menu_popup'>";
								echo "<span></span>";
								echo "<li id='meu_perfil_li'>".( html::anchor("vip/perfil","Meu cadastro") )."</li>";				
								echo "<li>".( html::anchor("vip/imoveis_seguidos?tipo_imovel=venda","Imóveis a venda") )."</li>";							
								echo "<li>".( html::anchor("vip/imoveis_seguidos?tipo_imovel=locacao","Imóveis para alugar") )."</li>";							
								echo "<li>".( html::anchor("vip/visualizacoes_recentes","Visualizações recentes") )."</li>";							
								echo "<li>".( html::anchor("vip/buscas_salvas","Buscas salvas") )."</li>";							
								echo "<li>".( html::anchor("vip/buscas_recentes","Buscas recentes") )."</li>";							
								echo "<li>".( html::anchor("vip/logout","logout") )."</li>";
							echo "</ul>";
						
					echo "</span>";	
									
				echo "</div>";
			
			}		
		?>
    </nav>

    <div class="rightlinks">
    <aside>
    <p>(19) 2512-0000</p>
		<?php
			$search =  implode(" ", explode("_",$this->input->get('search',"") ) );
			echo form::open('imoveis/busca' , array("id"=>"busca_topo"));
			echo form::hidden( "pret_busca" , "venda" ,array("id"=>"pret"));
			echo form::hidden( "pret" , (isset($pret))?($pret):("venda") ,array("id"=>"pret"));
			echo form::input('cod_jb', $search , 'class="texto" placeholder = "Palavras Chave"') ;
			echo ''.form::button(array('id'=>'buscar', 'type'=>'submit', 'class' => 'buttonsearch'), 'buscar').'';
			echo form::close();
		?>

	
    <ul>
		<li> <a href="javascript:void()" onclick="window.open('http://corretoronline.univenweb.com.br/atendimento.aspx?empresa=1390','corretoronline','width=430,height=378,top=0,left=0,scrollbars=no,status=no,toolbar=no,location=no,directories=no, menubar=no,resizable=no,fullscreen=no')">Corretor Online</a> </li>
		<li><?= html::anchor('vip','Seja VIP'); ?></li>
		<?php /* <li><?= html::anchor('#','Login',array("rel"=>"prettyPhoto") ); ?></li> */ ?>
		<li><?= html::anchor('contato','Contato',array("class"=>"fancybox_ajax")); ?></li>
    </ul>
    </aside>
    </div>

</section>
</header>
</section><!-- header -->