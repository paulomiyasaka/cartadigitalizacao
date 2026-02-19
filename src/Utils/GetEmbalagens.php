<?php

namespace Carta\Utils;

use Carta\Database\FuncoesSQL;
use Carta\Models\EmbalagemAR;

class GetEmbalagens{

	public function consultar(): array
	{

		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT 
			e.embalagem, 
			e.altura,
			e.largura,
			e.comprimento,
			CONCAT(
				e.embalagem, ' - A:', 
				REPLACE(TRIM(TRAILING '.0' FROM ROUND(altura, 1)), '.00', ''), ' x L:', 
				REPLACE(TRIM(TRAILING '.0' FROM ROUND(largura, 1)), '.00', ''), ' x C:',
				REPLACE(TRIM(TRAILING '.0' FROM ROUND(comprimento, 1)), '.00', '')) AS 
			embalagem_detalhada  
			FROM tb_embalagens as e
			ORDER BY e.embalagem ASC";

		$dados = array();
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
        
        $listaDTO = array_map(function($itemIndividual) {
            return EmbalagemAR::fromObject($itemIndividual);
        }, $resultado);

        return $listaDTO;
		

	}


	public function consultarEmbalagem($embalagem): EmbalagemAR
	{

		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT 
			e.embalagem, 
			e.altura,
			e.largura,
			e.comprimento,
			CONCAT(
				e.embalagem, ' - A:', 
				REPLACE(TRIM(TRAILING '.0' FROM ROUND(altura, 1)), '.00', ''), ' x L:', 
				REPLACE(TRIM(TRAILING '.0' FROM ROUND(largura, 1)), '.00', ''), ' x C:',
				REPLACE(TRIM(TRAILING '.0' FROM ROUND(comprimento, 1)), '.00', '')) AS 
			embalagem_detalhada 
			FROM tb_embalagens as e
			WHERE embalagem = :embalagem";

		$dados = array(":embalagem", $embalagem);
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
        
        return EmbalagemAR::fromArray($resultado);
		

	}


}



?>