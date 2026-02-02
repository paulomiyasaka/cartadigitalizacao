<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;

class GerarCartaDevolucao{

	protected int $numeroCaixa;
	protected int $ano;
	protected int $mcuOrigem;
	protected string $siglaCliente;
	protected string $siglaSeArmazenamento;
	protected string $dataCartaGerada;

	public function __construct(int $numeroCaixa, int $ano, int $mcuOrigem, string $siglaCliente, string $siglaSeArmazenamento, string $dataCartaGerada)
	{

		$this->numeroCaixa = $numeroCaixa;
		$this->ano = $ano;
		$this->mcuOrigem = $mcuOrigem;
		$this->siglaCliente = $siglaCliente;
		$this->siglaSeArmazenamento = $siglaSeArmazenamento;
		$this->dataCartaGerada = $dataCartaGerada;

	}

	public function gerar(): bool
	{

		$numeroCaixa = $this->numeroCaixa;
		$ano = $this->ano;
		$mcuOrigem = $this->mcuOrigem;
		$siglaCliente = $this->siglaCliente;
		$siglaSeArmazenamento = $this->siglaSeArmazenamento;
		$dataCartaGerada = $this->dataCartaGerada;

		$funcoesSQL = new funcoesSQL();
		$sql = "INSERT INTO tb_carta (ano, mcu_origem, numero_caixa, sigla_cliente, sigla_se_armazenamento, data_carta_gerada) VALUES (:ano, :mcuOrigem, :numeroCaixa, :siglaCliente, :siglaSeArmazenamento, :dataCartaGerada)";

		$dados = array(":ano" => $ano,":mcuOrigem" => $mcuOrigem, ":numeroCaixa" => $numeroCaixa, ":siglaCliente" => $siglaCliente, ":siglaSeArmazenamento" => $siglaSeArmazenamento, ":dataCartaGerada" => $dataCartaGerada);
		$resultado = $funcoesSQL->SQL($sql, $dados);
		return $resultado;
		

	}




}



?>