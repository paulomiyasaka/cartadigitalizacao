<?php

namespace Carta\Models;

class EmbalagemAR
{

    public function __construct
    (
        public readonly string $embalagem,
        public readonly string $altura,
        public readonly string $largura,
        public readonly string $comprimento
    ) {}

    public static function fromObject(object $dados): self 
    {
        
        return new self(
            embalagem: $dados->embalagem,
            altura: $dados->altura,
            largura: $dados->largura,
            comprimento: $dados->comprimento

        );
    }


    public static function fromArray(array $dados): self 
    {
        
        return new self(
            embalagem: $dados[0]->embalagem,
            altura: $dados[0]->altura,
            largura: $dados[0]->largura,
            comprimento: $dados[0]->comprimento

        );
    }


}


?>