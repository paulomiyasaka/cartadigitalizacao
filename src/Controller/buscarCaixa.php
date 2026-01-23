<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Utils\ConsultarCaixa;

$codigo = $_POST['codigo_caixa'] ?? '';
$retorno = ['resultado' => false, 'caixa' => null];

if (strlen($codigo) === 5) {
    
    //$consultarCaixa = new ConsultarCaixa($codigo);
    $consulta = new ConsultarCaixa($codigo);
    $consultarCaixa = $consulta->consultar();
    //echo json_encode($consultarCaixa);
    //var_dump($consultarCaixa);
    //exit;
    if($consultarCaixa !== NULL) {
        $retorno['resultado'] = TRUE;
        $retorno['caixa'] = $consultarCaixa;
    }
}

echo json_encode($retorno);

?>