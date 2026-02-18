<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
use Carta\Models\DestinatarioAR;

class ConsultarDestinatarios{

	public function consultar(): array
	{

		//$codigoCaixa = $this->codigoCaixa;
		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT 
		dest.matricula, 
		dest.nome,
		dest.sigla_se, 
		dest.unidade,
		dest.logradouro,
		dest.numero,
		dest.complemento,
		dest.bairro,
		dest.cidade,
		dest.uf,
		dest.cep 
		FROM tb_gestor_ar as dest 
		ORDER BY dest.sigla_se ASC";

		$dados = array();
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
        if (empty($resultado)) {
            return null;
        }

        //return DestinatarioAR::fromArray($resultado);        

        $listaDTO = array_map(function($itemIndividual) {
            return DestinatarioAR::fromObject($itemIndividual);
        }, $resultado);

        return $listaDTO;
		

	}




}



?>