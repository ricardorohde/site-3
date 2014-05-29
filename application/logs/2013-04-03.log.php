<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-03 18:48:50 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '16:45:21
				  ORDER BY pkimovel DESC' at line 12 -         		
				  SELECT im.pkimovel
				  FROM imoveis as im
				  
					INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
					INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
					INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo

					LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
					LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
					LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
				  
				  WHERE 1=1 AND im.venda='1' AND im.valvenda >= 600000 AND im.valvenda <= 900000 AND im.valor_cond > 0 AND im.alterado > 2013-04-03 16:45:21
				  ORDER BY pkimovel DESC						
    	     no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2013-04-03 18:51:16 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '16:45:21
				  ORDER BY pkimovel DESC' at line 12 -         		
				  SELECT im.pkimovel
				  FROM imoveis as im
				  
					INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
					INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
					INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo

					LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
					LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
					LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
				  
				  WHERE 1=1 AND im.venda='1' AND im.valvenda >= 600000 AND im.valvenda <= 900000 AND im.valor_cond > 0 AND im.alterado > 2013-04-03 16:45:21
				  ORDER BY pkimovel DESC						
    	     no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2013-04-03 18:56:16 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '16:45:21
				  ORDER BY pkimovel DESC' at line 12 -         		
				  SELECT im.pkimovel
				  FROM imoveis as im
				  
					INNER JOIN bairro_sinonimos AS bs ON bs.uf=im.uf AND bs.cidade=im.cidade AND bs.bairro=im.bairro
					INNER JOIN bairros AS bairro ON bairro.uf=bs.uf AND bairro.cidade=bs.cidade AND bairro.bairro=bs.sinonimo
					INNER JOIN tipos AS tipo ON tipo.tipo=im.tipo

					LEFT OUTER JOIN dormitorios AS dormitorios ON dormitorios.slug=im.dormitorios_slug
					LEFT OUTER JOIN banheiros AS banheiros ON banheiros.slug=im.banheiros_slug
					LEFT OUTER JOIN garagens AS garagens ON garagens.slug=im.garagens_slug
				  
				  WHERE 1=1 AND im.venda='1' AND im.valvenda >= 600000 AND im.valvenda <= 900000 AND im.valor_cond > 0 AND im.alterado > 2013-04-03 16:45:21
				  ORDER BY pkimovel DESC						
    	     no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
