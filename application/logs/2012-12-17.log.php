<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-12-17 13:15:44 -02:00 --- error: Não foi possível capturar  PHP Error: array_merge() [<a href='function.array-merge'>function.array-merge</a>]: Argument #2 is not an array no arquivo application/views/form_pesquisa.php, linha 54
2012-12-17 13:18:44 -02:00 --- error: Não foi possível capturar  PHP Error: array_merge() [<a href='function.array-merge'>function.array-merge</a>]: Argument #2 is not an array no arquivo application/views/form_pesquisa.php, linha 54
2012-12-17 13:18:50 -02:00 --- error: Não foi possível capturar  PHP Error: array_merge() [<a href='function.array-merge'>function.array-merge</a>]: Argument #2 is not an array no arquivo application/views/form_pesquisa.php, linha 54
2012-12-17 13:56:11 -02:00 --- error: Não foi possível capturar  Kohana_404_Exception: A página <tt>quero-alugar</tt> requisitada, não foi encontrada. no arquivo Kohana_v2.3.4/system/core/Kohana.php, linha 841
2012-12-17 15:03:40 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'im.banheiros_slug' in 'where clause' - 
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE 1=1 AND im.pret='venda' AND bairro.slug_cidade='campinas' AND im.dormitorios_slug='2' AND im.banheiros_slug='1'
	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 15:59:22 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'banheiros.titulo' in 'field list' - 
        	SELECT concat_ws('__',banheiros.titulo,banheiros.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
    	    	WHERE 1=1 AND im.pret='venda' AND bairro.slug_cidade='campinas' AND im.dormitorios_slug='dormitorios-2'
    	    	GROUP BY concat_ws('__',banheiros.titulo,banheiros.slug)
    	    	ORDER BY banheiros.min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 17:22:31 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'garagens.titulo' in 'field list' - 
        	SELECT concat_ws('__',garagens.titulo,garagens.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas'
    	    	GROUP BY concat_ws('__',garagens.titulo,garagens.slug)
    	    	ORDER BY garagens.min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 17:23:38 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'garagens.titulo' in 'field list' - 
        	SELECT concat_ws('__',garagens.titulo,garagens.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas'
    	    	GROUP BY concat_ws('__',garagens.titulo,garagens.slug)
    	    	ORDER BY garagens.min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 17:26:43 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'garagens.titulo' in 'field list' - 
        	SELECT concat_ws('__',garagens.titulo,garagens.slug) as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas'
    	    	GROUP BY concat_ws('__',garagens.titulo,garagens.slug)
    	    	ORDER BY garagens.min
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 18:06:09 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'dormitorios' in 'where clause' - 
    	SELECT count(*) as total_itens
	    	FROM imoveis AS im
	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
	    	WHERE 1=1 AND im.pret='venda' AND bairro.slug_cidade='campinas' AND im.dorm=dormitorios-3
	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 20:02:58 -02:00 --- error: Não foi possível capturar  Kohana_Exception: Métodos de consulta não podem ser usados atráves de ORM no arquivo Kohana_v2.3.4/system/libraries/ORM.php, linha 200
2012-12-17 20:09:26 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN ba' at line 1 - 
        	SELECT  as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas' AND im.dormitorios_slug='dormitorios-4'
    	    	GROUP BY 
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 20:10:15 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN ba' at line 1 - 
        	SELECT  as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas' AND im.dormitorios_slug='dormitorios-4'
    	    	GROUP BY 
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 20:10:16 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN ba' at line 1 - 
        	SELECT  as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas' AND im.dormitorios_slug='dormitorios-4'
    	    	GROUP BY 
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 20:11:17 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 7 - 
        	SELECT im.id
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
    	    	WHERE 1=1 AND im.pret='venda' AND im.tipo='casa' AND bairro.slug_cidade='campinas' AND im.dormitorios_slug='dormitorios-4'
    	    	ORDER BY tipo.tipo
    	    	LIMIT 0, 
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 20:41:59 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'tipos' in 'field list' - 
        	SELECT tipos as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.pret='venda' AND bairro.slug_cidade='campinas' AND im.residencial=1
    	    	GROUP BY tipos
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
2012-12-17 20:42:47 -02:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'tipos.slug' in 'field list' - 
        	SELECT tipos.slug as chave,count(*) as total
    	    	FROM imoveis AS im
    	    		INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
    	    		INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
                    INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo
                    INNER JOIN faixas_valor AS faixa ON faixa.slug=im.faixa_valor_slug
                    LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
                    LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
                    LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
    	    	WHERE 1=1 AND im.pret='venda' AND bairro.slug_cidade='campinas' AND im.residencial=1
    	    	GROUP BY tipos.slug
    	    	ORDER BY tipo.tipo
    	     no arquivo Kohana_v2.3.4/system/libraries/drivers/Database/Mysql.php, linha 371
