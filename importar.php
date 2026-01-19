<?php
require 'vendor/autoload.php';

use Carta\UploadPlanilha;
use Carta\LerPlanilha;
use Carta\Conecta;

const LISTA_CLIENTES = "clientes/clientes_cadastrados.xlsx";
const UPLOAD_DIR = "uploads";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    //return 'Método não permitido.';
    return false;
}


if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo 'Arquivo não localizado.';
    return false;

}else{
        
    $nomeArquivo = $_FILES['file']['name'];
    $nomeArquivoTemporario = $_FILES['file']['tmp_name'];

    $planilha = new UploadPlanilha($nomeArquivo, $nomeArquivoTemporario, UPLOAD_DIR);
    //$arquivos->__set('name', $_FILES['file']['name']);
    //$arquivos->__set('tmp_name',$_FILES['file']['tmp_name']);
    //$arquivos->__set('diretorio', UPLOAD_DIR);

    if($planilha){
        //$dadosPlanilha = new LerPlanilha($nomeArquivo, UPLOAD_DIR);
        

        if($dadosPlanilha = new LerPlanilha($nomeArquivo, UPLOAD_DIR)){
            //echo "Aqui";
            //var_dump($dadosPlanilha);
            $conecta = new Conecta();

            foreach ($dadosPlanilha as $key => $superintendencia) {

                $sql = "INSERT INTO `db_digitalizacao` (sigla_se, nome) VALUES (?,?)";
                $dados = array($superintendencia[0], $superintendencia[1]);
                $conecta->executarSQL();                
                
            }

            unlink($nomeArquivo);
            

        }else{ //ler o arquivo do upload
            echo "Não foi possível ler o arquivo: ".UPLOAD_DIR."/".$nomeArquivo;
            return false;
        }

    
    }else{
        echo "Erro ao tentar fazer o upload do arquivo.";
        return false;

    }//UPLOAD DO ARQUIVO

}//if $_FILES        
    








?>