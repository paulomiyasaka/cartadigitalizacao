<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
use Carta\Models\EmbalagemAR;

class ConsultarEmbalagens{

	public function consultar(): array
	{

		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT 
			e.embalagem, 
			e.altura,
			e.largura,
			e.comprimento 
			FROM tb_embalagens as e
			ORDER BY e.embalagem ASC";

		$dados = array();
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
        
        if (empty($resultado)) {
            return null;
        }

        return EmbalagemAR::fromArray($resultado);
		

	}




}



?>