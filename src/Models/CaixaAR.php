<?php

namespace Carta\Models;

use Carta\Enums\Permissao;
use Carta\Enums\Situacao;

class CaixaAR
{

    public function __construct
    (
        public readonly int $numeroCaixa,
        public readonly string $siglaCliente,
        public readonly string $nomeCliente,
        public readonly int $loteClienteInicial,
        public readonly int $loteClienteFinal,
        public readonly int $quantidadeLotes,
        public readonly int $quantidadeObjetos,
        public readonly Situacao $situacao,
        public readonly Permissao $gerarEtiqueta

    ) {}

    public static function fromArray(array $dados): self {
        
        return new self(
            numeroCaixa: $dados[0]->numero_caixa,
            siglaCliente: $dados[0]->sigla_cliente,
            nomeCliente: $dados[0]->nome_cliente,
            loteClienteInicial: $dados[0]->lote_cliente_inicial,
            loteClienteFinal: $dados[0]->lote_cliente_final,
            quantidadeLotes: $dados[0]->quantidade_lotes,
            quantidadeObjetos: $dados[0]->quantidade_objetos,
            situacao: Situacao::from($dados[0]->situacao),
            gerarEtiqueta: Permissao::tryFrom($dados[0]->gerar_etiqueta ?? '') ?? Permissao::NAO

        );
    }
}


?>