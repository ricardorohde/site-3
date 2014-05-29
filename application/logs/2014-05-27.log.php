<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-05-27 20:38:14 +02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'casa'') OR im.cidade REGEXP 'casa' OR im.bairro REGEXP 'casa'' at line 5 - 
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE 1=1 AND im.venda='1' AND tipo in('casa'') OR finalidade in('casa'') OR im.cidade REGEXP 'casa' OR im.bairro REGEXP 'casa' 
	     no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysqli.php, linha 142
2014-05-27 20:38:14 +02:00 --- error: Não foi possível capturar  PHP Error: print_r(): Property access is not allowed yet no arquivo D:/Programas/wamp/www/kohana/system/core/Kohana.php, linha 1607
2014-05-27 20:38:17 +02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'casa'') OR im.cidade REGEXP 'casa' OR im.bairro REGEXP 'casa'' at line 5 - 
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE 1=1 AND im.venda='1' AND tipo in('casa'') OR finalidade in('casa'') OR im.cidade REGEXP 'casa' OR im.bairro REGEXP 'casa' 
	     no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysqli.php, linha 142
2014-05-27 20:38:17 +02:00 --- error: Não foi possível capturar  PHP Error: print_r(): Property access is not allowed yet no arquivo D:/Programas/wamp/www/kohana/system/core/Kohana.php, linha 1607
2014-05-27 20:55:17 +02:00 --- error: Não foi possível capturar  PHP Error: Missing argument 2 for busca_Core::generate_where(), called in D:\Programas\wamp\www\next\site\application\helpers\busca.php on line 200 and defined no arquivo D:/Programas/wamp/www/next/site/application/helpers/busca.php, linha 383
2014-05-27 21:16:17 +02:00 --- error: Não foi possível capturar  Kohana_404_Exception: A página <tt>nada</tt> requisitada, não foi encontrada. no arquivo D:/Programas/wamp/www/kohana/system/core/Kohana.php, linha 841
2014-05-27 21:16:36 +02:00 --- error: Não foi possível capturar  Kohana_404_Exception: A página <tt>nada</tt> requisitada, não foi encontrada. no arquivo D:/Programas/wamp/www/kohana/system/core/Kohana.php, linha 841
2014-05-27 22:13:36 +02:00 --- error: Não foi possível capturar  PHP Error: preg_match(): Delimiter must not be alphanumeric or backslash no arquivo D:/Programas/wamp/www/next/site/application/controllers/imoveis.php, linha 319
2014-05-27 22:24:10 +02:00 --- error: Não foi possível capturar  PHP Error: preg_match(): Delimiter must not be alphanumeric or backslash no arquivo D:/Programas/wamp/www/next/site/application/controllers/imoveis.php, linha 319
2014-05-27 22:32:27 +02:00 --- error: Não foi possível capturar  PHP Error: preg_match(): Delimiter must not be alphanumeric or backslash no arquivo D:/Programas/wamp/www/next/site/application/controllers/imoveis.php, linha 319
