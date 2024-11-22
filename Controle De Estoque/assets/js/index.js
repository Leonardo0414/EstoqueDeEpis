//FUNCAO PARA LOGAR O USUARIO
function Entrar() {
    //VALIDACAO DOS CAMPOS
    var usuario  = document.getElementById('txt_usuario').value;
    var senha    = document.getElementById('txt_senha').value;
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/controllers/UsuarioController.php?acao=login', //CAMINHO
        data: {
            'usuario': usuario,
            'senha': senha
        },
        success: function(retorno) {
            if (retorno['status'] == 'sucesso') {
                window.location = 'sistema.php';
            } else {
                alert(retorno['mensagem']);
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

//FUNCAO PARA DESLOGAR O USUARIO
function Sair() {
    var confirmou = confirm('Deseja realmente sair do sistema?');
    if (confirmou) {
        window.location.href = 'src/controllers/UsuarioController.php?acao=deslogar'; //CAMINHO
    }
}
