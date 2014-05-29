<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-12-22 20:40:15 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.faixas_valor_' doesn't exist - 
        	SELECT concat_ws('__',tipo.tipo,tipo.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor_ AS faixa ON faixa.slug=im.faixa_valor__slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',tipo.tipo,tipo.slug)
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 20:40:26 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Table 'nextsim_next.faixas_valor_' doesn't exist - 
        	SELECT concat_ws('__',tipo.tipo,tipo.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor_ AS faixa ON faixa.slug=im.faixa_valor__slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',tipo.tipo,tipo.slug)
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:16:15 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:16:26 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:18:37 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:18:45 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:18:50 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:18:56 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:19:55 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:19:57 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:20:22 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
        	SELECT concat_ws('__',faixa.titulo,faixa.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1
    	    	GROUP BY concat_ws('__',faixa.titulo,faixa.slug)
    	    	ORDER BY faixa.preco_min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-22 21:22:59 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'faixa.titulo' in 'field list' - 
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
