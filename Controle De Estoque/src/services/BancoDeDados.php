<?php
class BancoDeDados {
    private $conexao;
    public function __construct() {
        // $this->conexao = new PDO('mysql:host=localhost;port=3307;dbname=db_epis;charset=utf8mb4', 'root', '');
        $this->conexao = new PDO('mysql:host=localhost;dbname=db_epis;charset=utf8mb4', 'root', '');
    }

    //INICIAR  TRANSACAO
    public function iniciarTransacao() {
        $this->conexao->beginTransaction();
    }
    //CONFIRMAR TRANSACAO
    public function confirmarTransacao() {
        $this->conexao->commit();
    }
    //VOLTAR TRANSACAO
    public function voltarTransacao() {
        $this->conexao->rollback();
    }
    //EXECUTA COMANDO INSERT,DELETE,AUTUALIZAR
    public function executarComando($sql, $parametros = []) {
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($parametros);
    }
    //CONSULTA
    public function consultar($sql, $parametros = [], $fetchAll = false) {
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($parametros);

        if ($fetchAll) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); //RETORNA TODOS OS DADOS
        } else {
            return $stmt->fetch(PDO::FETCH_ASSOC);//RETORA UM DADO
        }
    }
}
