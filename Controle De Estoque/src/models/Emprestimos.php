<?php
//1° 2°FUNCAO PARA O INDEX
//3° 4° FUNCAO PARA CADASTRADOS
require_once '../services/BancoDeDados.php';
class Emprestimos {
    private $banco;
    public function __construct() {
        $this->banco = new BancoDeDados();
    }
    //FUNCAO PARA SALVAR O  EMPRESTIMO  VERIFICA TRANSACAO E ATUALIZA O ESTOQUE
    public function inserir($id_emprestimo, $id_equipamento, $data_retirada, $data_devolucao, $id_colaborador, $quantidade, $id_usuario) {
        try {
            $this->banco->iniciarTransacao();
            $sql = "INSERT INTO emprestimos (id_emprestimo, data_retirada, data_devolucao, cancelado, quantidade, id_colaborador, id_equipamento, id_usuario) 
                    VALUES (?, ?, ?, 'Ativo', ?, ?, ?, ?)";
            $parametros = [$id_emprestimo, $data_retirada, $data_devolucao, $quantidade, $id_colaborador, $id_equipamento, $id_usuario];
            $this->banco->executarComando($sql, $parametros);
            $this->atualizarEstoque($id_equipamento, $quantidade);
            $this->banco->confirmarTransacao();
        } catch (PDOException $erro) {
            $this->banco->voltarTransacao();
            throw new Exception('Houve uma exceção no banco de dados: ' . $erro->getMessage());
        }
    }
    //FUNCAO PARA ATUALIZAR O ESTOQUE
    private function atualizarEstoque($idEquipamento, $quantidade) {
        $sql = "UPDATE equipamentos SET qtd_estoque = qtd_estoque - ? WHERE id_equipamento = ?";
        $parametros = [$quantidade, $idEquipamento];
        $this->banco->executarComando($sql, $parametros);
    }
    //FUNCAO PARA SELECIONAR NA TABELAS DADOS PARA EMPRESTIMO
    public function selecionarTudo() {
        try {
            $sql = "SELECT emprestimos.*, 
                           equipamentos.descricao AS descricao, 
                           colaboradores.nome AS nome_colaborador,
                           emprestimos.cancelado AS situacao
                    FROM emprestimos
                    INNER JOIN equipamentos USING(id_equipamento)
                    INNER JOIN colaboradores USING(id_colaborador)
                    ORDER BY emprestimos.cancelado DESC, emprestimos.data_retirada DESC";
            return $this->banco->consultar($sql, [], true);
        } catch (PDOException $erro) {
            throw new Exception('Houve uma exceção no banco de dados: ' . $erro->getMessage());
        }
    }
    //FUNCAO PARA CANCELAR O EMPRESTIMO
    public function cancelarEmprestimo($id_emprestimo) {
        try {
            $this->banco->iniciarTransacao();
            $sql = "SELECT quantidade, id_equipamento FROM emprestimos WHERE id_emprestimo = ?";
            $emprestimo = $this->banco->consultar($sql, [$id_emprestimo], false);
            if (!$emprestimo) {
                throw new Exception("Empréstimo não encontrado.");
            }
            $sql = "UPDATE emprestimos SET cancelado = 'Cancelado' WHERE id_emprestimo = ?";
            $this->banco->executarComando($sql, [$id_emprestimo]);

            $sql = "UPDATE equipamentos SET qtd_estoque = qtd_estoque + ? WHERE id_equipamento = ?";
            $this->banco->executarComando($sql, [$emprestimo['quantidade'], $emprestimo['id_equipamento']]);

            $this->banco->confirmarTransacao();
            return ['status' => 'sucesso', 'mensagem' => 'Empréstimo cancelado com sucesso!'];
        } catch (Exception $erro) {
            $this->banco->voltarTransacao();
            return ['status' => 'erro', 'mensagem' => $erro->getMessage()];
        }
    }
}
