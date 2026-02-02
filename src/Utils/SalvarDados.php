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

            if($dadosPlanilha = new LerPlanilha($nomeArquivo, $caminho)){
                $apagarPlanilha = new ApagarPlanilha($nomeArquivo, $caminho);
                $conecta = new FuncoesSQL();

                foreach ($dadosPlanilha as $linhas){

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
                            }//foreach
                            $preencherCabecalho = false;
                            //var_dump($parametroCabecalho);
                            //exit;
                        
                        }else{ //preencher cabecalho

                            $parametrosExplode = explode(",", $parametroCabecalho);
                            $cabecalhoExplode = explode(",", $cabecalho);

                            $funcoes = new Funcoes();
                            $quantidadeCelulas = count($celula);
                            
                            for($i=0; $i < $quantidadeCelulas; $i++){                                
                                
                                switch(gettype($celula[$i])){
                                    case "integer":
                                    case "double":
                                        $celula[$i] = $funcoes->somenteNumeros($celula[$i]);
                                        //echo $celula[$i]."<br>";
                                        break;

                                    case "string": 
                                        //$celula[$i] = $funcoes->maiuscula($funcoes->removerAcentuacao($celula[$i]));
                                        
                                        $dataConvertida = $this->formatarSeData($celula[$i]);
                                        if($dataConvertida){
                                            $celula[$i] = $dataConvertida;
                                            //die($celula[$i]);
                                            //echo $celula[$i]."<br>";
                                        }else{
                                            $celula[$i] = $funcoes->maiuscula($funcoes->removerAcentuacao($celula[$i]));
                                        }
                                        //echo $celula[$i];
                                        break;                                

                                    default: 
                                        $celula[$i] = "";
                                        break;
                                }//switch

                            } //for
                            
                            $dados = array_combine($parametrosExplode, $celula);
                            
                            $sql = "INSERT INTO {$tabela} ($cabecalho) VALUES ($parametroCabecalho)";
                            if(!$conecta->SQL($sql, $dados)){
                                //echo "Erro ao tentar salvar no banco de dados: ".$celula[0];
                                //return false;
                                $this->error = false;
                            }else{
                                $registrosSalvos++;
                            }

                        }//if preencher cabecalho
                        
                    }//foreach $linhas                           
                    
                }//foreach $dadosPlanilha                
                
                $this->registrosSalvos = $registrosSalvos;                             

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

    }//toString

   private function formatarSeData($valor)
   {
        // Verifica se é string, tem 10 caracteres e se as barras estão nos lugares certos (índice 2 e 5)
        //$valor = trim($valor);
        /*
        if(is_string($valor) && strlen($valor) === 10 && ($valor[2] === '/' || $valor[2] === '-') && ($valor[5] === '/' || $valor[5] === '-')){
            $dataObj = DateTime::createFromFormat('d/m/Y', $valor);
            // Verifica se a data é real (evita 31/02)
            if($dataObj && $dataObj->format('d/m/Y') === $valor){
                return $dataObj->format('Y-m-d');
            }
        }
        

        if(is_string($valor) && strlen($valor) === 10){
            $dataObj = DateTime::createFromFormat('d/m/Y', $valor);
            // Verifica se a data é real (evita 31/02)
            if($dataObj && $dataObj->format('d/m/Y') === $valor){
                return $dataObj->format('Y-m-d');
            }
        }
        */
        $dataConvertida = false;
        $dataOriginal = $valor;
        $dataTratada = str_replace('/', '-', $dataOriginal);
        $timestamp = strtotime($dataTratada);
        if($timestamp){
            $dataConvertida = date('Y-m-d', $timestamp);
        }       
        return $dataConvertida; // Não é uma data válida no formato dd/mm/aaaa
    }//formatar se data





}//class


?>