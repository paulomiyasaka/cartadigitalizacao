<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit(); 
}


?>

<!doctype html>
<html lang="pt-BR">

<?php
include 'header.php';

include 'menuTop.php';
?>

 <body>
  
<?php
include 'view/conteudoConferir.php';
include 'view/modalResposta.php';

include 'footer.php';
?>
<script type="module" src="js/consultarCaixa.js"></script>

  </body>
</html>