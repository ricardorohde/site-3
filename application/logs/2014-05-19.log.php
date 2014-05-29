<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-05-19 13:51:02 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: Unknown column 'subtitle' in 'where clause' - SELECT `imoveis`.*
FROM (`imoveis`)
WHERE  `tipo` LIKE '%apartamento%'
OR  `subtitle` LIKE '%apartamento%'
OR  `cidade` LIKE '%apartamento%'
OR  `bairro` LIKE '%apartamento%'
OR  `uf` LIKE '%apartamento%'
ORDER BY `imoveis`.`pkimovel` ASC no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2014-05-19 14:40:54 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')
						FROM imoveis
						WHERE MATCH (tipo,finalidade,cidade,bairro,uf) AGAI' at line 8 - 
            		SELECT cod_jb,
	            		CONCAT_WS(', ',
						    CASE WHEN tipo THEN 'tipo' END,
						    CASE WHEN finalidade THEN 'finalidade' END,
						    CASE WHEN cidade THEN 'cidade' END,
						    CASE WHEN bairro THEN 'bairro' END,
						    CASE WHEN uf THEN 'uf' END,
						    )
						FROM imoveis
						WHERE MATCH (tipo,finalidade,cidade,bairro,uf) AGAINST ('apartamento')            		
            		 no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2014-05-19 14:44:31 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') 
						FROM imoveis 
						WHERE MATCH (tipo,finalidade,cidade,bairro,uf) AG' at line 8 - 
            		SELECT cod_jb,
	            		CONCAT_WS(', ',
						    CASE WHEN tipo THEN 'tipo' END,
						    CASE WHEN finalidade THEN 'finalidade' END,
						    CASE WHEN cidade THEN 'cidade' END,
						    CASE WHEN bairro THEN 'bairro' END,
						    CASE WHEN uf THEN 'uf' END,
						    ) 
						FROM imoveis 
						WHERE MATCH (tipo,finalidade,cidade,bairro,uf) AGAINST ('apartamento')            		
            		 no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2014-05-19 14:45:27 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: The used table type doesn't support FULLTEXT indexes - 
            		SELECT cod_jb,
	            		CONCAT_WS(', ',
						    CASE WHEN tipo THEN 'tipo' END,
						    CASE WHEN finalidade THEN 'finalidade' END,
						    CASE WHEN cidade THEN 'cidade' END,
						    CASE WHEN bairro THEN 'bairro' END,
						    CASE WHEN uf THEN 'uf' END
						    ) 
						FROM imoveis 
						WHERE MATCH (tipo,finalidade,cidade,bairro,uf) AGAINST ('apartamento')            		
            		 no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2014-05-19 14:49:35 +00:00 --- error: Não foi possível capturar  Kohana_Database_Exception: Houve um erro no seguinte comando SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '%apartamento% OR finalidade LIKE %apartamento% OR cidade LIKE %apartamento% OR b' at line 10 - 
            		SELECT cod_jb,
	            		CONCAT_WS(', ',
						    CASE WHEN tipo THEN 'tipo' END,
						    CASE WHEN finalidade THEN 'finalidade' END,
						    CASE WHEN cidade THEN 'cidade' END,
						    CASE WHEN bairro THEN 'bairro' END,
						    CASE WHEN uf THEN 'uf' END
						    ) 
						FROM imoveis 
						WHERE tipo LIKE %apartamento% OR finalidade LIKE %apartamento% OR cidade LIKE %apartamento% OR bairro LIKE %apartamento% OR uf LIKE %apartamento%           		
            		 no arquivo D:/Programas/wamp/www/kohana/system/libraries/drivers/Database/Mysql.php, linha 371
2014-05-19 16:49:58 +00:00 --- error: Não foi possível capturar  PHP Error: Invalid argument supplied for foreach() no arquivo D:/Programas/wamp/www/next/site/application/helpers/tools.php, linha 393
