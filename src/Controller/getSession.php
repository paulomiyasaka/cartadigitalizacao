<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Utils\GetSession;

$matricula = $_POST['matricula'] ?? '';

$retorno = ['resultado' => false, 'sessao' => null];

if (strlen($matricula) === 8) {
    
    $sessao = new GetSession();
    $usuario = $sessao->retonarSessao();
    
    if($usuario['usuario_logado']) {
        $retorno['resultado'] = TRUE;
        $retorno['sessao'] = $usuario;
    }
}

echo json_encode($retorno);

?>