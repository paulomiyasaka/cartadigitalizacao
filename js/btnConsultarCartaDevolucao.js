import { focusInput } from './funcoesModal.js';

const botaoGerarCarta = document.getElementById('btn_consultar_carta_devolucao');
botaoGerarCarta.addEventListener('click', function() {
    
 
    const codigoCaixa = document.getElementById('codigo_caixa').value;
    window.open("consultarCarta.php?caixa="+codigoCaixa, "_blank");



});