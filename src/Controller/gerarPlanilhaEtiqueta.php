<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

use Carta\Services\ConsultarRemetente;
use Carta\Services\ConsultarDestinatarios;
use Carta\Services\ConsultarEmbalagens;
use Carta\Services\GerarPlanilhaEtiqueta;
use \DateTimeImmutable;

//$dadosEtiqueta = $_POST['etiqueta'] ?? '';
$dadosEtiqueta = json_decode($_POST['etiqueta'], true);
$seOrigem = $_POST['origem'];
date_default_timezone_set('America/Sao_Paulo');
$data = new DateTimeImmutable();
$validade = $data->modify('+7 days');

$etiqueta = [];
$montaEtiqueta = [];
$dadosComplementares = [];
$dadosComplementares['codigoServico'] = "44172";//PAC
$dadosComplementares['tipoObjeto'] = '';
$dadosComplementares['peso'] = 1;
$dadosComplementares['altura'] = 0;
$dadosComplementares['largura'] = 0;
$dadosComplementares['comprimento'] = 0;
$dadosComplementares['observacao'] = '';
$dadosComplementares['itemDeclaracao'] = 'AR';
$dadosComplementares['copias'] = 0;
$dadosComplementares['valor'] = 1.00;
$dadosComplementares['prazoPostagem'] = $validade->format('d/m/Y');
//$dadosComplementares['etiqueta'] = $dadosEtiqueta;

if (count($dadosEtiqueta) >= 1) {
    
    $consultar = new ConsultarRemetente($seOrigem);
    $listaRemetente = $consultar->consultar();

    //var_dump($listaRemetente);
    //exit;
    if(count(get_object_vars($listaRemetente)) >= 1) {
        $consultaDestinatarios = new ConsultarDestinatarios();
        $listaDestinatarios = $consultaDestinatarios->consultar();
        
        if(count($listaDestinatarios) >= 1) {  
            $destinatarios = [];
            foreach ($listaDestinatarios as $obj) {
                $destinatarios[$obj->siglaSe] = $obj;
            }

            $indice = 0;
            foreach ($dadosEtiqueta as $dadosEtiq) {
                $sigla = $dadosEtiq['destinatario'];
                $embalagem = explode('x', $dadosEtiq['embalagem']);
                $dadosComplementares['altura'] = $embalagem[0];
                $dadosComplementares['largura'] = $embalagem[1];
                $dadosComplementares['comprimento'] = $embalagem[2];
                $dadosComplementares['copias'] = (int)$dadosEtiq['quantidade'];                

                if (isset($destinatarios[$sigla])) {
                    $destino = $destinatarios[$sigla];
                }

                $etiqueta['remetente'] = $listaRemetente;
                $etiqueta['destinatario'] = $destino;
                $etiqueta['dadosComplementares'] = $dadosComplementares;

                $montaEtiqueta[$indice++] = $etiqueta;

            }//foreach

            $gerarEtiqueta = new GerarPlanilhaEtiqueta($listaRemetente, $destino, $dadosComplementares);
            $gerarEtiqueta->processar();

            $retorno['resultado'] = TRUE;
            $retorno['etiqueta'] = $montaEtiqueta;
                    
        }
    
    }

}

echo json_encode($retorno);

?>