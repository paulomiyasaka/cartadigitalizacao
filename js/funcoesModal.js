export function modalResposta(id_modal, status, id_mensagem, msg){
	
	let elementoMensagem = document.getElementById(id_mensagem);
	let elementoModal = document.getElementById(id_modal);
	const modalResposta = new bootstrap.Modal(elementoModal, {
		keyboard: true
	});

	if (elementoMensagem) {
        elementoMensagem.innerHTML = msg;
    }

	let instanciaModal = bootstrap.Modal.getOrCreateInstance(elementoModal);

    if (status === 'show' || status === true) {
        instanciaModal.show();
    } else if (status === 'hide' || status === false) {
        instanciaModal.hide();
    }
	
}


export function atualizarPagina(){

	document.location.reload(true);
	
}


export function formReset(){

	document.getElementsByTagName("form")[0].reset();

}

export function bloquearSubmit(e){
    e.preventDefault();    
}
