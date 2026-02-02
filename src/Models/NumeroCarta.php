<?php

namespace Carta\Models;

class NumeroCarta
{

    public function __construct
    (
        public readonly int $numeroCarta,
        public readonly int $ano,
        public readonly int $mcuOrigem,
        public readonly int $codigoCaixa,
        public readonly string $siglaCliente,
        public readonly string $dataCartaGerada,
        public readonly string $siglaSeArmazenamento
    ) {}

    public static function fromArray(array $dados): self 
    {
        
        return new self(
            numeroCarta: $dados[0]->numero_carta,
            ano: $dados[0]->ano,
            mcuOrigem: $dados[0]->mcu_origem,
            codigoCaixa: $dados[0]->numero_caixa,
            siglaCliente: $dados[0]->sigla_cliente, 
            dataCartaGerada: $dados[0]->data_carta_gerada,
            siglaSeArmazenamento: $dados[0]->sigla_se_armazenamento           

        );
    }


}


?>