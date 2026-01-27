<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;

class AlterarInformacoesCliente{

	protected string $siglaCliente;
	protected string $armazenar;
	protected int $prazoArmazenar;
	protected string $fragmentar;

	public function __construct(string $siglaCliente, string $armazenar, int $prazoArmazenar, string $fragmentar)
	{

		$this->siglaCliente = $siglaCliente;
		$this->armazenar = $armazenar;
		$this->prazoArmazenar = $prazoArmazenar;
		$this->fragmentar = $fragmentar;
	}

	public function alterar(): bool
	{

		$siglaCliente = $this->siglaCliente;
		$armazenar = $this->armazenar;
		$prazoArmazenar = $this->prazoArmazenar;
		$fragmentar = $this->fragmentar;		

		$funcoesSQL = new funcoesSQL();
		$sql = "UPDATE 
			tb_cliente as c
			SET c.armazenar = :armazenar,
			c.prazo_armazenamento = :prazo_armazenar,
			c.fragmentar = :fragmentar,
			c.corrigido = :corrigido 
			WHERE c.sigla_cliente = :sigla_cliente";

		$dados = array(":sigla_cliente" => $siglaCliente, ":armazenar" => $armazenar, ":prazo_armazenar" => $prazoArmazenar, ":fragmentar" => $fragmentar, ":corrigido" => "SIM");
		$resultado = $funcoesSQL->SQL($sql, $dados);
		return $resultado;
		

	}




}



?>