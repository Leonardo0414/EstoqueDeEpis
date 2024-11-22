<?php
//1°,2°3° 4° FUNCAO PARA O INDEX
//5°,6° FUNCAO PARA CADASTRADOS
require_once '../services/BancoDeDados.php';
class Colaborador {
    private $banco;
    public function __construct() {
        $this->banco = new BancoDeDados();
    }
    //FUNCAO PARA SALVAR COLABORADOR
    public function inserir($id_colaborador, $nome, $cpf, $nascimento) {
        $sql = 'INSERT INTO colaboradores (id_colaborador, nome, cpf, nascimento) VALUES (?, ?, ?, ?)';
        $parametros = [$id_colaborador, $nome, $cpf, $nascimento];
        $this->banco->executarComando($sql, $parametros);
    }

     //FUNCAO PARA ATUALIZAR O COLABORADOR
    public function atualizar($id_colaborador, $nome, $cpf, $nascimento) {
        $sql = 'UPDATE colaboradores SET nome = ?, cpf = ?, nascimento = ? WHERE id_colaborador = ?';
        $parametros = [$nome, $cpf, $nascimento, $id_colaborador];
        $this->banco->executarComando($sql, $parametros);
    }
        //FUNCAO PARA BUSCAR DADOS DO COLABORADOR  
    public function buscarPorId($id_colaborador) {
        $sql = 'SELECT id_colaborador, nome, cpf, nascimento FROM colaboradores WHERE id_colaborador = :id_colaborador';
        $resultado = $this->banco->consultar($sql, ['id_colaborador' => $id_colaborador]);
        return $resultado ? $resultado : null;
   }
       //FUNCAO PARA VERIFICAR O COLABORADOR NO EMPRESTIMO
       public function verificarEmprestimosAtivos($id_colaborador) {
        $sql = "SELECT COUNT(*) AS total FROM emprestimos WHERE id_colaborador = ?";
        $parametros = [$id_colaborador];
        $resultado = $this->banco->consultar($sql, $parametros, false);
        return $resultado['total'] > 0; 
    }
    //BUSCAR TODOS OS DADOS DO COLABORADOR
    public function selecionarTudo() {
        $sql = 'SELECT * FROM colaboradores';
        return $this->banco->consultar($sql, [], true);
    }
   //FUNCAO PARA EXCLUI COLABORADOR 
    public function excluir($id_colaborador) {
        $sql = 'DELETE FROM colaboradores WHERE id_colaborador = ?';
        $parametros = [$id_colaborador];
        $this->banco->executarComando($sql, $parametros);
    }


}
