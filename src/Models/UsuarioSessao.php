<?php

namespace Carta\Models;

class UsuarioLogin
{

    public function __construct
    (
        public readonly int $matricula,
        public readonly string $nome,
        public readonly string $se,
        public readonly string $perfil,
        public readonly string $usuarioLogado,
        public readonly string $time
    ) {}

    public static function fromArray(array $dados): self {
        
        return new self(
            matricula: $dados[0]->matricula,
            nome: $dados[0]->nome,
            se: $dados[0]->sigla_se,
            perfil: $dados[0]->perfil,
            usuarioLogado: $dados[0]->usuario_logado,
            hora_login: $dados[0]->hora_login

        );
    }
}


?>