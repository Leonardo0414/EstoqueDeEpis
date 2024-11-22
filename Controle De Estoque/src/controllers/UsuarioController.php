<?php
//TODAS FUNCOES COM LOGICA DE PASSO A PASSO DO SISTEMA
//1° FUNCAO PARA TELA DE LOGIN
//2° FUNCAO PARA TELA DO SISTEMA
//3°,4°,5° FUNCAO PARA A TELA DE INDEX DE USUARIO
//6°,7° FUNCAO PARA A TELA DE CADASTRADOS NA TALBELA
require_once '../models/Usuario.php';
class UsuarioController {
    private $model;
    public function __construct() {
        $this->model = new Usuario();
    }
//FUNCAO PARA LOGAR O USUARIO
    public function login() {
        //VALIDA AS VARIAVEIS
        $usuario    = $_POST['usuario']  ? $_POST['usuario']  : '';
        $senha      = $_POST['senha']    ? $_POST['senha']    : '';
        if (empty($usuario) || empty($senha)) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Existem Campos Vazios! Verifique.'
            ];
            echo json_encode($resposta);
            exit;
        }
        try {
            $acesso = $this->model->autenticar($usuario, $senha);
            if ($acesso) {
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $acesso['id_usuario'];
                $resposta = [
                    'status' => 'sucesso'
                ];
                echo json_encode($resposta);
            } else {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Usuário ou Senha Incorretos! Verifique'
                ];
                echo json_encode($resposta);
            }
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma exceção no Banco De Dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }

    //FUNCAO PARA DESLOGAR O USUARIO DO SISTEMA
    public function deslogar() {
        session_start();
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }

    //FUNCAO PARA SALVAR OS USUARIO
    public function salvar() {
        $formulario = [
            'id_usuario' =>  isset($_POST['id_usuario'])  ? $_POST['id_usuario'] : '',
            'nome' =>        isset($_POST['nome'])        ? $_POST['nome'] : '',
            'usuario' =>     isset($_POST['usuario'])     ? $_POST['usuario'] : '',
            'senha' =>       isset($_POST['senha'])       ? $_POST['senha'] : '',
        ];
        if (in_array('', $formulario)) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Existem Dados Faltando! Verifique.'
            ];
            echo json_encode($resposta);
            exit;
        }
        try {
            $this->model->inserir($formulario['id_usuario'], $formulario['nome'], $formulario['usuario'], $formulario['senha']);
            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Usuário Cadastrado com Sucesso!'
            ];
            echo json_encode($resposta);
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve um Excessao No Banco de Dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    //FUNCAO PARA BUSCAR DADOS DO USUARIO PELO ID
    public function buscar() {
        $id_usuario = $_GET['id_usuario'] ?? '';

        if (empty($id_usuario)) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'O ID do Usuário está faltando!'
            ];
            echo json_encode($resposta);
            exit;
        }

        try {
            $dados = $this->model->buscarPorId($id_usuario);

            if ($dados) {
                $resposta = [
                    'status' => 'sucesso',
                    'dados' => $dados
                ];
                echo json_encode($resposta);
            } else {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Usuário não encontrado.'
                ];
                echo json_encode($resposta);
            }
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Erro ao buscar o usuário: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    //FUNCAO PARA ATULIZAR O USUARIO
    public function atualizar() {
        $formulario = [
            'id_usuario' => $_POST['id_usuario'] ?? '',
            'nome' => $_POST['nome'] ?? '',
            'usuario' => $_POST['usuario'] ?? '',
            'senha' => $_POST['senha'] ?? ''
        ];

        if (in_array('', $formulario)) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Existem Dados Faltando! Verifique.'
            ];
            echo json_encode($resposta);
            exit;
        }

        try {
            $this->model->atualizar($formulario);

            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Usuário atualizado com sucesso!'
            ];
            echo json_encode($resposta);
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Erro ao atualizar o usuário: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }


//FUNCAO PARA LISTAR OS USUARIO NA TABELA
    public function listar() {
        try {
            $dados = $this->model->listarTodos();
            $resposta = [
                'status' => 'sucesso',
                'dados' => $dados
            ];
            echo json_encode($resposta);
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Erro ao listar usuários: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    //FUNCAO PARA DELETAR O USUARIO
    public function deletar() {
        session_start();
        $id_usuario = $_POST['id_usuario'] ?? '';
        if (empty($id_usuario)) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'O ID do Usuário está faltando!'
            ];
            echo json_encode($resposta);
            exit;
        }

        try {
        // NAO DEIXA EXCLUIR USUARIO LOGADO
        if ($_SESSION['id_usuario'] == $id_usuario) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Você Não Pode Excluir o Usuário Atualmente Logado!'
            ];
            echo json_encode($resposta);
            exit;
        }
        // VERIFICAR SE O USUARIO POSSUI EMPRESTIMOMS ATIVOS
        $emprestimosAtivos = $this->model->verificarEmprestimosAtivos($id_usuario);
        if ($emprestimosAtivos) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Não é Possível Excluir o Usuário Pois Ele Possui Empréstimos Ativos!'
            ];
            echo json_encode($resposta);
            exit;
        }
            $this->model->excluir($id_usuario);
            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Usuário Removido com Sucesso!'
            ];
            echo json_encode($resposta);
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Erro ao remover o usuário: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }


 
}
//CONTROLE DE ROTAS
if (isset($_GET['acao'])) {
    $controller = new UsuarioController();

    switch ($_GET['acao']) {
        case 'login':
            $controller->login();
            break;
        case 'salvar':
            $controller->salvar();
            break;
        case 'listar':
            $controller->listar();
            break;
        case 'deletar':
            $controller->deletar();
            break;
        case 'buscar':
            $controller->buscar();
            break;
        case 'atualizar':
            $controller->atualizar();
            break;
        case 'deslogar':
            $controller->deslogar();
            break;
    }
}
