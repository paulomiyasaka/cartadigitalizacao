export class RenderizarCaixa {
    constructor(idTabela, idCorpo, campos = []) {
        this.tabela = document.getElementById(idTabela);
        this.corpo = document.getElementById(idCorpo);
        this.campos = campos;
    }

    exibirDados(dadosCaixa) {
        // Limpa o conteúdo anterior
        this.corpo.innerHTML = '';

        // Itera sobre os campos para criar as linhas (tr)
        for (let chave in campos) {
            if (dadosCaixa[chave]) {
                const linha = `
                    <tr>
                        <td><strong>${campos[numeroCaixa]}</strong></td>
                        <td>${dadosCaixa[siglaCliente]}</td>
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