<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link href="../../../assets/css/views.css" rel="stylesheet">  <!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    <!--BOOTSTRAP-->
</head>
<body>

<!-- CENTRALIZA O TITULO ClASS CONTAINER DO BOOTSTRAP-->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastro de Usuários</h1>
         <!--ABERTURA DE FORM-->
        <form id="form-usuario" onsubmit="return false">

                <!--CRIACAO DE 4 CAMPOS PARA OS DADOS-->
            <div class="row"><!--ROW ORGANIZA LABEL E CAIXA DE TEXTO 2 POSICAO-->
                <div class="col-md-6">
                    <label for="txt_idUsuario" >ID do Usuário</label>
                    <input type="text" class="form-control" id="txt_idUsuario" value="NOVO"  required readonly>
                </div>

                <div class="col-md-6">
                    <label for="txt_nome">Nome</label>
                    <input type="text" class="form-control" id="txt_nome" placeholder="Digite o nome Usuario" required maxlength = "50">
                </div>

                <div class="col-md-6">
                    <label for="txt_usuario">Usuário</label>
                    <input type="text" class="form-control" id="txt_usuario" placeholder="Digite Seu Usuário" required>
                </div>

                <div class="col-md-6">
                    <label for="txt_senha">Senha</label>
                    <input type="text" class="form-control" id="txt_senha" placeholder="Digite a Senha" required>
                </div>
            </div>
            <br><!--ESPACAMENTO PARA OS BOTOES-->
              <!--CAMPOS DOS BOTAO-->
            <div class="text-center">
                <button class="btn btn-success" onclick="Salvar()">Cadastrar Usuário</button>
                <a href="cadastrados.php"       class="btn btn-primary">Ver Usuarios Cadastrados</a>
                <button class="btn btn-danger"  type="reset">Cancelar</button>
                <a href="../../../sistema.php" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

<!-- JQUERY E FUNCOES-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Usuarios/index.js"></script>
</body>
</html>
