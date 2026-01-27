import { focusInput } from './funcoesModal.js';

const botaoSolicitarCorrecao = document.getElementById('btn_correcao_caixa');
botaoSolicitarCorrecao.addEventListener('click', function() {
    
    const codigoCaixa = document.getElementById('codigo_caixa').value;
    const tabela = document.getElementById('tabelaConferencia');    

    const conteudoModal = document.getElementById('conteudo_modal_alerta');
    conteudoModal.innerHTML = '';
    conteudoModal.innerHTML = `Deseja solicitar a correção da caixa número: <strong>${codigoCaixa}</strong>?<br>Somente o gestor poderá visualizar.`;

    const idAcao = document.getElementById('id_acao');
    idAcao.value = codigoCaixa;

    const btnConfirmar = document.getElementById('btn_ok_alerta');
    btnConfirmar.innerText = "SOLICITAR";



});