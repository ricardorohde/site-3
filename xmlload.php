<?php

		//conecta com o webservice
	$client = new SoapClient('http://www.centrina.com.br/WSConsumoPortal/Service.asmx?wsdl',array('trace' => 1)); 
	$function = 'getListaImoveis'; //funçao de pegar a lista dos imoveis
	$arguments= array('dados' => array(
							'fkempresa'   => 1390, //senha e usuario
							'senha'      => 'NE1390'                        
					));
	$client->__soapCall($function, $arguments);	
	$result = $client->__getLastResponse();
	
	$xml = new DOMDocument('1.0','iso-8859-1');	
	//$xml->formatOutput = true;	
	$xml->loadXML($result); 
	echo $xml->save("test.xml");	
    
	//conecta com o webservice
	//$client = new SoapClient('http://www.centrina.com.br/WSConsumoPortal/Service.asmx?wsdl',array('trace' => 1)); 
	
	//print_r($result);exit;
	//echo $result;exit;
	
	//foreach($result)
	
	/*$soap["cod_imb"]
	$soap["tipo"]
	$soap["pret"]
	$soap["finalidade"]
	$soap["financiamento"]
	$soap["endereco"]
	$soap["cidade"]
	$soap["uf"]
	$soap["bairro"]
	$soap["cep"]
	$soap["garagem"]
	$soap["dorm"]
	$soap["banheiro"]
	$soap["area_total"]
	$soap["area_construida"]
	$soap["valor_imovel"]
	$soap["pagacond"]
	$soap["valor_cond"]
	$soap["sala"]
	$soap["descricao"]
	$soap["quartoemp"]
	$soap["suite"]
	$soap["piscina"]
	$soap["cod_jb"]
	$soap["exclusividade"]
	$soap["oportunidade"]
	$soap["destaque"]
	$soap["area_util"]
	$soap["condfechado"]
	$soap["foto"]
	$soap["miniatura"]
	$soap["tipocat"]
	$soap["elevadores"]
	$soap["n_andares"]
	$soap["data_atualizado"]
	$soap["local_chave"]
	$soap["valor_iptu"]
	$soap["data_exclusividade"]
	$soap["data_exclusividade_final"]
	$soap["area_mezanino"]
	$soap["dimensao_terreno"]
	$soap["metros_terreno"]
	$soap["metragem_terreno"]
	$soap["face_imovel"]
	$soap["isolamento_imovel"]
	$soap["local_isolamento"]
	$soap["nome_cond"]
	$soap["chamada"]
	$soap["numero"]
	$soap["complemento"]
	$soap["tour"]
	$soap["area"]
	$soap["nome_cond"]	*/
	
	
?>

    <?php /*
        //Data, connection, auth
        $dataFromTheForm = "123";//$_POST['fieldName']; // request data from the form
        $soapUrl = "http://www.centrina.com.br/WSConsumoPortal/Service.asmx?op=getListaImoveis"; // asmx URL of WSDL
        $soapUser = 1390;  //  username
        $soapPassword = "NE1390"; // password

        // xml post structure

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
							<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
							  <soap:Body>
								<getListaImoveis xmlns="http://www.centrina.com.br/">
								  <fkempresa>'.$soapUser.'</fkempresa>
								  <senha>'.$soapPassword.'</senha>
								  <campos></campos>
								  <regras></regras>
								</getListaImoveis>
							  </soap:Body>
							</soap:Envelope>';   // data from the form, e.g. some ID number

           $headers = array(
                        "POST /WSConsumoPortal/Service.asmx HTTP/1.1",
                        "Host: www.centrina.com.br",
                        "Content-Type: text/xml; charset=utf-8",
                        "Content-Length: ".strlen($xml_post_string),
                        "SOAPAction: 'http://www.centrina.com.br/getListaImoveis'"
                        
                    ); //SOAPAction: your op URL
            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            $response = curl_exec($ch); 
            curl_close($ch);

            // converting
            $response1 = str_replace("<soap:Body>","",$response);
            $response2 = str_replace("</soap:Body>","",$response1);

            // convertingc to XML
            $parser = simplexml_load_string($response2);
            // user $parser to get your data out of XML response and to display it.  


*/

    ?>z