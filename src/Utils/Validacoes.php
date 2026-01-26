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
			if(!isset($_SESSION['usuarioLogado']) AND $_SESSION['usuarioLogado'] !== TRUE){
				session_destroy();
			    
			header("Location: login.php");
			exit();
		}

	}



}


?>