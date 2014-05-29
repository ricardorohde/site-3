<!doctype html>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- disable iPhone inital scale -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-touch-fullscreen" content="YES">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0" name="viewport">
    <title><?= html::specialchars($title).' | '. site::site_name(); ?></title>

    <link href="<?=url::base();?>css/main.css" rel="stylesheet" type="text/css" />
    <link href="<?=url::base();?>css/royalslider.css" rel="stylesheet" type="text/css" />
    <link href="<?=url::base();?>css/media_queries.css" rel="stylesheet" type="text/css" />
    <link href="<?=url::base();?>css/typography.css" rel="stylesheet" type="text/css" />

    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?=url::base();?>js/jquery-1.7.1.min.js"></script>

    <script src="<?=url::base();?>js/jquery.min.js"></script>

    <script type="text/javascript" src="<?=url::base();?>js/_functions.js"></script>

    <script src="<?=url::base();?>js/jquery.easing.1.3.min.js"></script>
    <script src="<?=url::base();?>js/royal-slider-8.1.min.js"></script>

    <script type="text/javascript" src="<?=url::base();?>js/jquery1.js"></script>

    <script type="text/javascript" src="<?=url::base();?>js/jquery-tools.min.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/jquery.custom.js"></script>

</head>
<body>

<?php if( isset( $header ) ) echo $header;   ?>
  <?php if(isset($layout))  echo $layout; ?>











<section id="banner" class="show"><img src="images/slide_banner02.jpg" alt="banner" /></section><!-- banner -->


<section class="bgbannerform">
<section class="bannerform">

    <h1><span>Orientando os melhores</span> negócios imobiliários</h1>

    <div class="box">
    <div class="idTabs">
    <ul>
    <li><a href="#" class="selected"><span>Comprar</span></a></li>
    <li><a href="#"><span>Alugar</span></a></li>
    <li><a href="#"><span>Cadastrar meu imóvel</span></a></li>
    </ul>
    </div>

    <div class="form1">
    <form action="#" method="post">
    <fieldset>
    <aside>
    <input name="" type="text" class="input" placeholder="Código"  />

    <select name="address" class="select">
    <option value="Campinas, SP">Campinas, SP</option>
    <option value="Campinas, SP">Barão Geraldo, SP</option>
    <option value="Campinas, SP">Valinhos, SP</option>
    <option value="Campinas, SP">Vinhedo, SP</option>
    <option value="Campinas, SP">Americana, SP</option>
    </select>

    <div class="selectlist2">
    <select name="dorm" class="select">
    <option value="Dorm">Dorm</option>
    <option value="Dorm">1 Dorm</option>
    <option value="Dorm">2 Dorm</option>
    <option value="Dorm">3 Dorm</option>
    <option value="Dorm">4 Dorm</option>
    <option value="Dorm">5 Dorm</option>
    </select>
    </div>

    <div class="selectlist2 selectlist2">
    <select name="banh" class="select">
    <option value="Banh.">Banh.</option>
    <option value="Banh.">1 Banh.</option>
    <option value="Banh.">2 Banh.</option>
    <option value="Banh.">3 Banh.</option>
    <option value="Banh.">4 Banh.</option>
    <option value="Banh.">5 Banh.</option>
    </select>
    </span>    </div>

    <aside>
    <input name="" type="text" class="input input2" placeholder="R$ MIN"  />
    <p class="ate">até</p>
    <input name="" type="text" class="input input2" placeholder="R$ MAX"  />

    <div class="selectlist4">
    <select name="address2" class="select">
    <option value="Tipo de propriedade">Tipo de propriedade</option>
    <option value="Tipo de propriedade">Casa</option>
    <option value="Tipo de propriedade">Apartamento</option>
    <option value="Tipo de propriedade">Terreno</option>
    <option value="Tipo de propriedade">Casa em condomínio</option>
    <option value="Tipo de propriedade">Outro</option>
    </select>

    <p class="ex">Ex: casa em condomínio</p>
    </div>

    <input name="" type="button" value="buscar" class="buttonsearch" onClick="location.href='imoveis-a-venda-em-campinas.html'"/>
    </aside>
    </fieldset>
    </form>

    <p class="time"><a href="#">Minhas buscas</a></p>
    <p class="right"><a href="#">Mais opções de busca</a></p>
    </div>
    </div>


    <div class="box2">
    <h2>Precisa de ajuda?</h2>
    <p>Sua procura pode ser desgastante, mas não se contar com a assessoria certa. Estamos aqui para fazer tudo para que realize um ótimo negócio sem perder tempo</p>
    <a href="#" class="atendimento">Atendimento VIP</a>
    </div>

