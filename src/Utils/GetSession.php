<?php

namespace Carta\Utils;

use Carta\Models\UsuarioSessao;

class GetSession
{

    public function retornarSessao(): ?UsuarioSessao
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['usuario_logado'])) {
            return null; 
        }

        $dados = [
            'matricula'      => $_SESSION['matricula'],
            'nome'           => $_SESSION['nome'],
            'se'     => $_SESSION['se_usuario'],
            'perfil' => $_SESSION['perfil_usuario'],
            'usuario_logado' => $_SESSION['usuario_logado'],
            'hora_login'     => $_SESSION['hora_login']
        ];

        // 3. O fromArray recebe o array pronto
        return UsuarioSessao::fromArray($dados);


    }



}

        
