//FUUNCAO PARA SALVAR COLABORADOR
function Salvar() {
    var id_colaborador = document.getElementById('txt_idColaborador').value;
    var nome = document.getElementById('txt_nome').value;
    var cpf = document.getElementById('txt_cpf').value;
    var nascimento = document.getElementById('txt_datan').value;
    var url = (id_colaborador == 'NOVO') ? '../../controllers/ColaboradorController.php?acao=salvar' : '../../controllers/ColaboradorController.php?acao=atualizar';

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: url,
        data: {
            'id_colaborador': id_colaborador,
            'nome': nome,
            'cpf': cpf,
            'nascimento': nascimento
        },
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                document.getElementById('form-colaborador').reset();
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}
//FUNCAO PARA PARA CARREGAR DADOS DO COLABORADOR QUANDO ESTIVER NA URL ACIONADO PELO EDITAR
function carregarDadosColaborador(id) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '../../controllers/ColaboradorController.php?acao=buscar&id_colaborador=' + id,
        success: function(retorno) {
            if (retorno['status'] == 'sucesso') {
                preencherFormulario(retorno['dados']);
            } else {
                alert('Colaborador não encontrado.');
            }
        },
        error: function(erro) {
            alert('Erro ao buscar dados do usuário: ' + erro);
        }
    });
}
//FUNCAO PARA PREENCHER O FORMULARIO
function preencherFormulario(dados) {
    document.getElementById('txt_idColaborador').value = dados.id_colaborador;
    document.getElementById('txt_nome').value = dados.nome;
    document.getElementById('txt_cpf').value = dados.cpf;
    document.getElementById('txt_datan').value = dados.nascimento;
}
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const capId = urlParams.get('id_colaborador');
    if (capId) {
        carregarDadosColaborador(capId);
    }
});

//FUNCAO SOMENTE TEXTO CAMPO DO NOME
function somenteTexto(campo) {
    campo.value = campo.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
}

//FUNCAO PARA O CAMPO DO CPF PERSONALIZADO
function somenteNumeros(event) {
    const charCode = event.charCode ? event.charCode : event.keyCode;
    if (charCode < 48 || charCode > 57) {
        return false;
    }
    return true;
}

//FUNCAO PARA APLICAR MASCARA NO CPF
function mascararCPF(campo) {
    let valor = campo.value.replace(/\D/g, '');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2'); 
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    campo.value = valor;
}
//FUNCAO PARA A DATA DE NASCIMENTO
function validarDataNascimento(campo) {
    const dataNascimento = new Date(campo.value); 
    const dataAtual = new Date(); 
    const idadeMinima = 15; 
    const idadeMaxima = 100; 

    // VERIFICA SE E DATA FUTURA
    if (dataNascimento > dataAtual) {
        alert('A data de nascimento não pode ser uma data futura.');
        campo.value = ''; // LIMPA
        return false;
    }

    // CALCULA A IDADE
    const idade = dataAtual.getFullYear() - dataNascimento.getFullYear();
    const mes = dataAtual.getMonth() - dataNascimento.getMonth();
    if (mes < 0 || (mes === 0 && dataAtual.getDate() < dataNascimento.getDate())) {
        idade--; // Ajusta a idade se ainda não fez aniversário este ano
    }

    // VERIFICA IDADE MAINIMA
    if (idade < idadeMinima) {
        alert(`Colaborade de Menor  ${idadeMinima} Anos Não Permitido trabalhar Aqui,Verifique A Data De Nascimento `);
        campo.value = ''; 
        return false;
    }

    // VERIFICA A IDADE MAXIMA
    if (idade > idadeMaxima) {
        alert(`Esse Colaborador Deve Se Apostentar Pois Tem  Mais ${idadeMaxima} Anos Verifique Novamente A Data de Nascimento!.`);
        campo.value = ''; // LIMPA
        return false;
    }

    return true; // DATA VALIDA
}