<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
use Carta\Models\NumeroCarta;

class ConsultarNumeroCarta{

	protected int $codigoCaixa;

	public function __construct(int $codigoCaixa)
	{

		$this->codigoCaixa = $codigoCaixa;
		//return $this->consultar();
	}

	public function consultar(): ?NumeroCarta
	{

		$codigoCaixa = $this->codigoCaixa;
		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT 
		c.numero_carta,
		c.ano, 
		c.mcu_origem, 
		c.numero_caixa, 
		c.sigla_cliente,
		c.data_carta_gerada,
		c.sigla_se_armazenamento
		FROM tb_carta as c 
		WHERE c.numero_caixa = :numero_caixa 
		ORDER BY c.numero_carta DESC LIMIT 1";

		$dados = array(":numero_caixa" => $codigoCaixa);
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
        if (empty($resultado)) {
            return null;
        }

        return NumeroCarta::fromArray($resultado);		

	}




}



?>