<?php
//1°,2° FUNCAO PARA TELA DO INDEX
//2,4° FUNCAO PARA TELA DE CADASTRADOS
require_once '../models/Equipamentos.php';
class EquipamentosController {
    private $model;
    public function __construct() {
        $this->model = new Equipamentos();
    }
    // FUNCAO PARA SALVAR EQUIPAMENTOS
    public function salvar() {
        try {
            $formulario = [
                'id_equipamento' => isset($_POST['id_equipamento']) ? $_POST['id_equipamento'] : '',
                'descricao' => isset($_POST['descricao']) ? $_POST['descricao'] : '',
                'quantidade' => isset($_POST['quantidade']) ? $_POST['quantidade'] : ''
            ];
            if (in_array('', $formulario)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Existem Dados Faltando! Verifique'
                ];
                echo json_encode($resposta);
                exit;
            }

            // PROCESSAMENTO DO CODIGO DE BARRAS
            $barras_url = $_POST['imgbarra'];
            $barras_path = '../../assets/imagens/equipamentos/codbarras_' . $formulario['id_equipamento'] . '.png';
            file_put_contents($barras_path, file_get_contents($barras_url));
            $formulario['imgbarra'] = str_replace('../../', '', $barras_path);

            // PROCCESSAMENTO DA FOTO EQUIPAMENTO
            if (isset($_FILES['img_foto']) && $_FILES['img_foto']['error'] == UPLOAD_ERR_OK) {
                $foto_nome = 'foto_' . $formulario['id_equipamento'] . '_' . basename($_FILES['img_foto']['name']);
                $foto_path = '../../assets/imagens/equipamentos/' . $foto_nome;
                move_uploaded_file($_FILES['img_foto']['tmp_name'], $foto_path);
                $formulario['imgfoto'] = str_replace('../../', '', $foto_path);
            } else {
                $formulario['imgfoto'] = ''; 
            }
            //ATUALIZAR IMAGEN
            $registroExistente = $this->model->buscarPorId($formulario['id_equipamento']);

            if ($registroExistente) {
                $this->atualizar($formulario);
            } else {
                $this->model->inserir(
                    $formulario['id_equipamento'],
                    $formulario['descricao'],
                    $formulario['imgbarra'],
                    $formulario['imgfoto'],
                    $formulario['quantidade']
                );

                $resposta = [
                    'status' => 'sucesso',
                    'mensagem' => 'Equipamento Cadastrado Com Sucesso!'
                ];
                echo json_encode($resposta);
                exit;
            }
        } catch (PDOException $erro) {
            $resposta = [
                'status' => 'erro',
                'mensagem' => 'Houve uma exceção no banco de dados: ' . $erro->getMessage()
            ];
            echo json_encode($resposta);
        }
    }
    //FUNCAO PARA ATUALIZAR EQUIPAMENTO
    public function atualizar($formulario) {
  
        try {
        if (isset($_FILES['imgfoto']) && $_FILES['imgfoto']['error'] == UPLOAD_ERR_OK) {
            $foto_nome = 'foto_' . $formulario['id_equipamento'] . '_' . basename($_FILES['imgfoto']['name']);
            $foto_path = '../../assets/imagens/equipamentos/' . $foto_nome;
            move_uploaded_file($_FILES['imgfoto']['tmp_name'], $foto_path);
            $formulario['imgfoto'] = str_replace('../../', '', $foto_path);
        } else {
            $formulario['imgfoto'] = ''; 
        }
            
            $banco = new BancoDeDados();
            $sql = 'UPDATE equipamentos SET descricao = ?, imgbarra = ?, imgfoto = ?, qtd_estoque = ? WHERE id_equipamento = ?';
            $parametros = [
                $formulario['descricao'],
                $formulario['imgbarra'],
                $formulario['imgfoto'],
                $formulario['quantidade'],
                $formulario['id_equipamento']
            ];
            $banco->executarComando($sql, $parametros);

            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Equipamento atualizado com sucesso!'
                
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


    //FUNCAO PARA REMOVER EQUIPAMENTO
    public function remover() {
        try {
            $id_equipamento = isset($_POST['id_equipamento']) ? $_POST['id_equipamento'] : '';
    
            if (empty($id_equipamento)) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'O ID do EPI está faltando!'
                ];
                echo json_encode($resposta);
                exit;
            }
    
            // VERIFICA SE O EQUIPAMENTO POSSUI EMPRESTIMO ATIVO
            $emprestimosRegistrados = $this->model->verificarEmprestimosAtivos($id_equipamento);
    
            if ($emprestimosRegistrados) {
                $resposta = [
                    'status' => 'erro',
                    'mensagem' => 'Não é Possível Excluir O Equipamento, Pois Ele Possui Empréstimos Registrados!'
                ];
                echo json_encode($resposta);
                exit;
            }
    
            //EXCLUI O EQUIPAMENTO
            $this->model->excluir($id_equipamento);
    
            $resposta = [
                'status' => 'sucesso',
                'mensagem' => 'Equipamento removido com sucesso!'
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
    //FUNCAO PARA LISTA O EQUIPAMENTOS
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
}

if (isset($_GET['acao'])) {
    $controller = new EquipamentosController();

    switch ($_GET['acao']) {
        case 'salvar':
            $controller->salvar();
            break;
        case 'remover':
            $controller->remover();
            break;
        case 'listar':
            $controller->listar();
            break;
    }
}
