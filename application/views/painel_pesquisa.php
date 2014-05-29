<div class="box pesquisa">

    <!-- tabs com os forms -->
        <dl class="tabs pill">
          <dd class="active"><a href="#comprar" onclick="trocapret('venda')" id='venda'><span>Comprar</span></a></dd>
          <dd><a href="#alugar" onclick="trocapret('locacao')" id='locacao'><span>Alugar</span></a></dd>
          <dd><?php echo html::anchor("exclusividade","Negociar meu imóvel"); ?></dd>
          <!--dd><a href="#cadastrar">Cadastrar meu imóvel</a></dd-->
        </dl>
       <ul class="tabs-content">
          <li class="active" id="comprarTab">
        <div class="form1">
 		<?=$form_comprar ?>
        </div>
        </li>
          <li id="alugarTab">
          <div class="form1">
           <?=$form_alugar ?>
           </div>
          </li>
          <li id="cadastrarTab">This is simple tab 3s content.</li>
        </ul>


</div>