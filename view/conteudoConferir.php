  <div class="container">

    <div class="row justify-content-center align-middle p-5">
      <div class="col-4 text-center">
        <h2>Conferência dos lotes armazenados</h2>
          <div class="text-center">
            <!-- <input type="number" id="numero_caixa" name="numero_caixa" class="form-control text-center" aria-describedby="CaixaHelpBlock" required> -->
            <input type="text" id="codigoCaixa" name="codigoCaixa" class="form-control" maxlength="5" autocomplete="off">
            <div id="CaixaHelpBlock" class="form-text">
              Informe os dígitos da caixa no campo acima.<br>
              É necessário a conferência dos lotes armazenados antes de gerar a relação para as cartas.
            </div>
          </div>       
      </div>
    </div>

    <div class="row">
      <div class="col">

        <div id="dadosConferencia" style="display: none;" class="alert alert-info mt-3">
    <h5>Dados para Conferência:</h5>
    <p><strong>Descrição:</strong> <span id="confDescricao"></span></p>
    <p><strong>Data de Armazenamento:</strong> <span id="confData"></span></p>
    <p><strong>Responsável:</strong> <span id="confResponsavel"></span></p>
</div>



        <div id="dados_conferencia" class="alert alert-primary text-center">
          <table class="table table-striped mt-3" id="tabelaConferencia" style="display: none;">
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

    <div class="row justify-content-center align-middle">
      <div class="col-4 text-center">        
        <form method="post">
          <div class="mb-3 text-center">
          <input type="hidden" id="conf_numero_caixa" name="conf_numero_caixa" value="">
        </div>
          <button type="submit" class="btn btn-outline-success">Conferir</button>
        </form>        
      </div>
    </div>



  </div>