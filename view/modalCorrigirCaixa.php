<div id="modal_corrigir" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Corrigir informações da caixa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <form id="form_alterar_dados" method="post">
            <div class="mb-3">
              <label for="quantidade_lotes" class="form-label">Quantidade de Lotes:</label>
              <input type="number" maxlength="2" class="form-control" id="quantidade_lotes" name="quantidade_lotes" required>

              <label for="quantidade_objetos" class="form-label">Quantidade de ARs:</label>
              <input type="number" class="form-control" id="quantidade_objetos" name="quantidade_objetos" maxlength="4" required>
            </div>
            <div class="mb-3">
              <label for="lote_cliente_inicial" class="form-label">Lote Inicial Cliente:</label>
              <input type="number" class="form-control" id="lote_cliente_inicial" name="lote_cliente_inicial" maxlength="8" required>

              <label for="lote_cliente_final" class="form-label">Lote Final Cliente:</label>
              <input type="number" class="form-control" id="lote_cliente_final" name="lote_cliente_final" maxlength="8" required>
            </div>
            <div class="input-group">
              <span class="input-group-text">Quebra de Sequência:</span>
              <textarea class="form-control" aria-label="Quebra de Sequência" id=
              "quebra_sequencia" name="quebra_sequencia" maxlength="245"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
          </form>
        </div>
      </div>      
    </div>
  </div>
</div>