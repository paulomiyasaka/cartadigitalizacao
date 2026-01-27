export async function getSession() {
	
    
    await fetch('src/Controller/GetSession.php', {
    	method: 'POST'
    })
    .then(response => {
    	if (!response.ok) {
            //throw new Error('Erro na rede ou o arquivo não foi encontrado');
            console.error('Erro no response');
       }
    })
    .then(data => {

    	let objetoData = data;
        objetoData = (typeof data === 'string') ? JSON.parse(data) : data;
        
        if (objetoData.resultado) {
            	
            console.log(objetoData.sessao['nome']);        
            
		}else{
			console.error("Erro: "+objetoData.resultado);
		}


    });//then   
    
    
}