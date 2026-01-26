<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Services\AlterarQuebraSequencia;

$codigo = $_POST['codigo_caixa'] ?? '';
$quebra = $_POST['alterar_quebra_sequencia'] ?? '';
$retorno = ['resultado' => false, 'caixa' => null];

if (strlen($codigo) === 5) {
    
    //$consultarCaixa = new ConsultarCaixa($codigo);
    $alterar = new AlterarQuebraSequencia($codigo, $quebra);
    $resultado = $alterar->alterar();
    //echo json_encode($consultarCaixa);
    //var_dump($consultarCaixa);
    //exit;
    if($resultado) {
        $consulta = new ConsultarCaixa($codigo);
        $consultarCaixa = $consulta->consultar();
        if($consultarCaixa !== NULL) {
            $retorno['resultado'] = TRUE;
            $retorno['caixa'] = $consultarCaixa;
        }
    }
}

echo json_encode($retorno);

?>