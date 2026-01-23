import { RenderizarCaixa } from './RenderizarCaixa.js';
import { modalResposta, bloquearSubmit } from './funcoesModal.js';

const viewCaixa = new RenderizarCaixa('tabelaConferencia', 'corpoTabelaCaixa', []);
const inputCaixa = document.getElementById('codigo_caixa');

inputCaixa.addEventListener('input', async function() {
    //bloquearSubmit(e);

    const codigo = this.value;
    const formData = new FormData();
    //console.log(codigo);
    // Adiciona o arquivo ao objeto FormData
    formData.append('codigo_caixa', codigo);

    if (codigo.length === 5) {

        await fetch('src/controller/buscarCaixa.php', {
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
                
                let objetoData = (typeof data === 'string') ? JSON.parse(data) : data;
                //alert(codigo.length);
                //console.log(objetoData);
                console.log(data);
                //alert(objetoData.resultado);

                const viewCaixa = new RenderizarCaixa('tabelaConferencia', 'corpoTabelaCaixa', objetoData);
                if (objetoData.resultado) {
                    // USA A CLASSE PARA MOSTRAR OS DADOS
                    viewCaixa.exibirDados(objetoData.caixa);

                } else {
                    viewCaixa.ocultarTabela();
                    modalResposta('modal_falso', 'show', 'msg_erro', 'Caixa não encontrada!');
                }
            })
            .catch(error => {
                //console.error('Erro:', error);
                viewCaixa.ocultarTabela();
            });
    } else {
        viewCaixa.ocultarTabela();

    }
});