const urlParams = new URLSearchParams(window.location.search);
    const codigo = urlParams.get('caixa');
    //const aguarde = document.getElementById('aguarde');

    const url = 'src/controller/gerarHTML.php?caixa='+codigo;
    if (codigo) {
        //aguarde.classList.remove('invisible');
        //aguarde.classList.add('visible');
        try{
            const response = await fetch(url, {
                method: 'GET'
            });
            const resposta = await response.json();
            //alert(data);
            if(resposta['resultado'] === true){                            
                const diretorio = "output/";
                const respostaHtml = await fetch(diretorio+resposta['carta']);
                const htmlFinal = await respostaHtml.text();
                document.getElementById('conteudo-html').innerHTML = htmlFinal;
               
            }
            
            
        }catch (error) {
            console.error('Erro na requisição:', error);
            //viewCaixa.ocultarTabela();
        } finally {
            //aguarde.classList.remove('visible');
            //aguarde.classList.add('invisible');
        }//try, catch, finally
        

    }