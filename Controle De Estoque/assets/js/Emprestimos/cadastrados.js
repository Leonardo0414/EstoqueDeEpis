//FUNCAO PAR LISTAR OS EMPRESTIMOS NA TABELA
function listarEmprestimos() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../controllers/EmprestimosController.php?acao=listar',
        success: function(retorno) {
            var tabelaEmprestimos = document.querySelector('#tabela-Emprestimos');
            tabelaEmprestimos.innerHTML = '';

            var emprestimos = retorno['dados'];
            emprestimos.forEach(function(emprestimo) {
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${emprestimo['id_emprestimo']}</td>
                    <td>${emprestimo['descricao']}</td>
                    <td>${emprestimo['data_retirada']}</td>
                    <td>${emprestimo['data_devolucao']}</td>
                    <td>${emprestimo['nome_colaborador']}</td>
                    <td>${emprestimo['quantidade']}</td>
                    <td>${emprestimo['situacao']}</td>
                    <td>
                        <button class="btn btn-delete btn-sm" onclick="cancelarEmprestimo(${emprestimo['id_emprestimo']})">Cancelar</button>
                    </td>
                `;
                tabelaEmprestimos.appendChild(linha);
            });
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}
document.addEventListener('DOMContentLoaded', listarEmprestimos);

//FUNCAO PARA CANCELAR O EMPRESTIMO
function cancelarEmprestimo(id_emprestimo) {
    var confirmou = confirm('Tem certeza que quer cancelar esta venda?');
    if (confirmou) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '../../../src/controllers/EmprestimosController.php?acao=cancelar',
            data: {
                'id_emprestimo': id_emprestimo
            },
            success: function(retorno) {
                alert(retorno['mensagem']);
                if (retorno['status'] == 'sucesso') {
                    listarEmprestimos();
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro na requisição: ' + erro);
            }
        });
    }
}
