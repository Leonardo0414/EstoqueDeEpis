//FUNCAO PARA LISTAR COLABORADORES NA TABELA
function listarColaboradores() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../../src/controllers/ColaboradorController.php?acao=listar',
        success: function(retorno) {
            var tabelaColaboradores = document.querySelector('#tabela-colaborador');
            tabelaColaboradores.innerHTML = '';

            var colaborador = retorno['dados'];
            colaborador.forEach(function(colaborador) {
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${colaborador['id_colaborador']}</td>
                    <td>${colaborador['nome']}</td>
                    <td>${colaborador['cpf']}</td>
                    <td>${colaborador['nascimento']}</td>
                    <td>
                        <a class="btn btn-edit btn-sm me-1" href="index.php?id_colaborador=${colaborador['id_colaborador']}">Editar</a>              
                        <a href='#' onclick='excluirColaborador(${colaborador['id_colaborador']})'>Excluir</a>
                    </td>
                `;
                tabelaColaboradores.appendChild(linha);
            });
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

document.addEventListener('DOMContentLoaded', listarColaboradores);

//FUNCAO PARA EXCLUIR COLABORADOR
function excluirColaborador(id_colaborador) {
    if (confirm('Tem certeza que deseja excluir este Colaborador?')) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '../../controllers/ColaboradorController.php?acao=remover',
            data: {                 
                'id_colaborador': id_colaborador
            },
            success: function(retorno) {
                alert(retorno['mensagem']);
                if (retorno['status'] == 'sucesso') {
                    listarColaboradores();
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro ao excluir o Colaborador: ' + erro);
            }
        });
    }
}
