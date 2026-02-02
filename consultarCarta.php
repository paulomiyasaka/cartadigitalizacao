<!doctype html>
<html lang="pt-BR">

<?php
include 'vendor/autoload.php';

$caixa = false;
if(isset($_GET['caixa']) AND $_GET['caixa'] !== ''){
  $caixa = $_GET['caixa'];
}

?>

<body>
  <div id="conteudo-html"></div>
<?php

include 'scripts.html';
?>

<script type="module" src="js/consultarCarta.js"></script>
  </body>
</html>