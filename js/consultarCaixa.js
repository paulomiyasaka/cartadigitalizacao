import { RenderizarCaixa } from './RenderizarCaixa.js';
import { modalResposta } from './funcoesModal.js';

// Instancia a classe passando os IDs do HTML
const viewCaixa = new RenderizarCaixa('tabelaConferencia', 'corpoTabelaCaixa');
const inputCaixa = document.getElementById('codigo_caixa');

inputCaixa.addEventListener('input', async function() {
    const codigo = this.value;
    const formData = new FormData();
    
    // Adiciona o arquivo ao objeto FormData
    formData.append('codigo_caixa', codigo);

    if (codigo.length === 5) {

        await fetch('src/controller/buscarCaixa.php?codigo=${codigo}', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                //alert(codigo.length);
                let objetoData = (typeof data === 'string') ? JSON.parse(data) : data;
                console.log(objetoData);
                //alert(objetoData.resultado);
                if (objetoData.resultado) {
                    // USA A CLASSE PARA MOSTRAR OS DADOS
                    viewCaixa.exibirDados(objetoData.caixa);
                } else {
                    viewCaixa.ocultarTabela();
                    modalResposta('modal_falso', 'show', 'msg_erro', 'Caixa não encontrada!');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                viewCaixa.ocultarTabela();
            });
    } else {
        viewCaixa.ocultarTabela();
    }
});