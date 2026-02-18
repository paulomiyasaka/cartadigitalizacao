<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Services\ConsultarRemetente;
use Carta\Services\ConsultarDestinatarios;
use Carta\Services\ConsultarEmbalagens;
use Carta\Services\GerarPlanilhaEtiqueta;

//$dadosEtiqueta = $_POST['etiqueta'] ?? '';
$dadosEtiqueta = json_decode($_POST['etiqueta'], true);
$seOrigem = $_POST['origem'];

$dadosComplementares = [];
$dadosComplementares['codigoServico'] = "44172";//PAC
$dadosComplementares['tipoObjeto'] = '';
$dadosComplementares['peso'] = 1;
$dadosComplementares['altura'] = 0;
$dadosComplementares['largura'] = 0;
$dadosComplementares['comprimento'] = 0;
$dadosComplementares['observacao'] = '';
$dadosComplementares['itemDeclaracao'] = 'AR';
$dadosComplementares['quantidade'] = 0;
$dadosComplementares['valor'] = 1;
$dadosComplementares['prazoPostagem'] = 7;
$dadosComplementares['etiqueta'] = $dadosEtiqueta;

$retorno = $dadosComplementares;

if (count($dadosEtiqueta) >= 1) {
    
    $consultar = new ConsultarRemetente($seOrigem);
    $listaRemetente = $consultar->consultar();

    //var_dump($listaRemetente);
    //exit;
    if(count(get_object_vars($listaRemetente)) >= 1) {
        $consultaDestinatarios = new ConsultarDestinatarios();
        $listaDestinatarios = $consultaDestinatarios->consultar();
        
        if(count($listaDestinatarios) >= 1) {  
            $mapa = [];
            foreach ($listaDestinatarios as $obj) {
                $mapa[$obj->siglaSe] = $obj;
            }

            // 2. No loop das etiquetas, você acessa direto
            foreach ($dadosEtiqueta as $item) {
                $sigla = $item['destinatario'];

                if (isset($mapa[$sigla])) {
                    $destino = $mapa[$sigla];
                    
                    // Agora você tem tudo na mão:
                    // $destino->logradouro (Dados fixos do objeto)
                    // $item['quantidade'] (Dados dinâmicos do formulário)
                    
                    //echo "Enviar para: " . $destino->nomeGestorAR . " | Qtd: " . $item['quantidade'];
                }
            }

            $retorno['resultado'] = TRUE;
            $retorno['caixa'] = $destino;        
        }
    
    }

}

echo json_encode($retorno);

?>