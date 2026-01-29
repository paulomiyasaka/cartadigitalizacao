import { bloquearSubmit, formReset, focusInput } from './funcoesModal.js';
import { RenderizarCaixa } from './RenderizarCaixa.js';
import { RenderizarToast } from './RenderizarToast.js';
import { InformarSolicitacaoCorrecao } from './InformarSolicitacaoCorrecao.js';
import { getSession } from './getSession.js';

const container = document.getElementById('btns_conferencia');
container.addEventListener('click', async (e) => {
    if (e.target.id === 'btn_reter_caixa') {
        console.log('Botão Reter clicado!');
    bloquearSubmit(e);

    const codigo = document.getElementById('codigo_caixa').value;
    const formData = new FormData();
    formData.append('codigo_caixa', codigo);    
    const viewCaixa = new RenderizarCaixa('tabelaConferencia', 'corpoTabelaCaixa');
    const notificacao = new RenderizarToast();

    try{
        const response = await fetch('src/controller/solicitarRetencaoCaixa.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();
        if(data.resultado){       


        }//if data.resultado

    }catch(error){
        console.error('Erro na requisição:', error);
        viewCaixa.ocultarTabela();

    }finally{
            aguarde.classList.replace('visible', 'invisible');
    }


    }//e.target.id

});//addEventListener



