<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Services\ConsultarRemetente;
use Carta\Services\ConsultarDestinatarios;
use Carta\Services\GerarPlanilhaEtiqueta;

$destinatarios = $_POST['destinatarios'] ?? '';
$remetente = $_POST['remetente'] ?? '';
$quantidadeEtiquetas = $_POST['quantidade_etiqueta'] ?? '';
$retorno = ['resultado' => false, 'etiqueta' => null];

if (count($destinatarios) >= 1) {
    
    $consultar = new ConsultarRemetente($remetente);
    $listaRemetente = $consultar->consultar();

    if(count($listaRemetente) === 1) {
        $consultaDestinatarios = new ConsultarDestinatarios();
        $listaDestinatarios = $consultaDestinatarios->consultar();
        
        if(count($listaDestinatarios) >= 1) {

            //CONTINUAR DAQUI PARA
            //GERAR OS DADOS COMPLEMENTARES DA ETIQUETA
            $dadosComplementares = NULL;
            $gerarPlanilha = new GerarPlanilhaEtiqueta($listaRemetente, $listaDestinatarios, $dadosComplementares);

            $retorno['resultado'] = TRUE;
            $retorno['caixa'] = $consultarCaixa;

        }
    }
}

echo json_encode($retorno);

?>