</section>
</section><!-- banner form -->


<section id="middlecontent">
<section class="wrapper">

    <figure><img src="images/screenshoot01.jpg" alt="ScreenShoot" /></figure>

    <div class="steps">
    <aside>
    <h3><span>1</span> Encontre fácil</h3>
    <p>De qualquer lugar você poderá ver os melhores negócios imobiliários. Inclusive os perto de onde está.</p>
    </aside>

    <aside class="step2">
    <h3><span>2</span> Siga seu imóvel</h3>
    <p>Disponibilizamos a sua área VIP, onde você poderá seguir seus imóveis e buscas preferidos</p>
    </aside>

    <aside class="step3">
    <h3><span>3</span> Não perca tempo</h3>
    <p>Os melhores negócios podem acontecer em pouco tempo e você precisa estar atento.</p>
    </aside>
    </div>

    <article>
    <h5><img src="images/nextmobile.gif" alt="Next Mobile" /></h5>
    <p>Sua primeira compra pode ser desgastante, mas não se contar com a assessoria certa.</p>
    <div class="buttonconnect"><a href="email-mobile.html"><span>Conheça NextMobile</span></a></div>
    </article>

</section><!-- wrapper -->
</section><!-- middle content -->


<section id="recents">
<section class="wrapper">

    <h4><span>Imóveis mais</span> recentes</h4>

    <div class="slider">
        <div id="slider-ajax-container">
        <div id="banner-rotator" class="royalSlider">
        <ul class="royalSlidesContainer">
        <li class="royalSlide">
        <article class="active">
        <figure><a href="casa-a-venda-alphaville.html"><img src="images/photo01.jpg" alt="PHOTO" /></a></figure>
        <p><span>Alphaville</span> <br /> R$ 1.720.000</p>
        </article>

        <article>
        <figure><a href="casa-a-venda-alphaville.html"><img src="images/photo02.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>

        <article>
        <figure><a href="casa-a-venda-alphaville.html"><img src="images/photo03.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>

        <article>
        <figure><a href="casa-a-venda-alphaville.html"><img src="images/photo04.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>

        <article>
        <figure><a href="casa-a-venda-alphaville.html"><img src="images/photo05.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>
        </li>

        <li class="royalSlide">
        <article>
        <figure><a href="#"><img src="images/photo01.jpg" alt="PHOTO" /></a></figure>
        <p><span>Alphaville</span> <br /> R$ 1.720.000</p>
        </article>

        <article>
        <figure><a href="#"><img src="images/photo02.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>

        <article>
        <figure><a href="#"><img src="images/photo03.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>

        <article>
        <figure><a href="#"><img src="images/photo04.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>

        <article>
        <figure><a href="#"><img src="images/photo05.jpg" alt="PHOTO" /></a></figure>
        <p><span>Moinho de Vento</span> <br /> R$ 2.720.000</p>
        </article>
        </li>
        </ul>
        </div>
        </div>
    </div>

</section><!-- wrapper -->
</section><!-- recents -->

<?php if(isset($footer)) echo $footer; ?> 


	<script>
    jQuery(document).ready(function($) {
    $('#banner-rotator').royalSlider({
    imageAlignCenter:true,
    imageScaleMode: "fill",

    hideArrowOnLastSlide:true,
    slideSpacing:0,

    autoScaleSlider: true,
	slideshowEnabled:false,
    autoScaleSliderWidth:"auto",
    autoScaleSliderHeight:"auto"
    });
    });
    </script>

	<script>
    jQuery(document).ready(function($) {
    $('#banner-rotator2').royalSlider({
    imageAlignCenter:true,
    imageScaleMode: "fill",

    hideArrowOnLastSlide:true,
    slideSpacing:0,

    autoScaleSlider: true,
	slideshowEnabled:false,
    autoScaleSliderWidth:"auto",
    autoScaleSliderHeight:"auto"
    });
    });
    </script>

</body>
</html>
