//FUNCAO PARA LISTAR OS USUARIOS CADASTRADOS NA TABELA
function listarUsuarios() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../../src/controllers/UsuarioController.php?acao=listar',
        success: function(retorno) {
            var tabelausuarios = document.querySelector('#tabela-usuarios');
            tabelausuarios.innerHTML = '';
            retorno['dados'].forEach(function(usuario) {
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${usuario['id_usuario']}</td>
                    <td>${usuario['nome']}</td>
                    <td>${usuario['usuario']}</td>
                    <td>${usuario['senha']}</td>
                    <td>
                        <a class="btn btn-edit btn-sm me-1" href="index.php?id_usuario=${usuario['id_usuario']}">Editar</a>
                        <button class="btn btn-delete btn-sm" onclick="excluirUsuario(${usuario['id_usuario']})">Excluir</button>
                    </td>
                `;
                tabelausuarios.appendChild(linha);
            });
        },
        error: function(erro) {
            alert('Ocorreu um erro ao listar os usuários: ' + erro);
        }
    });
}

//FUNCAO PARA EXCLUIR OS USUARIO CADASTRADOS
function excluirUsuario(id_usuario) {
    if (confirm('Tem certeza que deseja excluir este Usuário?')) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '../../controllers/UsuarioController.php?acao=deletar',
            data: { 'id_usuario': id_usuario },
            success: function(retorno) {
                alert(retorno['mensagem']);
                if (retorno['status'] == 'sucesso') {
                    listarUsuarios();
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro ao excluir o usuário: ' + erro);
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', listarUsuarios);
