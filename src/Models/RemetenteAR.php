<?php

namespace Carta\Models;

class RemetenteAR
{

    public function __construct
    (
        public readonly string $siglaSe,
        public readonly int $mcuOrigem,
        public readonly string $unidade,
        public readonly int $matriculaGerente,
        public readonly string $nomeGerente,
        public readonly ?string $cnpj,
        public readonly string $logradouro,
        public readonly ?string $numero,
        public readonly ?string $complemento,
        public readonly string $bairro,
        public readonly string $cidade,
        public readonly string $uf,
        public readonly int $cep
    ) {}

    public static function fromArray(array $dados): self 
    {
        
        return new self(
            siglaSe: $dados[0]->sigla_se,
            mcuOrigem: $dados[0]->mcu_origem,
            unidade: $dados[0]->unidade,
            matriculaGerente: $dados[0]->matricula_gerente,
            nomeGerente: $dados[0]->nome_gerente,       
            cnpj: $dados[0]->cnpj,
            logradouro: $dados[0]->logradouro,
            numero: $dados[0]->numero,
            complemento: $dados[0]->complemento,
            bairro: $dados[0]->bairro,
            cidade: $dados[0]->cidade,
            uf: $dados[0]->uf,
            cep: $dados[0]->cep

        );
    }


}


?>