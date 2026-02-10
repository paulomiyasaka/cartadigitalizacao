<?php

namespace Carta\Models;

class DestinatarioAR
{

    public function __construct
    (
        public readonly int $matriculaGestorAR,
        public readonly string $nomeGestorAR,
        public readonly string $siglaSe,
        public readonly string $unidade,
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
            matriculaGestorAR: $dados[0]->matricula,
            nomeGestorAR: $dados[0]->nome,
            siglaSe: $dados[0]->sigla_se,
            unidade: $dados[0]->unidade,
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