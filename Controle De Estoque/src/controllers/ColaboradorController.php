<?php
//1°,2° FUNCAO PARA TELA DO INDEC
//3°,4°,5° FUNCAO PARA TELA DE CADASTRADOS
require_once '../models/Colaboradores.php';
class ColaboradorController {
    private $model;
    public function __construct() {
        $this->model = new Colaborador();
    }

    // FUNCAO PARA SALVAR COLABORADOR
    public function salvar() {
        try {
            $formulario['id_colaborador'] = isset($_POST['id_colaborador']) ? $_POST['id_colaborador'] : '';
            $formulario['nome'] = isset($_POST['nome']) ? $_POST['nome'] : '';
            $formulario['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : '';
            $formulario['nascimento'] = isset($_POST['nascimento']) ? $_POST['nascimento'] : '';
            if (in_array('', $formulario)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Existem Dados Faltando! Verifique'
                ];
                echo json_encode($resposta);
                exit;
            }
            //CONDICAO PARA VERIFICAR SE O CPF ESTA COMPLETO
            $cpf = preg_replace('/[^0-9]/', '', $formulario['cpf']);
            if (strlen($cpf) !== 11) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Campo do Cpf Inválido. Verifique e tente novamente.'
            ];
            echo json_encode($resposta);
            exit;
        }
            $this->model->inserir(
                $formulario['id_colaborador'],
                $formulario['nome'],
                $formulario['cpf'],
                $formulario['nascimento']
            );
            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Colaborador Cadastrado Com Sucesso!'
            ];
            echo json_encode($resposta);
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    // FUNCAO PAR ATUALIZAR COLABORADOR
    public function atualizar() {
        try {
            $formulario['id_colaborador'] = isset($_POST['id_colaborador']) ? $_POST['id_colaborador'] : '';
            $formulario['nome'] = isset($_POST['nome']) ? $_POST['nome'] : '';
            $formulario['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : '';
            $formulario['nascimento'] = isset($_POST['nascimento']) ? $_POST['nascimento'] : '';
            if (in_array('', $formulario)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Existem Dados Faltando! Verifique'
                ];
                echo json_encode($resposta);
                exit;
            }
            $this->model->atualizar(
                $formulario['id_colaborador'],
                $formulario['nome'],
                $formulario['cpf'],
                $formulario['nascimento']
            );
            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Colaborador alterado com sucesso!'
            ];
            echo json_encode($resposta);

        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    // FUNCAO PARA LISTAR TODOS OS COLABORADORES
    public function listar() {
        try {
            $dados = $this->model->selecionarTudo();
            $resposta = [
                'status' => 'sucesso',
                'dados' => $dados
            ];
            echo json_encode($resposta);

        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }

//FUNCAO PARA REMOVER COLOBADORADOR
    public function remover() {
        try {
            $id_colaborador = isset($_POST['id_colaborador']) ? $_POST['id_colaborador'] : '';
    
            if (empty($id_colaborador)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'O ID do Colaborador está faltando!'
                ];
                echo json_encode($resposta);
                exit;
            }
    
            // VERIFICA SE O COLABORADOR POSSUI EMPRESTIMOS
            $emprestimosRegistrados = $this->model->verificarEmprestimosAtivos($id_colaborador);
            if ($emprestimosRegistrados) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Não é Possível Excluir o Colaborador, Pois Ele Possui Empréstimos Registrados!'
                ];
                echo json_encode($resposta);
                exit;
            }
            //EXCLUI O COLABORADRO
            $this->model->excluir($id_colaborador);
    
            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Colaborador removido com sucesso!'
            ];
            echo json_encode($resposta);
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma exceção no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
 

    // FUNCAO PARA BUSCAR DADOS DE UM COLABORADOR PELO ID
    public function buscar() {
        try {
            $id_colaborador = isset($_GET['id_colaborador']) ? $_GET['id_colaborador'] : '';
            if (empty($id_colaborador)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'O ID do Colaborador está faltando!'
                ];
                echo json_encode($resposta);
                exit;
            }
            $dados = $this->model->buscarPorId($id_colaborador);
            if ($dados) {
                $resposta = [
                    'status' => 'sucesso',
                    'dados' => $dados
                ];
                echo json_encode($resposta);
            } else {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Colaborador não encontrado.'
                ];
                echo json_encode($resposta);
            }

        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }

}

// TRATAMENTO DE ROTAS DA URL
if (isset($_GET['acao'])) {
    $controller = new ColaboradorController();
    switch ($_GET['acao']) {
        case 'salvar':
            $controller->salvar();
            break;
        case 'listar':
            $controller->listar();
            break;
        case 'remover':
            $controller->remover();
            break;
        case 'buscar':
            $controller->buscar();
            break;
        case 'atualizar':
            $controller->atualizar();
            break;
    }
}
