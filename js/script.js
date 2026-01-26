import { habilitarTooltip, habilitarDropdown } from './funcoesAutoLoad.js';
import { RenderizarToast } from './RenderizarToast.js';

document.addEventListener('DOMContentLoaded', () => {
    // Joga a inicialização para o final da fila de tarefas
    setTimeout(() => {
        habilitarTooltip();
        habilitarDropdown();

    }, 0);
});









