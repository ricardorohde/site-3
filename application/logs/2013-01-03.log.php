<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-01-03 09:17:29 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'im.destaque' in 'where clause' - 
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE 1=1 AND im.destaque='1'
	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 18:28:18 -02:00 --- error: Não foi possível capturar  PHP Error: Missing argument 1 for tools_Core::lista_finalidades(), called in /home/nextsim/public_html/application/helpers/tools.php on line 300 and defined no arquivo application/helpers/tools.php, linha 31
2013-01-03 18:42:12 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')
ORDER BY `tipos`.`id` ASC' at line 3 - SELECT `tipos`.*
FROM (`tipos`)
WHERE `slug` IN ()
ORDER BY `tipos`.`id` ASC no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 18:43:14 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')
ORDER BY `tipos`.`id` ASC' at line 3 - SELECT `tipos`.*
FROM (`tipos`)
WHERE `slug` IN ()
ORDER BY `tipos`.`id` ASC no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 19:03:50 -02:00 --- error: Não foi possível capturar  PHP Error: Missing argument 2 for Imoveis_Controller::detalhes() no arquivo application/controllers/imoveis.php, linha 288
2013-01-03 21:35:34 -02:00 --- error: Não foi possível capturar  PHP Error: Missing argument 1 for busca_Core::campos_ordenacao(), called in /home/nextsim/public_html/application/views/lista_imoveis.php on line 24 and defined no arquivo application/helpers/busca.php, linha 484
2013-01-03 21:49:17 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios.min' in 'order clause' - 
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.venda='1' AND bairro.slug_cidade='campinas'
    	    	ORDER BY dormitorios.min
    	    	LIMIT 50, 10
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 21:49:25 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios.min' in 'order clause' - 
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.venda='1' AND bairro.slug_cidade='campinas'
    	    	ORDER BY dormitorios.min
    	    	LIMIT 50, 10
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 21:52:16 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios.min' in 'order clause' - 
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.venda='1' AND bairro.slug_cidade='campinas'
    	    	ORDER BY dormitorios.min
    	    	LIMIT 50, 10
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 21:53:33 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios.min' in 'order clause' - 
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.venda='1' AND bairro.slug_cidade='campinas'
    	    	ORDER BY dormitorios.min
    	    	LIMIT 50, 10
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 21:54:05 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios.min' in 'order clause' - 
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.venda='1' AND bairro.slug_cidade='campinas'
    	    	ORDER BY dormitorios.min
    	    	LIMIT 50, 10
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2013-01-03 21:56:29 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios.min' in 'order clause' - 
        	SELECT im.pkimovel
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.venda='1' AND bairro.slug_cidade='campinas'
    	    	ORDER BY dormitorios.min
    	    	LIMIT 680, 10
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
