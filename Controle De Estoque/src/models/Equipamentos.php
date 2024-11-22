<?php
//°1 FUNCAO TELA DO INDEX
//°2 3° 4° 5° FUNCAO TELA DOS CADASTRADOS
//6° FUNCAO PARA TELA DE EMPRESTIMOS
require_once '../services/BancoDeDados.php';
class Equipamentos {
    private $banco;
    public function __construct() {
        $this->banco = new BancoDeDados();
    }
    //FUNCAO PARA SALVAR EQUIOPAMENTO
    public function inserir($id_equipamento, $descricao, $imgbarra, $imgfoto, $quantidade) {
        $sql = 'INSERT INTO equipamentos (id_equipamento, descricao, imgbarra, imgfoto, qtd_estoque)
                VALUES (?, ?, ?, ?, ?)';
        $parametros = [$id_equipamento, $descricao, $imgbarra, $imgfoto, $quantidade];
        $this->banco->executarComando($sql, $parametros);
    }
    

    //FUNCAO PARA LISTAR OS EQUIPAMENTOS
    public function selecionarTudo() {
        $sql = 'SELECT * FROM equipamentos';
        return $this->banco->consultar($sql, [], true);
    }

    //BUSCAR O EQUIPAMENTO PELO ID
    public function buscarPorId($id_equipamento) {
        $sql = 'SELECT * FROM equipamentos WHERE id_equipamento = ?';
        $parametros = [$id_equipamento];
        return $this->banco->consultar($sql, $parametros, false);
    }

    public function excluir($id_equipamento) {
        $sql = 'DELETE FROM equipamentos WHERE id_equipamento = ?';
        $parametros = [$id_equipamento];
        $this->banco->executarComando($sql, $parametros);
    }

    public function verificarEmprestimosAtivos($id_equipamento) {
        // Verifica se há qualquer empréstimo relacionado ao equipamento
        $sql = "SELECT COUNT(*) AS total FROM emprestimos WHERE id_equipamento = ?";
        $parametros = [$id_equipamento];
        $resultado = $this->banco->consultar($sql, $parametros, false);
        return $resultado['total'] > 0; 
    }
    
    //FUNCAO VERIFICAR ESTOQUE TELA DE EMPRESTIMOS
    public function verificarEstoque($id_equipamento, $quantidade) {
        $sql = 'SELECT qtd_estoque FROM equipamentos WHERE id_equipamento = ?';
        $parametros = [$id_equipamento];
        $dados = $this->banco->consultar($sql, $parametros, false);
        return ($dados && $dados['qtd_estoque'] >= $quantidade);
    }

}
