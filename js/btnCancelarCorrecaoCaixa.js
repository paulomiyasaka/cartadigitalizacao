import { focusInput } from './funcoesModal.js';

const botaoSolicitarCorrecao = document.getElementById('btn_cancelar_correcao_caixa');
botaoSolicitarCorrecao.addEventListener('click', function() {
    
    const codigoCaixa = document.getElementById('codigo_caixa').value;
    const tabela = document.getElementById('tabelaConferencia');    
    const botao = document.querySelector('button[data-solicitar]');
    const valor = botao.getAttribute('data-solicitar');

    //alert(valor);
    const conteudoModal = document.getElementById('conteudo_modal_alerta');
    conteudoModal.innerText = '';
    conteudoModal.innerText = `Cancelar solicitação de correção da caixa número: <strong>${codigoCaixa}</strong>`;

    const idAcao = document.getElementById('id_acao');
    idAcao.value = codigoCaixa;

    const btnConfirmar = document.getElementById('btn_ok_alerta');
    btnConfirmar.innerText = "OK";

    const btnFechar = document.getElementById('btn_cancelar_alerta');
    btnFechar.innerText = "FECHAR";

    //const tituloModal = document.getElementById('titulo_modal_informacao_caixa');
    //tituloModal.innerText = '';
    //tituloModal.innerText = `Alterar quebra de sequência da caixa: ${codigoCaixa}`;
    //focusInput('alterar_quebra_sequencia');
    
    // 4. Lógica para abrir seu modal (exemplo)
    //document.getElementById('meuModal').classList.add('active');



});
