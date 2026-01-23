<?php

namespace Carta\Utils;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
use Carta\Models\CaixaAR;

class ConsultarCaixa{

	protected int $numeroCaixa;

	public function __construct(int $numeroCaixa)
	{

		$this->numeroCaixa = $numeroCaixa;
		//return $this->consultar();
	}

	public function consultar(): ?CaixaAR
	{

		$numeroCaixa = $this->numeroCaixa;
		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT ar.numero_caixa, ar.sigla_cliente, c.nome as nome_cliente, ar.quantidade_lotes, ar.quantidade_objetos, ar.lote_cliente_inicial, ar.lote_cliente_final, ar.situacao, ar.gerar_etiqueta FROM tb_armazenamento_ar as ar LEFT JOIN tb_cliente as c ON c.sigla_cliente = ar.sigla_cliente WHERE ar.numero_caixa = :numero_caixa";

		$dados = array(":numero_caixa" => $numeroCaixa);
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
		// Se o banco não retornar nada, retornamos null
		//var_dump($resultado);
		//echo $sql;
        //exit;
        if (empty($resultado)) {
            return null;
        }

        // Se retornou, transformamos o array de 18+ campos em um Objeto DTO
        return CaixaAR::fromArray($resultado);
        //return $resultado;
		

	}




}



?>