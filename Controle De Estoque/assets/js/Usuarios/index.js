//FUNCAO PARA SALVAR OS USUARIOS CADASTRADOS
function Salvar() {
    var id_usuario  = document.getElementById('txt_idUsuario').value;
    var nome        = document.getElementById('txt_nome').value;
    var usuario     = document.getElementById('txt_usuario').value;
    var senha       = document.getElementById('txt_senha').value;
    var url = (id_usuario == 'NOVO') ? '../../controllers/UsuarioController.php?acao=salvar' : '../../controllers/UsuarioController.php?acao=atualizar';
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: url,
        data: {
            'id_usuario': id_usuario,
            'nome':   nome,
            'usuario': usuario,
            'senha': senha
        },
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                document.getElementById('form-usuario').reset();
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

//FUNCAO PARA CARREGAR OS DADOS CASO ESTEJA NA URL 
function carregarDadosUsuario(id) {
    $.ajax({
        type: 'post',//verificar
        dataType: 'json',
        url: '../../controllers/UsuarioController.php?acao=buscar&id_usuario=' + id,
        success: function(retorno) {
            if (retorno['status'] == 'sucesso') {
                preencherFormulario(retorno['dados']);
            } else {
                alert('Usuário não encontrado.');
            }
        },
        error: function(erro) {
            alert('Erro ao buscar dados do usuário: ' + erro);
        }
    });
}
//PREENCHE O FORMULARIOS COM OS DADOS RECEBIDOS 
function preencherFormulario(dados) {
    document.getElementById('txt_idUsuario').value = dados.id_usuario;
    document.getElementById('txt_nome').value = dados.nome;
    document.getElementById('txt_usuario').value = dados.usuario;
    document.getElementById('txt_senha').value = dados.senha;
}
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const capId = urlParams.get('id_usuario');
    if (capId) {
        carregarDadosUsuario(capId);
    }
});
