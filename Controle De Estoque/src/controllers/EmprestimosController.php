<?php
//1°FUNCAO TELA DO INDEX 
//2° 3°FUNCAO TELA DE CADASTRADOS
require_once '../models/Emprestimos.php';
require_once '../models/Equipamentos.php';

class EmprestimosController {
    private $model;
    private $equipamentoModel;

    public function __construct() {
        $this->model = new Emprestimos();
        $this->equipamentoModel = new Equipamentos();
    }
    //FUNCAO PARA SALVAR O EMPRESTIMO
    public function salvar() {
        try {
            session_start();
            $id_usuario = $_SESSION['id_usuario'];
            //VALIDACAO
            $formulario = [
                'id_emprestimo'   => isset($_POST['id_emprestimo'])   ? $_POST['id_emprestimo']   : '',
                'id_equipamento'  => isset($_POST['id_equipamento'])  ? $_POST['id_equipamento']  : '',
                'data_retirada'   => isset($_POST['data_retirada'])   ? $_POST['data_retirada']   : '',
                'data_devolucao'  => isset($_POST['data_devolucao'])  ? $_POST['data_devolucao']  : '',
                'id_colaborador'  => isset($_POST['id_colaborador'])  ? $_POST['id_colaborador']  : '',
                'quantidade'     => isset($_POST['quantidade'])     ? $_POST['quantidade']     : ''
            ];

            if (in_array('', $formulario)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Existem dados faltando! Verifique.'
                ];
                echo json_encode($resposta);
                exit;
            }

            if (!$this->equipamentoModel->verificarEstoque($formulario['id_equipamento'], $formulario['quantidade'])) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Estoque insuficiente para este produto!'
                ];
                echo json_encode($resposta);
                exit;
            }

            $this->model->inserir(
                $formulario['id_emprestimo'],
                $formulario['id_equipamento'],
                $formulario['data_retirada'],
                $formulario['data_devolucao'],
                $formulario['id_colaborador'],
                $formulario['quantidade'],
                $id_usuario
            );

            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Empréstimo registrado com sucesso!'
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
    //FUNCAO PARA LISTAR OS EMPRESTIMOS
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
                'mensagem' => 'Houve uma exceção no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    //FUNCAO PARA CANCELAR O EMPRESTIMO
    public function cancelar() {
        try {
            $id_emprestimo = isset($_POST['id_emprestimo']) ? $_POST['id_emprestimo'] : '';
            if (empty($id_emprestimo)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'O ID do empréstimo está faltando! Verifique.'
                ];
                echo json_encode($resposta);
                exit;
            }

            $resultado = $this->model->cancelarEmprestimo($id_emprestimo);

            if ($resultado['status'] == 'sucesso') {
                $resposta = [
                    'status' => 'sucesso',
                    'mensagem' => 'Empréstimo cancelado com sucesso!'
                ];
                echo json_encode($resposta);
            } else {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => $resultado['mensagem']
                ];
                echo json_encode($resposta);
            }
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma exceção no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
}
//TRATAMENTO DAS ROTAS
if (isset($_GET['acao'])) {
    $controller = new EmprestimosController();
    switch ($_GET['acao']) {
        case 'salvar':
            $controller->salvar();
            break;
        case 'listar':
            $controller->listar();
            break;
        case 'cancelar':
            $controller->cancelar();
            break;
    }
}
