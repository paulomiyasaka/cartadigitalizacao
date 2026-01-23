  <div class="container">

    <div class="row justify-content-center align-middle p-5">
      <div class="col-4 text-center">
        <h2>Conferência dos lotes armazenados</h2>
        <form method="post">
          <div class="text-center">
            <!-- <input type="number" id="numero_caixa" name="numero_caixa" class="form-control text-center" aria-describedby="CaixaHelpBlock" required> -->
            <div class="form-check">
            <input type="text" id="codigo_caixa" name="codigo_caixa" class="text-center form-control" maxlength="5" autocomplete="off" aria-describedby="CaixaHelpBlock" required>
            <div id="CaixaHelpBlock" class="form-text">
              Informe os dígitos da caixa no campo acima.<br>
              É necessário a conferência dos lotes armazenados antes de gerar a carta de devolução.
            </div>
          </div>
            <div class="form-check" style="display: none;" >
              <button type="submit" class="btn btn-outline-success">Conferir</button>  
            </div>            
          </div>  
        </form>     
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table table-striped mt-3 alert alert-primary text-center" id="tabelaConferencia" style="display: none;">
            <thead>
              <tr>
                <th scope="col" colspan="7" class="fs-3">Dados para conferência:</th>
              </tr>
              <tr>
                <th scope="col">Nº Caixa</th>
                <th scope="col">Sigla Cliente</th>
                <th scope="col">Nome Cliente</th>
                <th scope="col">Quantidade de Lotes</th>
                <th scope="col">Quantidade de ARs</th>
                <th scope="col">Lote Inicial Cliente</th>
                <th scope="col">Lote Final Cliente</th>
              </tr>
            </thead>
            <tbody id="corpoTabelaCaixa">
              <tr>
                <th scope="row">1234</th>
                <td>ABC</td>
                <td>Cliente de Contrato com os Correios</td>
                <td>10</td>
                <td>1.234</td>
                <td>26001200</td>
                <td>26001234</td>
              </tr>              
            </tbody>
          </table>
        
      </div>
    </div>

  </div>