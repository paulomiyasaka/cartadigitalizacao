<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digitalização CDIP</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    
  </head>
  <body>

    <nav class="navbar bg-body-tertiary">
      <div class="container">
          <img src="img/NCorreios_hori_cor_pos.png" alt="Correios" class="logo d-inline-block">
          <h3 class="float">Gerar Cartas Para a Devolução de ARs Físicos</h3>
      </div>      
    </nav>

  <div class="container">
    <div class="row justify-content-center align-middle p-5">
      <div class="col-4 text-center">
        <form>
          <div class="mb-3 text-center">
          <label for="formFile" class="form-label ">Selecionar planilha tipo .CSV</label>
          <input class="form-control" type="file" id="formFile" accept=".csv">
        </div>
          <button type="submit" class="btn btn-outline-success">Gerar Cartas</button>
        </form>        
      </div>
    </div>    
  </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>