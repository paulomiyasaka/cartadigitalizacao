export class RenderizarCaixa {
    constructor(idTabela, idCorpo) {
        this.tabela = document.getElementById(idTabela);
        this.corpo = document.getElementById(idCorpo);
    }

    /**
     * Limpa e preenche a tabela com os dados recebidos
     * @param {Object} dadosCaixa - Objeto contendo descricao, data_criacao, etc.
     */
    exibirDados(dadosCaixa) {
        // Limpa o conteúdo anterior
        this.corpo.innerHTML = '';

        // Mapeamento de nomes amigáveis para os campos do JSON
        const campos = {
            descricao: "Descrição dos Documentos",
            data_criacao: "Data de Armazenamento",
            responsavel: "Setor Responsável",
            status: "Status da Caixa"
        };

        // Itera sobre os campos para criar as linhas (tr)
        for (let chave in campos) {
            if (dadosCaixa[chave]) {
                const linha = `
                    <tr>
                        <td><strong>${campos[chave]}</strong></td>
                        <td>${dadosCaixa[chave]}</td>
                    </tr>
                `;
                this.corpo.innerHTML += linha;
            }
        }

        // Mostra a tabela
        this.tabela.style.display = 'table';
    }

    ocultarTabela() {
        this.tabela.style.display = 'none';
        this.corpo.innerHTML = '';
    }
}