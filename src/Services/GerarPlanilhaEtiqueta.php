<?php

namespace Carta\Services;

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carta\Services\ConsultarDestinatarios;
use Carta\Models\OrigemAR;
use Carta\Models\DestinatarioAR;

class GerarPlanilhaEtiqueta {
    private OrigemAR $remetente; 
    private DestinatarioAR $listaDestinatarios;
    private array $dadosComplementares;
    private string $diretorioSaida = '../../planilhaEtiquetas/';

    public function __construct($Remetente, $ListaDestinatarios, $DadosComplementares) {
        
        $this->remetente = $Remetente;
        $this->listaDestinatarios = $ListaDestinatarios;
        $this->dadosComplementares = $DadosComplementares;

        if (!file_exists($this->diretorioSaida)) {
            mkdir($this->diretorioSaida, 0777, true);
        }
    }//construtor

    public function processar() {
        $this->limparArquivosAntigos();
        $remetente = $this->remetente;
        $listaDestinatarios = $this->listaDestinatarios;
        $dadosComplementares = $this->dadosComplementares;

        $caminhoArquivo = $this->gerarPlanilha($remetente, $listaDestinatarios, $dadosComplementares);
        if($caminhoArquivo){
            if($this->downloadArquivo($caminhoArquivo)){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
        
    }//processar


    private function gerarPlanilha($remetente, $listaDestinatarios, $dadosComplementares) {
        // 1. Limpeza de segurança (arquivos > 12h)
        $this->limparArquivosAntigos();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 2. Definição do Cabeçalho Conforme sua solicitação
        $cabecalho = [
            'remetente', 'cnpj_remetente', 'cep_remetente', 'logradouro_remetente', 'numero_remetente', 
            'complemento_remetente', 'bairro_remetente', 'cidade_remetente', 'uf_remetente',
            'destinatario', 'cnpj_destinatario', 'cep_destinatario', 'logradouro_destinatario', 
            'numero_destinatario', 'complemento_destinatario', 'bairro_destinatario', 
            'cidade_destinatario', 'uf_destinatario', 'codigo_servico', 'tipo_objeto', 
            'peso', 'altura', 'largura', 'comprimento', 'observacao', 
            'item_declaracao_conteudo', 'valor', 'copias'
        ];

        // Aplica o cabeçalho na linha 1
        $col = 'A';
        foreach ($cabecalho as $titulo) {
            $sheet->setCellValue($col . '1', $titulo);
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }

        $linha = 2;
        // Faz o loop para cada destinatário informado
        foreach ($ListaDestinatarios as $Destinatario) {
            $sheet->setCellValue('A' . $linha, $Remetente->nome);
            $sheet->setCellValue('B' . $linha, $Remetente->cnpj);
            $sheet->setCellValue('C' . $linha, $Remetente->cep);
            $sheet->setCellValue('D' . $linha, $Remetente->logradouro);
            $sheet->setCellValue('E' . $linha, $Remetente->numero);
            $sheet->setCellValue('F' . $linha, $Remetente->complemento);
            $sheet->setCellValue('G' . $linha, $Remetente->bairro);
            $sheet->setCellValue('H' . $linha, $Remetente->cidade);
            $sheet->setCellValue('I' . $linha, $Remetente->uf);

            $sheet->setCellValue('J' . $linha, $Destinatario->nome);
            $sheet->setCellValue('K' . $linha, $Destinatario->cnpj);
            $sheet->setCellValue('L' . $linha, $Destinatario->cep);
            $sheet->setCellValue('M' . $linha, $Destinatario->logradouro);
            $sheet->setCellValue('N' . $linha, $Destinatario->numero);
            $sheet->setCellValue('O' . $linha, $Destinatario->complemento);
            $sheet->setCellValue('P' . $linha, $Destinatario->bairro);
            $sheet->setCellValue('Q' . $linha, $Destinatario->cidade);
            $sheet->setCellValue('R' . $linha, $Destinatario->uf);

            $sheet->setCellValue('S' . $linha, $DadosComplementares->codigoServico);
            $sheet->setCellValue('T' . $linha, $DadosComplementares->tipoObjeto);
            $sheet->setCellValue('U' . $linha, $DadosComplementares->peso);
            $sheet->setCellValue('V' . $linha, $EmbalagemAR->altura);
            $sheet->setCellValue('W' . $linha, $EmbalagemAR->largura);
            $sheet->setCellValue('X' . $linha, $EmbalagemAR->comprimento);
            $sheet->setCellValue('Y' . $linha, $DadosComplementares->observacao);
            $sheet->setCellValue('Z' . $linha, $DadosComplementares->itemDeclaracao);
            $sheet->setCellValue('AA' . $linha, $DadosComplementares->quantidade);
            $sheet->setCellValue('AB' . $linha, $DadosComplementares->valor);
            $sheet->setCellValue('AC' . $linha, $DadosComplementares->prazoPostagem);
            $sheet->setCellValue('AD' . $linha, $Destinatario->copias);

            $linha++;
        }

        $nomeArquivo = $this->diretorioSaida . 'etiquetas_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        if($writer->save($nomeArquivo)){
            return $nomeArquivo;
        }else{
            return false;
        }

        
    }//gerarPlanilha

    private function limparArquivosAntigos() {
        $arquivos = glob($this->diretorioSaida . "*.xlsx");
        $tempoLimite = 12 * 3600; // 12 horas em segundos

        foreach ($arquivos as $arquivo) {
            if (time() - filemtime($arquivo) > $tempoLimite) {
                unlink($arquivo);
            }
        }
    }//limparArquivosAntigos

    private function downloadArquivo($caminho) {
        if (file_exists($caminho)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . basename($caminho) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($caminho));
            readfile($caminho);
            return true;
        }else{
            return false;
        }
    }//downloadArquivo

}
