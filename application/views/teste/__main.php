<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />
    <title><?= html::specialchars($title).' | '. site::site_name(); ?></title>

    <!-- Included CSS Files (Uncompressed) -->
    <!--
    <link rel="stylesheet" href="<?=url::base();?>stylesheets/foundation.css">
    -->
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="<?=url::base();?>stylesheets/foundation.min.css">
  <link rel="stylesheet" href="<?=url::base();?>stylesheets/app.css">

  <script src="<?=url::base();?>javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->


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

</head>

<body id = "<?=$body_id;?>">


  <?php if( isset( $header ) ) echo $header;   ?>
  <?php if(isset($layout))  echo $layout; ?>
  <?php if(isset($footer)) echo $footer; ?>



<!-- Included JS Files (Compressed) -->
  <script src="<?=url::base();?>javascripts/jquery.js"></script>
  <script src="<?=url::base();?>javascripts/foundation.min.js"></script>

  <!-- Initialize JS Plugins -->
  <script src="<?=url::base();?>javascripts/app.js"></script>


    <script>
    $(window).load(function(){
      $("#featured").orbit();
      $("#featuredHome").orbit({ fluid: '16x6' });
    });
    </script>
</body>
</html>