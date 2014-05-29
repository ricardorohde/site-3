<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-01-04 13:34:01 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'im.destaque' in 'where clause' - 
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE 1=1 AND im.destaque='1'
	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
