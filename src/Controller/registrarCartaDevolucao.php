<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Services\GerarCartaDevolucao;
use Carta\Services\ConsultarCaixa;
use Carta\Services\ConsultarOrigem;

$codigo = $_POST['codigo_caixa'] ?? '';

$retorno = ['resultado' => false, 'caixa' => null];

if (strlen($codigo) === 5) {
    
    $origem = new ConsultarOrigem($codigo);
    
    $origem = $origem->consultar();

    if($origem){
        $ano = date('Y');
        $mcuOrigem = $origem->mcuOrigem;
        $siglaSeArmazenamento = $origem->siglaSeArmazenamento;
        $siglaCliente = $origem->siglaCliente;
        $dataCartaGerada = date('Y-m-d');
        $gerarCarta = new GerarCartaDevolucao($codigo, $ano, $mcuOrigem, $siglaCliente, $siglaSeArmazenamento, $dataCartaGerada);
        
        //echo json_encode($consultarCaixa);
        //var_dump($resultado);
        //exit;
        if($gerarCarta) {
            $resultado = $gerarCarta->gerar();
            $consulta = new ConsultarCaixa($codigo);
            $consultarCaixa = $consulta->consultar();
            if($consultarCaixa !== NULL) {
                $retorno['resultado'] = TRUE;
                $retorno['caixa'] = $consultarCaixa;
            }
        }
    }
    
}

echo json_encode($retorno);

?>