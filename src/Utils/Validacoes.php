<?php

namespace Carta\Utils;

class Validacoes
{

	public function validar(){
		$this->interromperReenvioFormulario();
		$this->verificarUsuarioLogado();
	}


	public static function interromperReenvioFormulario(): void 
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		    header("Location: " . $_SERVER['PHP_SELF']);
		    exit(); 
		}
	
	}


	public function verificarUsuarioLogado(): void 
	{
		session_start();
			if(!isset($_SESSION['usuario_logado']) AND $_SESSION['usuario_logado'] !== TRUE){
				session_destroy();
			    
			header("Location: login.php");
			exit();
		}

	}


	public function limparArquivosAntigos($caminho) {
        $arquivos = glob($caminho . "*.xlsx");
        $tempoLimite = 12 * 3600; // horas em segundos

        foreach ($arquivos as $arquivo) {
            if (time() - filemtime($arquivo) > $tempoLimite) {
                unlink($arquivo);
            }
        }
    }//limparArquivosAntigos



}


?>