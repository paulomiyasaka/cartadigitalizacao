import { RenderizarCaixa } from './RenderizarCaixa.js';
import { InformarSolicitacaoCorrecao } from './InformarSolicitacaoCorrecao.js';
import { modalResposta, bloquearSubmit, formReset, focusInput, hiddenModal } from './funcoesModal.js';
import { RenderizarToast } from './RenderizarToast.js';

const formQuebraSequencia = document.getElementById('form_alterar_quebra_sequencia');
const viewCaixa = new RenderizarCaixa('tabelaConferencia', 'corpoTabelaCaixa');
const notificacao = new RenderizarToast();

formQuebraSequencia.addEventListener('submit', async function(e) {
    bloquearSubmit(e);

    const codigo = document.getElementById('codigo_caixa').value;
    const quebra = document.getElementById('alterar_quebra_sequencia').value;
    const formData = new FormData();
    const btns_conferencia = document.getElementById('btns_conferencia');
    btns_conferencia.setAttribute('class','invisible');
    //console.log(codigo);
    // Adiciona o arquivo ao objeto FormData
    formData.append('codigo_caixa', codigo);
    formData.append('alterar_quebra_sequencia', quebra);

        await fetch('src/controller/alterarQuebraSequencia.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
            //throw new Error('Erro na rede ou o arquivo não foi encontrado');
            console.error('Erro no response');
        }
        return response.text();
        }).then(data => {
                
                let objetoData = data;
                objetoData = (typeof data === 'string') ? JSON.parse(data) : data;
                //console.log(objetoData);
                //console.log(data);

                if (objetoData.resultado) {
                    
                    if(objetoData.caixa['solicitarCorrecao'] === 'SIM' || objetoData.caixa['armazenar'] === 'NAO' || objetoData.caixa['fragmentar'] === 'SIM'){
                        const tabelaCorrecao = new InformarSolicitacaoCorrecao('tabelaConferencia', 'corpoTabelaCaixa');
                        tabelaCorrecao.exibirDados(objetoData.caixa);                       
                    }else if(objetoData.caixa['solicitarCorrecao'] === 'NAO' && objetoData.caixa['armazenar'] === 'SIM' && objetoData.caixa['fragmentar'] === 'NAO'){
                        btns_conferencia.removeAttribute('class','invisible');
                        viewCaixa.exibirDados(objetoData.caixa);

                    }
                    
                    
                } else {
                    viewCaixa.ocultarTabela();                   
                    formReset();                                        
                    notificacao.exibir(`Caixa número ${codigo} não foi encontrada!`, "danger");
                    focusInput();
                    //modalResposta('modal_falso', 'show', 'msg_erro', 'Caixa não encontrada!');
                    //hiddenModal('modal_falso', 'codigo_caixa');
                }
            })
            .catch(error => {
                //console.error('Erro:', error);
                viewCaixa.ocultarTabela();
            });
    
});