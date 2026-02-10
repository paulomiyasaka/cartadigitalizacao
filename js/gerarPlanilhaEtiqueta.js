import { focusInput, bloquearSubmit } from './funcoesModal.js';
import { RenderizarToast } from './RenderizarToast.js';
import { getSession } from './getSession.js';

const formGerarCarta = document.getElementById('form_gerar_plantilha_etiqueta');
const aguarde = document.getElementById('aguarde');
const notificacao = new RenderizarToast();

formGerarCarta.addEventListener('submit', async function(e) {
    bloquearSubmit(e);
    aguarde.classList.remove('invisible');
    aguarde.classList.add('visible'); 
    const url = 'src/controller/gerarPlanilhaEtiqueta.php';
    
    try{
        const session = await getSession();



        notificacao.exibir(`Planilha gerada com sucesso!`, "success");

    }catch (error) {
        console.error('Erro na requisição:', error);
        notificacao.exibir(`Erro ao gerar planilha!`, "danger");

    } finally {
        aguarde.classList.remove('visible');
        aguarde.classList.add('invisible');
    }//try, catch, finally

    

});