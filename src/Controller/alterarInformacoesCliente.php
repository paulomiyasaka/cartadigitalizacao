<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Services\AlterarInformacoesCliente;
use Carta\Services\ConsultarCaixa;

$codigo = $_POST['codigo_caixa'] ?? '';
$siglaCliente = $_POST['sigla_cliente'] ?? '';
$armazenar = $_POST['corrigir_armazenar'] ?? '';
$prazoArmazenar = $_POST['corrigir_prazo_armazenamento'] ?? '';
$fragmentar = $_POST['corrigir_fragmentar'] ?? '';

$retorno = ['resultado' => false, 'caixa' => null];

if (strlen($codigo) === 5) {
    
    //$consultarCaixa = new ConsultarCaixa($codigo);
    $alterar = new AlterarInformacoesCliente($siglaCliente, $armazenar, $prazoArmazenar, $fragmentar);
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