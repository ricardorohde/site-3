<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-touch-fullscreen" content="YES">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0" name="viewport">
    <base href="<?=url::base();?>">
    <title><?php echo (isset($title_important))?($title_important):( html::specialchars($title).' | '. site::site_name() ); ?></title>

  <link href="<?=url::base();?>css/main.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>css/royalslider.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>css/rs-default.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>css/media_queries.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>css/typography.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>css/foundation.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
  <link href="<?=url::base();?>favicon.ico" rel="icon" type="image/x-icon" />
  <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

	<script src="<?=url::base();?>javascripts/jquery.js"></script>
	<script type="text/javascript" src="<?=url::base();?>js/sticky.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/accordation.js"> </script> 
    <script src="<?=url::base();?>js/jquery.easing.1.3.min.js"></script>
    <script src="<?=url::base();?>js/royal-slider-8.1.min.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/jquery-tools.min.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/jquery.custom.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/history.min.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/fancybox.js"></script>
    <script type="text/javascript" src="<?=url::base();?>js/fancybox_media.js"></script>
	
	
	<script>
	  jQuery(document).ready(function($){
	    $('#bgheading').sticky({ topSpacing: 0  });
	  });
	

	function validate(form)
	{
		var ret = true;
		var nome = form.nome.value;
		var email = form.email.value;	
		var tel = form.tel.value;	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if(!re.test(email))		//validar email		
		{
			$("#label_email").toggleClass("show");
			setTimeout(function(){ $("#label_email").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (nome==null || nome=="") //validar nome
		{
			$("#label_nome").toggleClass("show");
			setTimeout(function(){ $("#label_nome").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		if (tel==null || tel=="") //validar telefone
		{
			$("#label_telefone").toggleClass("show");
			setTimeout(function(){ $("#label_telefone").toggleClass("show"); }, 5000);
			ret = false;
		}
		
		return ret;
	}
	  
	 function validateEmail(email) { 
   
}  
	  
	</script>
    <?php
      if (isset($keywords)) echo '<meta name="keywords" content="'.$keywords.'" />';
      if (isset($description)) echo '<meta name="description" content="'.$description.'" />';
      if (isset($robots)):
        echo '<meta name="robots" content="'.$robots.'" />';
      else:
        echo '<meta name="robots" content="index,follow" />';
      endif;
      if ( isset( $canonical ) ) echo '<link rel="canonical" href="' . url::site() . $canonical .  '"/>' ;
    ?>

	<!-- favicon -->
	<link rel="shortcut icon" href="/favicon.ico" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
  _gaq.push(['_require', 'inpage_linkid', pluginUrl]);
  _gaq.push(['_setAccount', 'UA-39109119-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body id = "<?=$body_id;?>">

<div id='loading'><div id='loader'></div></div>

<div id='contato'></div>
<div id='vender_imovel'></div>
<div id='seja_vip'></div>


  <?php if( isset( $header ) ) echo $header;   ?>
  <?php if(isset($layout))  echo $layout; ?>
  <?php if(isset($footer)) echo $footer; ?>

    <script>
	
    jQuery(document).ready(function($) {	
	
		$('#banner-rotator').royalSlider({
		 autoHeight: false,			
			fadeinLoadedSlide: false,		
			imageScaleMode: 'none',
			imageAlignCenter:false,			
			arrowsNavAutoHide: false,
			controlNavigation: 'none', 		
			controlsInside:false,
			numImagesToPreload:5,
			hideArrowOnLastSlide:true
		});
	
    });
    </script>

	<script>
	 jQuery(document).ready(function($) {
	
		$('#banner-rotator2').royalSlider({			
		imageScaleMode: 'none',
	autoScaleSlider: true,
	autoScaleSliderWidth:1639,
	autoScaleSliderHeight:"auto",
	imgWidth:"null",
	imgHeight:"null",
	imageAlignCenter:true,
	controlNavigation: 'thumbnails', 
	arrowsNavAutoHide: false,
    arrowsNavHideOnTouch: false,
	keyboardNavEnabled: true, 
	numImagesToPreload:999,
	
	fadeinLoadedSlide: true,
    thumbs: {
      appendSpan: true,
      firstMargin: true,
      paddingBottom: 7,
      paddingTop: 7,
    }		
	  });
	 
	  
	  
	});	
	
	jQuery(document).ready(function($){ 
		$(".fancybox").fancybox({width:"auto",height:"auto",autoWidth:true,wrapCSS:"fancybox_gallery"});
		$(".fancybox_ajax").fancybox({type:'ajax',minWidth:270, helpers : {media : {}   }});
	
    <?php
	if(isset($_GET['enviado']))
	{
		$view = url::base()."application/views/sucesso/sucesso_".$_GET["tipo"].".php";
		?> 
			$.fancybox.open({type: 'iframe',href:"<?php echo $view;?>",width:425,height:200});
		
		<?php
	}
	?>
	
	});				
	
    </script>	
	
</body>
</html>