let opcoesSE = "";
let opcoesEmbalagens = "";

async function carregarSES() {
    try {
        
        const respostaSE = await fetch('src/Controller/getSuperintendencia.php'); 
        const dadosSE = await respostaSE.json();

        const selectDestinatario = document.getElementById("select_destinatarios");

        const respostaEmbalagem = await fetch('src/Controller/getEmbalagens.php'); 
        const dadosEmbalagens = await respostaEmbalagem.json();

        const selectEmbalagens = document.getElementById("select_embalagens");

        if (selectDestinatario && dadosSE.resultado) {
            let htmlOptionsSE = '<option value="" selected disabled>Selecione</option>';
            
            dadosSE.se.forEach(item => {
                htmlOptionsSE += `<option value="${item.siglaSe}">${item.siglaSe}</option>`;
            });

            selectDestinatario.innerHTML = htmlOptionsSE;

            opcoesSE = dadosSE.se.map(item => 
                `<option value="${item.siglaSe}">${item.siglaSe}</option>`
            ).join('');

        }//select_destinatario

        if (selectEmbalagens && dadosEmbalagens.resultado) {
            let htmlOptionsEmbalagens = '<option value="" selected disabled>Selecione</option>';

            dadosEmbalagens.embalagens.forEach(item => {
                htmlOptionsEmbalagens += `<option value="${item.altura}x${item.largura}x${item.comprimento}">${item.embalagem}</option>`;
            });

            selectEmbalagens.innerHTML = htmlOptionsEmbalagens;

            opcoesEmbalagens = dadosEmbalagens.embalagens.map(item => 
                `<option value="${item.altura}x${item.largura}x${item.comprimento}">${item.embalagem}</option>`
            ).join('');

        }//select_embalagens



    } catch (erro) {
        console.error("Erro ao buscar dados:", erro);
        opcoesSE = `<option value="">Erro ao carregar</option>`;
    }
}


carregarSES();


function adicionarLinha(botaoAtual) {
    const tabela = document.getElementById("tabela_etiqueta");
    const totalLinhas = tabela.rows.length;
    
    // 1. Transforma o botão clicado em "Remover"
    botaoAtual.parentNode.innerHTML =  `<button onclick="removerLinha(this)" class="btn btn-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
              <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
            </svg>
          </button>`;
    
    // 2. Cria a nova linha
    const novaLinha = tabela.insertRow(-1); 
    const celulaSE = novaLinha.insertCell(0);
    const celulaQuantidade = novaLinha.insertCell(1);
    const celulaEmbalagem = novaLinha.insertCell(2);
    const celulaBotao = novaLinha.insertCell(3);
    
    // 3. Define o conteúdo da nova linha com o botão "Adicionar"
    //celulaSe.innerHTML = "Linha " + (totalLinhas + 1);
    celulaSE.innerHTML = `<select class="form-select" name="destinatarios[]" required>
                    <option value="" selected disabled>Selecione</option>
                    ${opcoesSE}
                  </select>`;
    celulaQuantidade.innerHTML = `<input type="number" class="form-control w-50 mx-auto text-center" min="0" name="quantidade_etiqueta[]" required>`;
    celulaEmbalagem.innerHTML = `<select class="form-select" name="tipo_embalagem[]" required>
                    <option value="" selected disabled>Selecione</option>
                    ${opcoesEmbalagens}
                  </select>`;
    celulaBotao.innerHTML = `<button onclick="adicionarLinha(this)" class="btn btn-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg></button>`;
}

function removerLinha(botao) {
    // Remove a linha correspondente ao botão clicado
    const linha = botao.parentNode.parentNode;
    linha.parentNode.removeChild(linha);
}
