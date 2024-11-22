function tema() {
    document.body.classList.toggle('dark-mode'); //PASSA O VALOR DARK MODE PARA DENTRO DO BODY (CSS) DARK MODE + CAMPO
    const themeButton = document.querySelector('.tema');//ATIVADO CHAMA A CLASSE TEMA E RECEBENDO VALORES DO CSS
    // ATUALIZA O TEXTO DO BOTÃO BASEADO NO ESTADO DO TEMA
    themeButton.textContent = document.body.classList.contains('dark-mode') ? '☀️ Modo Claro' : '🌙 Modo Escuro';
}
function updateClock() {
    const now = new Date(); //FUNCAO DE CAPTURADA DATA E HORA ATUAL
    document.getElementById('time').textContent = now.toLocaleTimeString('pt-BR');
    document.getElementById('date').textContent = now.toLocaleDateString('pt-BR');
}
//CHAMA A FUNCAO E ATUALIZA NA PAGINA A CADA 1s
setInterval(updateClock, 1000);