<?php defined('SYSPATH') OR die('No direct access allowed.');

class Migraimoveis_Controller extends Controller{

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
   	//public $template = 'main';
    public function index()
	{
       /* if (PHP_SAPI === 'cli') $this->migra();   */
    }

	public function migra()
	{

        $this->mapaimoveis = new MapaImoveis;
        $total=0;

        $xmls = array(
                '194' => array('xml'=>'194canal', 'pasta_imagens' => '29'),
                '210' => array('xml'=>'210canal', 'pasta_imagens' => '70'),
         );

        $lista = array();
        foreach ( array_keys($xmls) as $k ):
            $o = $xmls[$k];
            if ($this->mapaimoveis->load($o['xml'])):
                $lista = array_merge($lista, $this->mapaimoveis->extrai() );
            endif;
        endforeach;



        if ( sizeof($lista) > 0 ):
            Site_Config_Model::set_info('em_manutencao',1);

            ORM::factory('imovel')->delete_all();

          foreach( $lista as $row):

            $cod_imb = $row['cod_imb'];

            $obj = ORM::factory('imovel');

            foreach (array_keys($row) as $k):
              $obj->$k = $row[$k];
            endforeach;

            if ( ereg('RES', strtoupper ($row['finalidade'])) ) {
                $obj->residencial = 1;
            }

            if ( ereg('COM', strtoupper($row['finalidade'])) ) {
                $obj->comercial = 1;
            }

            if ( ereg('INDUSTRIAL', strtoupper($row['finalidade'])) ) {
                $obj->industrial = 1;
            }

            // acrescenta a pasta
            $foto = $row['foto'];
            $foto_str = $xmls[$cod_imb]['pasta_imagens'] . '/' . implode( "," . $xmls[$cod_imb]['pasta_imagens'] . '/', explode(',', $foto) );
            $obj->foto = $foto_str;

            $obj->save();

          endforeach;

          $this->manutencao_tabelas_busca();

           // system('php .........');

          endif;
	}


    function manutencao_tabelas_busca()
    {
            // EXTRAI OS BAIRROS
          $db=new Database;
          $sql = 'TRUNCATE TABLE busca_bairros';


          $db->query($sql);

          $sql = 'INSERT INTO busca_bairros (UF,CIDADE,BAIRRO)
                SELECT uf,cidade,bairro
                FROM `imoveis`
                GROUP BY uf,cidade,bairro
                ORDER BY uf,cidade,bairro';

    	  $db->query($sql);



          //-- ATUALIZA TABELA DE SINONIMOS, SEM DELETAR SEUS REGISTROS
          $sql = 'INSERT INTO bairro_sinonimos (uf,bairro,cidade)
          SELECT bb.uf,bb.bairro,bb.cidade
          FROM busca_bairros AS bb
          LEFT OUTER JOIN bairro_sinonimos AS bs ON (bb.uf=bs.uf AND bb.cidade=bs.cidade AND bb.bairro=bs.bairro)
          WHERE bs.uf IS NULL';
          $db->query($sql);

          $sql = 'UPDATE bairro_sinonimos SET sinonimo = bairro WHERE sinonimo IS NULL;';
    	  $db->query($sql);

          // -- PREPARA A TABELA DE SLUGS PARA BAIRROS
          $sql = 'TRUNCATE TABLE bairros';
          $db->query($sql);

          $sql = 'INSERT INTO bairros (UF,CIDADE,BAIRRO)
          SELECT UF,CIDADE,SINONIMO
          FROM bairro_sinonimos
          GROUP BY UF,CIDADE,SINONIMO';
          $db->query($sql);


          // -- PREPARA A TABELA DE SLUGS PARA CIDADES
          $sql = 'TRUNCATE TABLE cidades';
          $db->query($sql);

          $sql = 'INSERT INTO cidades (UF,CIDADE)
          SELECT UF,CIDADE
          FROM bairro_sinonimos
          GROUP BY UF,CIDADE';
          $db->query($sql);


          // -- EXTRAI OS TIPOS
          $sql = 'TRUNCATE TABLE tipos';
          $db->query($sql);

          $sql = 'INSERT INTO tipos (TIPO)
          SELECT tipo
          FROM `imoveis`
          GROUP BY tipo';
          $db->query($sql);


          $sql = 'UPDATE imoveis AS im
              INNER JOIN faixas_valor AS faixa ON ( faixa.pret = im.pret
              AND im.valor_imovel >= faixa.preco_min
              AND im.valor_imovel < faixa.preco_max )
              SET im.faixa_valor_slug=faixa.slug
            ';
          $db->query($sql);

          $sql = 'UPDATE imoveis AS im
              INNER JOIN dormitorios AS dormitorios ON (
              im.dorm >= dormitorios.min
              AND im.dorm < dormitorios.max )
              SET im.dormitorios_slug=dormitorios.slug
            ';
          $db->query($sql);


          Site_Config_Model::set_info('em_manutencao',0); 

          // url::redirect('http://localhost/homehunters/scripts/manutencao_tabelas_busca.php');
    }





} // End Controller