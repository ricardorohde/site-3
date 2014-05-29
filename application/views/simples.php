<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?=site::site_name().' | '.html::specialchars($title);?></title>
    <!-- CSS -->
  	<link rel="stylesheet" href="<?=url::base();?>css/print.css" type="text/css" media="print" />
    <link rel="stylesheet" href="<?=url::base();?>css/ferramentas.css" type="text/css" media="screen, projection" />

        <?php  if(isset($extra_header)) echo $extra_header;  ?>

</head>
<body id = "<?=$body_id;?>">
<?php  if( isset( $layout ) )  echo $layout; ?>

</body>
</html>