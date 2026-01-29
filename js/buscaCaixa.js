// ... seus imports

inputCaixa.addEventListener('input', async function() {
    const codigo = this.value;
    const btns_conferencia = document.getElementById('btns_conferencia');
    const aguarde = document.getElementById('aguarde');
    const formData = new FormData();
    formData.append('codigo_caixa', codigo);

    // Reset inicial de visibilidade
    btns_conferencia.classList.add('invisible');

    if (codigo.length === quantidadeMaximaDigitos) {
        aguarde.classList.replace('invisible', 'visible');

        try {
            const response = await fetch('src/controller/buscarCaixa.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json(); // Já converte para objeto diretamente

            if (data.resultado) {
                const btnRetencao = document.getElementById('btn_reter_caixa');
                const btnConfirmar = document.getElementById('btn_confirmar_caixa');
                
                // Resetar estados de botões antes de aplicar lógica nova
                btnRetencao.classList.remove('disabled');
                btnConfirmar.classList.remove('disabled');
                btnAlterarQuebraSequencia.classList.remove('invisible');
                btnAlterarCaixa.classList.remove('invisible'); // Garante que apareça antes da lógica esconder
                btnAlterarCliente.classList.remove('invisible');

                if (data.caixa['retida'] === 'SIM' || data.caixa['armazenar'] === 'NAO' || data.caixa['fragmentar'] === 'SIM') {
                    btnAlterarQuebraSequencia.classList.add('invisible');
                    
                    const session = await getSession(); // Await aqui é mais seguro
                    if (session) {
                        if (['ADMINISTRADOR', 'GESTOR'].includes(session['perfil'])) {
                            btns_conferencia.classList.replace('invisible', 'visible');
                            viewCaixa.exibirDados(data.caixa, "bg-danger");
                            btnRetencao.classList.add('disabled');
                            btnConfirmar.classList.add('disabled');
                        } else {
                            const tabelaCorrecao = new InformarSolicitacaoCorrecao('tabelaConferencia', 'corpoTabelaCaixa');
                            tabelaCorrecao.exibirDados(data.caixa, "bg-danger");
                        }
                    }
                } else {
                    // Lógica para caixa OK
                    // EM VEZ DE .REMOVE(), use invisible para poder reexibir depois
                    btnAlterarCaixa.classList.add('invisible');
                    btnAlterarCliente.classList.add('invisible');
                    btns_conferencia.classList.replace('invisible', 'visible');
                    viewCaixa.exibirDados(data.caixa, 'bs-tertiary-bg');
                }
            } else {
                viewCaixa.ocultarTabela();
                formReset();
                new RenderizarToast().exibir(`Caixa ${codigo} não encontrada!`, "danger");
                focusInput();
            }
        } catch (error) {
            console.error('Erro na requisição:', error);
            viewCaixa.ocultarTabela();
        } finally {
            aguarde.classList.replace('visible', 'invisible');
        }
    } else {
        viewCaixa.ocultarTabela();
        // Opcional: focusInput('codigo_caixa');
    }
});

/**
 * backup do script
 * consultarCaixa.js 
 * 
 * **/


import { RenderizarCaixa } from './RenderizarCaixa.js';
import { InformarSolicitacaoCorrecao } from './InformarSolicitacaoCorrecao.js';
import { modalResposta, bloquearSubmit, formReset, focusInput, hiddenModal } from './funcoesModal.js';
import { RenderizarToast } from './RenderizarToast.js';
import { getSession } from './getSession.js';
import { menuBotaoManager } from './menu.js';

const inputCaixa = document.getElementById('codigo_caixa');
const viewCaixa = new RenderizarCaixa('tabelaConferencia', 'corpoTabelaCaixa');

const btnAlterarCaixa = document.getElementById("btn_corrigir_informacoes_caixa");
const btnAlterarCliente = document.getElementById("btn_corrigir_informacoes_cliente");
const btnAlterarQuebraSequencia = document.getElementById("btn_alterar_quebra_sequencia");

const quantidadeMaximaDigitos = 5;//caixa com 5 dígitos

inputCaixa.addEventListener('input', async function() {
    //bloquearSubmit(e);

    const codigo = this.value;
    const formData = new FormData();
    const btns_conferencia = document.getElementById('btns_conferencia');
    //const url = 'src/controller/buscarCaixa.php';

    btns_conferencia.classList.add('invisible');
    //console.log(codigo);
    // Adiciona o arquivo ao objeto FormData
    formData.append('codigo_caixa', codigo);

    
    
    //tabelaConferencia(viewCaixa, codigo, url, formData);
    if (codigo.length === quantidadeMaximaDigitos) {

        const aguarde = document.getElementById('aguarde');
        aguarde.classList.remove('invisible');
        aguarde.classList.add('visible');

        await fetch('src/controller/buscarCaixa.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
            //throw new Error('Erro na rede ou o arquivo não foi encontrado');
            console.error('Erro no response');
            }
            return response.json();
        }).then(data => {
                
                let objetoData = data;
                //objetoData = (typeof data === 'string') ? JSON.parse(data) : data;
                //console.log(objetoData);
                //console.log(data);

                if (objetoData.resultado) {
                    //menuBotaoManager.adicionar('reter');
                    //menuBotaoManager.adicionar('confirmar');
                    //menuBotaoManager.adicionar('alterarQuebra');
                    //menuBotaoManager.adicionar('corrigirCaixa');
                    //menuBotaoManager.adicionar('corrigirCliente');

                    const btnRetencao = document.getElementById('btn_reter_caixa');
                    btnRetencao.classList.remove('disabled');
                    const btnConfirmar = document.getElementById('btn_confirmar_caixa');
                    btnConfirmar.classList.remove('disabled');
                    //btnAlterarQuebraSequencia.classList.remove('invisible');
                    
                    if(objetoData.caixa['retida'] === 'SIM' || objetoData.caixa['armazenar'] === 'NAO' || objetoData.caixa['fragmentar'] === 'SIM'){
                        //const tabelaCorrecao = new InformarSolicitacaoCorrecao('tabelaConferencia', 'corpoTabelaCaixa');
                        //tabelaCorrecao.exibirDados(objetoData.caixa);                       
                        btnAlterarQuebraSequencia.classList.add('invisible');
                        
                        getSession().then(session => {
                            //console.log("Session: "+session);
                            if (session) {
                                const permissaoBTN = session['perfil'];
                                //console.log("Permissão: "+permissaoBTN);
                                if(permissaoBTN === 'ADMINISTRADOR' || permissaoBTN === 'GESTOR'){
                                    btns_conferencia.classList.remove('invisible');
                                    btns_conferencia.classList.add('visible');
                                    
                                    viewCaixa.exibirDados(objetoData.caixa, "bg-danger");                                    
                                    
                                    btnRetencao.classList.add('disabled');                                    
                                    btnConfirmar.classList.add('disabled');

                                }else{
                                    const tabelaCorrecao = new InformarSolicitacaoCorrecao('tabelaConferencia', 'corpoTabelaCaixa');
                                    tabelaCorrecao.exibirDados(objetoData.caixa, "bg-danger");
                                }
                                
                            }
                        });

                        

                    }else if(objetoData.caixa['retida'] === 'NAO' && objetoData.caixa['armazenar'] === 'SIM' && objetoData.caixa['fragmentar'] === 'NAO'){
                        btnAlterarCaixa.remove();
                        btnAlterarCliente.remove();
                        btns_conferencia.classList.remove('invisible');
                        viewCaixa.exibirDados(objetoData.caixa, 'bs-tertiary-bg');

                    }
                    
                    
                } else {
                    viewCaixa.ocultarTabela();                   
                    formReset();    
                    const notificacao = new RenderizarToast();                                    
                    notificacao.exibir(`Caixa número ${codigo} não foi encontrada!`, "danger");
                    focusInput();
                    //modalResposta('modal_falso', 'show', 'msg_erro', 'Caixa não encontrada!');
                    //hiddenModal('modal_falso', 'codigo_caixa');
                }
            })
            .catch(error => {
                //console.error('Erro:', error);
                viewCaixa.ocultarTabela();
            })
            .finally(() => {                                
                aguarde.classList.remove('visible');
                aguarde.classList.add('invisible');
            });

    }else if(codigo.length !== quantidadeMaximaDigitos){
        //formReset();
        focusInput('codigo_caixa');
        viewCaixa.ocultarTabela();

    }


});