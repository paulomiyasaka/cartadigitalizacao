  <div class="container">
    <div class="row justify-content-center align-middle p-5">
      <div class="col-4 text-center">
        <h2 class="p-3">Gerar Cartas de Devolução</h2>
        <form method="post">
          <div class="text-center">
            <!-- <input type="number" id="numero_caixa" name="numero_caixa" class="form-control text-center" aria-describedby="CaixaHelpBlock" required> -->
            <div class="form-check">
            <input type="number" id="codigo_caixa" name="codigo_caixa" class="text-center form-control" maxlength="5" autocomplete="off" aria-describedby="CaixaHelpBlock" autofocus required>
            <div id="CaixaHelpBlock" class="form-text">
              Informe os dígitos da caixa no campo acima.<br>
              É necessário ter realizado a conferência.
            </div>
          </div>
            <div id="btns_conferencia" class="form-check d-flex invisible" >
              <button type="button" class="btn btn-danger m-1">Solicitar Correção</button>
               
              <button type="button" class="btn btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#form_modal_quebra_sequencia">Alterar Quebra de Sequência</button>              

              <button type="submit" class="btn btn-outline-primary m-1">Confirmar e gerar carta</button> 
              
              <button type="button" class="btn btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#form_modal_corrigir">Corrigir Informações</button> 
            </div>     


          </div>  
        </form> 
    
      </div>
    </div>    
  </div>