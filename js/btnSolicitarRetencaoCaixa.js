import { focusInput } from './funcoesModal.js';

const botaoSolicitarRetencao = document.getElementById('btn_reter_caixa');
botaoSolicitarRetencao.addEventListener('click', function() {
    
    const codigoCaixa = document.getElementById('codigo_caixa').value;
    const tabela = document.getElementById('tabelaConferencia');    

    const conteudoModal = document.getElementById('conteudo_modal_alerta');
    conteudoModal.innerHTML = '';
    conteudoModal.innerHTML = `Deseja solicitar a retenção da caixa número: <strong>${codigoCaixa}</strong>?`;

    const idAcao = document.getElementById('id_acao');
    idAcao.value = codigoCaixa;

    const btnConfirmar = document.getElementById('btn_ok_alerta');
    btnConfirmar.innerText = "RETER CAIXA";



});