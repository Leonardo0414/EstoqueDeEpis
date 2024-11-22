
//FUNCAO PARA CARREGAR OS EQUIPAMENTO CASO RETORNE NA URL COM A FUNCAO DE EDITAR
function carregarEquipamento(idEquipamento) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../../controllers/EquipamentosController.php?acao=listar&id=' + idEquipamento,
        success: function(retorno) {      
            if (retorno.status == 'sucesso' && retorno.dados.length > 0) {
                const equipamento = retorno.dados[0];
                document.getElementById('txt_idEquipamento').value = equipamento.id_equipamento;
                document.getElementById('txt_descricao').value = equipamento.descricao;
                document.getElementById('img_barras').src = '../../../' + equipamento.imgbarra;
                document.getElementById('txt_quantidade').value = equipamento.qtd_estoque;

                const imgFotoElem = document.getElementById('img_foto_display');
                if (equipamento.imgfoto) {
                    if (!imgFotoElem) {
                        const newImg = document.createElement('img');
                        newImg.id = 'img_foto_display';
                        newImg.src = '../../../' + equipamento.imgfoto;
                        newImg.style = "max-width: 150px; max-height: 50px; display: block; margin-top: 10px;";
                        document.getElementById('img_foto').insertAdjacentElement('afterend', newImg);
                    } else {
                        imgFotoElem.src = '../../../' + equipamento.imgfoto;
                    }
                } else if (imgFotoElem) {
                    imgFotoElem.remove();
                }
            } else {
                alert('Equipamento não encontrado.');
            }
        },
        error: function(erro) {
            alert('Erro Ao Carregar o Equipamento.');
        }
    });
}
//FUNCAO DE CAPTURA DE URL
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

//FUNCAO PARA CARREGAR OS DADOS CASO TENHA NA URL
window.onload = function() {
    const id_equipamento = getUrlParameter('id_equipamento');
    if (id_equipamento) {
        carregarEquipamento(id_equipamento);
    }
};



//FUNCAO PARA SALVAR EQUIPAMENTO
function Salvar() {
    var id_equipamento = document.getElementById('txt_idEquipamento').value;
    var descricao = document.getElementById('txt_descricao').value;
    var imgbarra = document.getElementById('img_barras').src;
    var imgfoto = document.getElementById('img_foto').value;
    var quantidade = document.getElementById('txt_quantidade').value;

    var formData = new FormData(document.getElementById('form-equipamentos')); // FORM DATA PARA UPLOAD DE ARQUIVOS
    formData.append('id_equipamento', id_equipamento);
    formData.append('descricao', descricao);
    formData.append('imgbarra', imgbarra);
    formData.append('quantidade', quantidade);

    $.ajax({
        type: 'post',
        url: '../../controllers/EquipamentosController.php?acao=salvar',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
       
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                document.getElementById('form-equipamentos').reset();
            
            }
        },
        error: function(erro) {
            console.error("Erro na requisição:", erro);
            alert('Ocorreu um erro na requisição: ' + erro.responseText);
        }
    });
}

//FUNCAO PARA GERAR BARRAS
function GerarBarras() {
    var idProduto = document.getElementById('txt_idEquipamento').value;
    var barcodeUrl = 'https://www.barcodesinc.com/generator/image.php?code=' + idProduto + '&style=197&type=C128B&width=300&height=100&xres=1&font=3';
    document.getElementById('img_barras').src = barcodeUrl;
}
