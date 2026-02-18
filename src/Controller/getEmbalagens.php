<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Utils\GetEmbalagens;

$retorno = ['resultado' => false, 'embalagens' => null];
    
$getEmbalagens = new GetEmbalagens();
$embalagens = $getEmbalagens->consultar();



if ($embalagens) {
    $retorno = [
        'resultado' => true,
        'embalagens' => $embalagens
    ];
    
}

echo json_encode($retorno);

?>