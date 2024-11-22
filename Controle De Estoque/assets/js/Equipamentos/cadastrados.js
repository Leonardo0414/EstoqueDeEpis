//FUNCAO PARA LISTAR OS EQUIPAMENTOS NA TABELA
function listarEquipamentos() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../controllers/EquipamentosController.php?acao=listar',
        success: function(retorno) {
            var tabelaequipamentos = document.querySelector('#tabela-equipamentos');
            tabelaequipamentos.innerHTML = '';
            retorno['dados'].forEach(function(equipamento) {
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${equipamento['id_equipamento']}</td>
                    <td>${equipamento['descricao']}</td>
                    <td><img src="../../../${equipamento['imgbarra']}" alt="Código de Barras" style="width: 50px; height: auto;"></td>
                    <td><img src="../../../${equipamento['imgfoto']}" alt="Foto do EPI" style="width: 50px; height: auto;"></td>
                    <td>${equipamento['qtd_estoque']}</td>
                    <td>
                        <a href="index.php?id_equipamento=${equipamento['id_equipamento']}" class="btn btn-edit btn-sm me-1">Editar</a>
                        <button class="btn btn-delete btn-sm" onclick="excluirEpi(${equipamento['id_equipamento']})">Excluir</button>
                        <button class="btn btn-view btn-sm" onclick="visualizarImagens('../../../${equipamento['imgbarra']}', '../../../${equipamento['imgfoto']}')">Visualizar</button>
                    </td>
                `;
                tabelaequipamentos.appendChild(linha);
            });
        },
        error: function(erro) {
            alert('Ocorreu um erro ao listar os EPIs: ' + erro);
        }
    });
}

//FUNCAO PARA EXCLUIR EQUIPAMENTO
function excluirEpi(id_equipamento) {
    if (confirm('Tem certeza que deseja excluir este EPI?')) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '../../controllers/EquipamentosController.php?acao=remover',
            data: { 'id_equipamento': id_equipamento },
            success: function(retorno) {
                alert(retorno['mensagem']);
                if (retorno['status'] == 'sucesso') {
                    listarEquipamentos();
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro ao excluir o EPI: ' + erro);
            }
        });
    }
}
//FUNCAO PARA EXIBIR AS IMAGENS NO MODAL
function visualizarImagens(imgbarra, imgfoto) {
    document.getElementById('modalCodBarras').src = imgbarra;
    document.getElementById('modalFotoEpi').src = imgfoto;
    var imagemModal = new bootstrap.Modal(document.getElementById('imagemModal'));
    imagemModal.show();
}

document.addEventListener('DOMContentLoaded', listarEquipamentos);
