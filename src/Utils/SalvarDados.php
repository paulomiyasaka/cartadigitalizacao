<?php

namespace Carta\Utils;

require '../../vendor/autoload.php';

use Carta\Utils\UploadPlanilha; 
use Carta\Utils\LerPlanilha;
use Carta\Utils\Funcoes;
use Carta\Utils\ApagarPlanilha;
use Carta\Database\FuncoesSQL;

class SalvarDados
{	
	private string $nomeArquivo;
	private string $nomeArquivoTemporario;
	private string $caminho;
    private bool $error;   
    private int $registrosSalvos; 
	
	public function __construct(string $nomeArquivo, string $nomeArquivoTemporario, string $caminho)
	{

    	$this->nomeArquivo = $nomeArquivo;
    	$this->nomeArquivoTemporario = $nomeArquivoTemporario;
    	$this->caminho = $caminho;

        //Deverá ser alterado para false quando ocorrer erro
        //retornar false no método __toString()
        $this->error = true;
    	$this->salvar();
		
	}

	private function salvar()
	{

	$nomeArquivo = $this->nomeArquivo;
	$nomeArquivoTemporario = $this->nomeArquivoTemporario;
	$caminho = $this->caminho;
    //remover a extensão .xslx do nome do arquivo.
    $tabela = explode(".", $nomeArquivo);
    $tabela = $tabela[0];

	$planilha = new UploadPlanilha($nomeArquivo, $nomeArquivoTemporario, $caminho);

    $registrosSalvos = 0;
    $preencherCabecalho = true;
    $dados = [];

    if($planilha){
        //$dadosPlanilha = new LerPlanilha($nomeArquivo, UPLOAD_DIR);        

        if($dadosPlanilha = new LerPlanilha($nomeArquivo, $caminho)){
            //echo "Aqui";
            //var_dump($dadosPlanilha);
            $apagarPlanilha = new ApagarPlanilha($nomeArquivo, $caminho);
            $conecta = new FuncoesSQL();

            foreach ($dadosPlanilha as $linhas) {

                foreach ($linhas as $celula) {                    

                    if($preencherCabecalho){
                        $cabecalho = "";
                        $parametroCabecalho = "";

                        foreach ($celula as $valor) {
                            //array_push($cabecalho, $valor);
                            if($cabecalho == ""){
                                $cabecalho = strtolower($valor);
                                $parametroCabecalho = ":".strtolower($valor);
                            }else{
                                $cabecalho .= ",".strtolower($valor);
                                $parametroCabecalho .= ",:".strtolower($valor);
                            }
                        }
                        $preencherCabecalho = false;
                        //var_dump($parametroCabecalho);
                        //exit;
                    
                    }else{

                        $parametrosExplode = explode(",", $parametroCabecalho);
                        $cabecalhoExplode = explode(",", $cabecalho);

                        $funcoes = new Funcoes();
                        $quantidadeCelulas = count($celula);
                        
                        for ($i=0; $i < $quantidadeCelulas; $i++) {                                
                            
                            switch (gettype($celula[$i])) {
                                case "integer":
                                case "double":
                                    $celula[$i] = $funcoes->somenteNumeros($celula[$i]);
                                    //echo $celula[$i]."<br>";
                                    break;

                                case "string": 
                                    $celula[$i] = $funcoes->maiuscula($funcoes->removerAcentuacao($celula[$i]));
                                    //echo $celula[$i]."<br>";
                                    break;                                

                                case "NULL":
                                case "unknown type":
                                default: $celula[$i] = "";
                            }

                        }
                        
                        $dados = array_combine($parametrosExplode, $celula);
                        
                        $sql = "INSERT INTO {$tabela} ($cabecalho) VALUES ($parametroCabecalho)";
                        if(!$conecta->SQL($sql, $dados)){
                            //echo "Erro ao tentar salvar no banco de dados: ".$celula[0];
                            //return false;
                            $this->error = false;
                        }else{
                            $registrosSalvos++;
                        }

                    }

                    
                }//foreach $linhas
                           
                
            }//foreach $dadosPlanilha

            
            
            $this->registrosSalvos = $registrosSalvos;
            //echo "Arquivo excluído: ".$nomeArquivo;
            //echo "Linhas registradas: ".$registrosSalvos;                
            
            

        }else{ //ler o arquivo do upload
            echo "Não foi possível ler o arquivo: ".UPLOAD_DIR."/".$nomeArquivo;
            //return false;
            $this->error = false;
        }

    
    }else{
        echo "Erro ao tentar fazer o upload do arquivo.";
        //return false;
        $this->error = false;

    }//UPLOAD DO ARQUIVO


	}//function salvar()

    public function __toString():string
    {   
        
        if(!$this->error AND $this->error != NULL){
            return (string) $this->error;
        }else{
            return (string) $this->registrosSalvos;
        }

    }



}//class


?>