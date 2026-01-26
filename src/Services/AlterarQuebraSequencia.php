<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
use Carta\Models\CaixaAR;

class AlterarQuebraSequencia{

	protected int $numeroCaixa;
	protected string $quebraSequencia;

	public function __construct(int $numeroCaixa, string $quebraSequencia)
	{

		$this->numeroCaixa = $numeroCaixa;
		$this->quebraSequencia = $quebraSequencia;
	}

	public function alterar(): bool
	{

		$numeroCaixa = $this->numeroCaixa;
		$quebraSequencia = $this->quebraSequencia;
		$funcoesSQL = new funcoesSQL();
		$sql = "UPDATE 
			tb_armazenamento_ar as a
			SET a.quebra_sequencia = :quebra_sequencia 
			WHERE a.numero_caixa = :numero_caixa";

		$dados = array(":numero_caixa" => $numeroCaixa, ":quebra_sequencia" => $quebraSequencia);
		$resultado = $funcoesSQL->SQL($sql, $dados);
		return $resultado;
		

	}




}



?>