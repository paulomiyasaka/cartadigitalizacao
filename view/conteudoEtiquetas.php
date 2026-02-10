<div class="container">
  <div class="row">
    <div class="col text-center">
      <div id="aguarde" class="invisible">
        <p>Carregando <img src="img/load.gif" style="vertical-align: middle;"></p>
      </div>
    </div> 
  </div>
  <div class="row justify-content-center align-middle p-5">
    <div class="col-7 text-center">
      <h3>Gerar Planilha para Emissão de Etiquetas (PPN)</h3>
      <form id="form_gerar_plantilha_etiqueta" method="POST">
        <table id="tabela_etiqueta" class="table">
          <thead>
            <tr>
              <th scope="col">Selecione a SE</th>
              <th scope="col">Quantidade de Etiquetas</th>    
              <th scope="col">Ação</th>                
            </tr>
          </thead>
          <tbody>
            <tr>
              <th class="mb-3">
                <select class="form-select" name="destinatarios[]" required>
                  <option value="" selected disabled>Selecione</option>
                </select>
              </th>
              <th class="mb-3">
                <input type="number" class="form-control w-50 mx-auto text-center" name="quantidade_etiqueta[]" required>
              </th>
              <th class="mb-3">
                <button onclick="adicionarLinha(this)" class="btn btn-light">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>

                </button>
              </th>
            </tr>
          </tbody>
        </table>   
        <button type="submit" class="btn btn-outline-success">Gerar Planilha</button>
      </form>        
    </div>
  </div>    
</div>