<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
use Carta\Models\RemetenteAR;

class ConsultarRemetente{

	protected string $remetente;

	public function __construct(string $remetente)
	{

		$this->remetente = $remetente;
		//return $this->consultar();
	}

	public function consultar(): ?RemetenteAR
	{

		$remetente = $this->remetente;
		$funcoesSQL = new funcoesSQL();
		$sql = "SELECT  
		ori.sigla_se,
		ori.mcu_origem, 
		ori.unidade, 
		ori.matricula_gerente, 
		u.nome as nome_gerente, 
		ori.cnpj,
		ori.logradouro,
		ori.numero,
		ori.complemento,
		ori.bairro,
		ori.cidade,
		ori.uf,
		ori.cep 
		FROM tb_endereco_origem as ori 
		JOIN tb_usuario as u 
		ON u.matricula = ori.matricula_gerente 
		AND u.matricula = ori.matricula_gerente 
		WHERE ori.sigla_se = :sigla_se";

		$dados = array(":sigla_se" => $remetente);
		$resultado = $funcoesSQL->fetchAllSQL($sql, $dados);
        if (empty($resultado)) {
            return null;
        }

        return RemetenteAR::fromArray($resultado);
		

	}




}



?>