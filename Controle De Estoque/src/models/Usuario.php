<?php
//1° FUNCAO PARA TELA DE LOGIN
//2° 3° 4° FUNCAO PARA A TELA DO INDEX
//5° 6° 7° FUNCAO PARA A TELA DO CADASTRADOS
require_once '../services/BancoDeDados.php';
class Usuario {
    private $banco;
    public function __construct() {
        $this->banco = new BancoDeDados();
    }
    //FUNCAO PARA AUTENTICAR O USUARIO AO SISTEMA
    public function autenticar($usuario, $senha) {
        $sql = 'SELECT id_usuario, nome FROM usuarios WHERE usuario = ? AND senha = ?';
        $parametros = [$usuario, $senha];
        return $this->banco->consultar($sql, $parametros);
    }
    //FUNCAO PARA SALVAR O USUARIO
    public function inserir($id_usuario, $nome, $usuario, $senha) {
        $sql = 'INSERT INTO usuarios (id_usuario, nome, usuario, senha) VALUES (?, ?, ?, ?)';
        $parametros = [$id_usuario, $nome, $usuario, $senha];
        $this->banco->executarComando($sql, $parametros);
    }

    //FUNCAO PARA ATUALIZAR USUARIO NO BANCO
    public function atualizar($formulario) {
        $sql = 'UPDATE usuarios SET nome = ?, usuario = ?, senha = ? WHERE id_usuario = ?';
        $parametros = [
            $formulario['nome'],
            $formulario['usuario'],
            $formulario['senha'],
            $formulario['id_usuario']
        ];
        $this->banco->executarComando($sql, $parametros);
    }

    //FUNCAO PARA BUSCAR UM USUARIO PELO ID
    public function buscarPorId($id_usuario) {
        $sql = 'SELECT id_usuario, nome, usuario, senha FROM usuarios WHERE id_usuario = :id_usuario';
        $parametros = ['id_usuario' => $id_usuario];
        return $this->banco->consultar($sql, $parametros);
    }

    //FUNCAO PARA LISTAR OS USUARIOS
    public function listarTodos() {
        $sql = 'SELECT * FROM usuarios';
        return $this->banco->consultar($sql, [], true);
    }
    //FUNCAO PARA EXCLUIR USUARIO
    public function excluir($id_usuario) {
        $sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
        $parametros = [$id_usuario];
        $this->banco->executarComando($sql, $parametros);
    }
    //FUNCAO PARA VEIRIFICAR SE O USUARIO NAO ESTA COM EMPRESTIMO ATIVO
    public function verificarEmprestimosAtivos($id_usuario) {
        $sql = "SELECT COUNT(*) AS total FROM emprestimos WHERE id_usuario = ?";
        $parametros = [$id_usuario];
        $resultado = $this->banco->consultar($sql, $parametros, false);
        return $resultado['total'] > 0; 
    }
    

}
