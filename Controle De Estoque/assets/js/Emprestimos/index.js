//FUNCAO PARA CARREGAR COLABORADORES NO SELECT NA TELA DE EPRESTIMOS
function listarColaboradoresSelect() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../controllers/ColaboradorController.php?acao=listar',
        success: function(retorno) {
            var listColaborador = document.querySelector('#list_colaboradores');
            listColaborador.innerHTML = '';
            var colaboradores = retorno['dados'];
            var options = [];
            colaboradores.forEach(function(colaborador) {
                options.push(`<option value="${colaborador['id_colaborador']}">${colaborador['nome']}</option>`);
            });

            listColaborador.innerHTML = options;
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro.responseText);
        }
    });
}

document.addEventListener('DOMContentLoaded', listarColaboradoresSelect);

//FUNCAO PARA LISTAR OS EQUIPAMENTOS NA TELA DE EMPRESTIMOS
function listarEquipamentosSelect() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../controllers/EquipamentosController.php?acao=listar',
        success: function(retorno) {
            var listequipamento = document.querySelector('#list_equipamentos');
            listequipamento.innerHTML = '';

            var equipamentos = retorno['dados'];
            var options = [];
            equipamentos.forEach(function(equipamento) {
                options.push(`<option value="${equipamento['id_equipamento']}">${equipamento['descricao']}</option>`);
            });

            listequipamento.innerHTML = options;
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

document.addEventListener('DOMContentLoaded', listarEquipamentosSelect);
//FUNCAO PARA SALVAR EMPRESTIMO
function salvarEmprestimo() {
    var id_emprestimo = document.getElementById('txt_idEmprestimo').value;
    var id_equipamento = document.getElementById('list_equipamentos').value;
    var data_retirada = document.getElementById('txt_retirada').value;
    var data_devolucao = document.getElementById('txt_devolucao').value;
    var id_colaborador = document.getElementById('list_colaboradores').value;
    var quantidade = document.getElementById('txt_quantidade').value;

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../controllers/EmprestimosController.php?acao=salvar',
        data: {
            'id_emprestimo': id_emprestimo,
            'id_equipamento': id_equipamento,
            'data_retirada': data_retirada,
            'data_devolucao': data_devolucao,
            'id_colaborador': id_colaborador,
            'quantidade': quantidade
        },
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                document.getElementById('form-emprestimos').reset();
            }
        },
        error: function(erro) {
            console.error("Erro na requisição:", erro);
            alert('Ocorreu um erro na requisição: ' + erro.responseText);
        }
    });
}
