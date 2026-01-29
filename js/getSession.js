export async function getSession() {
	
    return await fetch('src/Controller/GetSession.php', {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) throw new Error('Erro na rede');
        return response.json(); 
    })
    .then(objetoData => {
        if (objetoData.resultado) {
            return objetoData.sessao; 
        } else {
            console.error("Erro no PHP:", objetoData.mensagem);
            return null;
        }
    })
    .catch(error => {
        console.error("Erro na requisição:", error);
        return null;
    });  
    
    
}