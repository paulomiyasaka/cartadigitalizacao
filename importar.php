<?php
require 'vendor/autoload.php';

use Carta\Planilha;
use Carta\Arquivos;

const LISTA_CLIENTES = "clientes/clientes_cadastrados.xlsx";
const UPLOAD_DIR = "uploads";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    //return 'Método não permitido.';
    return false;
}


//try {

    //Carregar os dados da planilha de clientes cadastrados.
    $planilha = new Planilha();

        //se ler a planilha de clientes faz o upload da planilha de devolução  
        $upload = "";
        $nomeArquivo = "";

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            echo 'Arquivo não localizado.';
            return false;

        }else{
                
            $nomeArquivo = $_FILES['file']['name'];
            $nomeArquivoTemporario = $_FILES['file']['tmp_name'];
            $arquivos = new Arquivos();
            $arquivos->__set('name', $_FILES['file']['name']);
            $arquivos->__set('tmp_name',$_FILES['file']['tmp_name']);
            $arquivos->__set('diretorio', UPLOAD_DIR);

            if($upload = $arquivos->upload($nomeArquivo, $nomeArquivoTemporario)){
                
                if($devolucao = $planilha->ler(UPLOAD_DIR."/".$nomeArquivo)){
                    //echo "Aqui";
                    var_dump($devolucao);
                    unlink(UPLOAD_DIR."/".$nomeArquivo);


                }else{ //ler o arquivo do upload
                    echo "Não foi possível ler o arquivo: ".UPLOAD_DIR."/".$nomeArquivo;
                    return false;
                }

            
            }else{
                echo "Erro ao tentar fazer o upload do arquivo.";
                return false;

            }//UPLOAD DO ARQUIVO

        }//if $_FILES        
    

    //$pesquisaSigla = array_search()

    //var_dump($clientes);


/*

} catch (\Throwable $e) {
    echo 'Erro ao ler a planilha: ' . $e->getMessage();
    //return 'Erro ao ler a planilha: ' . $e->getMessage();
    return false;
    //exit;
}

*/









?>