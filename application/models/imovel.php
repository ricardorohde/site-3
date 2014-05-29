<?php defined('SYSPATH') or die('No direct script access.');

class Imovel_Model extends ORM {

    protected $has_many = array('fotos');
	protected $has_and_belongs_to_many = array('users');
    protected $primary_key = 'pkimovel';
	protected $table_name = 'imoveis';
	protected $plural = 'imoveis';	
	

	public function unique_key($id = NULL)
	{
		if ( ! empty($id) AND is_string($id) AND ! ctype_digit($id) )
		{
			return 'pkimovel';
		}
 
		return parent::unique_key($id);
	}
	
    public function validate(array & $array, $save = FALSE)
    {
        $array = Validation::factory($array)
                ->add_rules('cod_jb', 'required');
        return parent::validate($array, $save);
    }


    public function pega_miniatura()
    {		

        if(file_exists( site::site_thumb()."r_".$this->pkimovel.".jpg" ))
        {           
            $foto = ORM::factory('foto');
            $foto->arqfoto = site::site_thumb()."r_".$this->pkimovel.".jpg";
            $foto->descricao = "";
            return $foto;
        }
        
        $obj = ORM::factory('foto')
			->where('pkimovel',$this->pkimovel)
			->where('minia',1)->find();
        return $obj;
    }


    public function pega_foto()
    {
        $ret = null;

        // explode array imagens
        $imagem  = $this->foto;
        $imagens = explode(",", $imagem);
        if(sizeof($imagens)>1):
            //explode alt tags
            $alt = $this->chamada;
            $alts = explode("*",$alt);
	        //encontra a miniatura padrao
	        $my_imagem = $imagens[0];
	        $my_alt = $alts[0];
            $ret = array('imagem' => $my_imagem, 'alt' => $my_alt);
        endif;
        return $ret;
    }


    public function fotos()
    {
        $obj = ORM::factory('foto')
			->where('pkimovel',$this->pkimovel)->find_all();
        return $obj;
    }

    public function bairro_sinonimo() {
    	$ret = "";

        $objs = ORM::factory('bairro_sinonimo')
	    ->where(array('bairro' => $this->bairro, 'cidade' => $this->cidade, 'uf' => $this->uf) )
	    ->find_all();
    	
	    if ( sizeof($objs) > 0 ) {
	    	$obj = $objs[0];
	    	$ret = $obj->sinonimo;
	    }
    	
    	return $ret;
    }

    public function bairro_obj() {
    	$ret = null;

        $objs = ORM::factory('bairro')
	    ->where(array('bairro' => $this->bairro, 'cidade' => $this->cidade, 'uf' => $this->uf) )
	    ->find_all();

	    if ( sizeof($objs) > 0 ) {
	    	$obj = $objs[0];
	    	$ret = $obj;
	    }

    	return $ret;
    }


    public function tipo_obj() {
    	$ret = null;

        $objs = ORM::factory('tipo')
	    ->where(array('tipo' => $this->tipo) )
	    ->find_all();

	    if ( sizeof($objs) > 0 ) {
	    	$obj = $objs[0];
	    	$ret = $obj;
	    }

    	return $ret;
        }



    public function gera_url($pret = "venda",$busca=false,$index=true)
    {
        $bairro = $this->bairro_obj();
        $tipo = $this->tipo_obj();

        if( $pret == 'venda' )
            $r = url::base($index).'venda/detalhes';
        else
            $r = url::base($index).'locacao/detalhes';
        
        $r .= "/".$tipo->slug.'_'; // tipo				
       
        if ( $this->finalidade ) $r .= $this->finalidade.'_'; //finalidade
        $r .= $bairro ? $bairro->slug.'_' : '';
        $r .= $bairro ? $bairro->slug_cidade.'_' : '';
        $r .= ($this->valor_cond>0) ? 'em-condominio_' : '';
        $r .= $this->uf;
        $r .= "/".$this->cod_jb;
		if($busca)
			$r .= "?busca=1";
        $r = strtolower($r);  
        return $r;

    }
  
	
	
   
}