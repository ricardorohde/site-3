<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-12-23 22:20:43 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.TIPOS' doesn't exist - SELECT * FROM TIPOS ORDER BY TIPO no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:21:13 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.TIPO' doesn't exist - SELECT * FROM TIPO ORDER BY TIPO no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:21:15 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.TIPO' doesn't exist - SELECT * FROM TIPO ORDER BY TIPO no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:21:29 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.tipo' doesn't exist - SELECT * FROM tipo ORDER BY tipo no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:21:30 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.tipo' doesn't exist - SELECT * FROM tipo ORDER BY tipo no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:29:37 -02:00 --- error: Não foi possível capturar  PHP Error: array_keys() [<a href='function.array-keys'>function.array-keys</a>]: The first argument should be an array no arquivo application/helpers/busca.php, linha 224
2012-12-23 22:30:08 -02:00 --- error: Não foi possível capturar  PHP Error: array_keys() [<a href='function.array-keys'>function.array-keys</a>]: The first argument should be an array no arquivo application/helpers/busca.php, linha 224
2012-12-23 22:30:10 -02:00 --- error: Não foi possível capturar  PHP Error: array_keys() [<a href='function.array-keys'>function.array-keys</a>]: The first argument should be an array no arquivo application/helpers/busca.php, linha 224
2012-12-23 22:31:02 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.venda='1' AND im.tipo in ('area') AND bairro.slug_cidade='campinas'
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:43:41 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.venda='1' AND im.tipo in ('area') AND bairro.slug_cidade='campinas'
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:43:45 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.venda='1' AND im.tipo in ('area') AND bairro.slug_cidade='campinas'
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 22:57:26 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.faixas_valorvenda' doesn't exist - SELECT slug,titulo FROM faixas_valorvenda ORDER BY preco_min no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-23 23:17:03 -02:00 --- error: Não foi possível capturar  PHP Error: Invalid argument supplied for foreach() no arquivo application/views/painel_filtros.php, linha 62
