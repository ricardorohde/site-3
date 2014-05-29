<?php defined('SYSPATH') or die('No direct script access.'); ?>

2010-09-30 17:37:03 -03:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-48, 48' at line 7 - 
        	SELECT im.id
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.destaque='1'
    	    	ORDER BY valor_imovel
    	    	LIMIT -48, 48
    	     no arquivo C:/Users/PC/Documents/xampp/htdocs/Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2010-09-30 17:37:17 -03:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-48, 48' at line 7 - 
        	SELECT im.id
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.destaque='1'
    	    	ORDER BY valor_imovel
    	    	LIMIT -48, 48
    	     no arquivo C:/Users/PC/Documents/xampp/htdocs/Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2010-09-30 17:37:29 -03:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-48, 48' at line 7 - 
        	SELECT im.id
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1
    	    	ORDER BY valor_imovel
    	    	LIMIT -48, 48
    	     no arquivo C:/Users/PC/Documents/xampp/htdocs/Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2010-09-30 17:39:31 -03:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-48, 48' at line 7 - 
        	SELECT im.id
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1
    	    	ORDER BY valor_imovel
    	    	LIMIT -48, 48
    	     no arquivo C:/Users/PC/Documents/xampp/htdocs/Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
