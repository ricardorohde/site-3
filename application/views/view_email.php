<?php if ( isset($titulo)): ?><h1><?php echo $titulo; ?></h1><?php endif; ?>

<?php foreach( $campos as $k => $v ): ?>
    <?php if ( array_key_exists($k, $post) ): ?>
        <?php echo $v['label'] ?>: <?php echo $post[$k] ?><br />
    <?php endif; ?>
<?php endforeach; ?>
