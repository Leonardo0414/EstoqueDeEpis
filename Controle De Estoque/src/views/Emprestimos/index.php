<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empréstimos</title>
    <link href="../../../assets/css/views.css" rel="stylesheet"><!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--BOOTSTRAP-->
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Empréstimos</h1>
        <!--FORMULARIO-->
        <form id="form-emprestimos" onsubmit="return false">
            <div class="row">
                <!--CAMPO DO ID-->
                <div class="col-md-6">
                    <label for="txt_idEmprestimo">ID do Empréstimo</label>
                    <input type="text" class="form-control" id="txt_idEmprestimo" value="NOVO" required readonly>
                </div>

                <!--LISTA DOS EPIS-->
                <div class="col-md-6">
                    <label for="list_equipamentos">EPI</label>
                    <select class="form-control" id="list_equipamentos">
                        <option value="">Selecione o EPI</option>
                        <!--IMPRESSOS PELO JS-->
                    </select>
                </div>

                <!--CAMPO DE DATA DE RETIRADA-->
                <div class="col-md-6">
                    <label for="txt_retirada">Data de Retirada</label>
                    <input type="date" class="form-control" id="txt_retirada">
                </div>
                <!--CAMPO DE DTA DE DEVOLUCAO-->
                <div class="col-md-6">
                    <label for="txt_devolucao">Data de Devolução</label>
                    <input type="date" class="form-control" id="txt_devolucao">
                </div>

                <!--LISTA DOS COLABORADORES-->
                <div class="col-md-6">
                    <label for="list_colaboradores">Nome do Colaborador</label>
                    <select class="form-control" id="list_colaboradores">
                        <option value="">Selecione o Colaborador</option>
                        <!--IMPRESSOS PELO JS-->
                    </select>
                </div>

                <!--CAMPO DA QUANTIDADE-->
                <div class="col-md-6">
                    <label for="txt_quantidade">Quantidade</label>
                    <input type="number" class="form-control" id="txt_quantidade" placeholder="Quantidade">
                </div>              
            </div>

            <!--CAMPO DOS BOTOES-->
            <div class="text-center mt-3">
                <button class="btn btn-success" onclick="salvarEmprestimo()">Cadastrar Empréstimo</button>
                <a href="cadastrados.php" class="btn btn-primary">Ver Empréstimos Cadastrados</a>
                <button class="btn btn-danger" type="reset">Cancelar</button>
                <a href="../../../sistema.php" class="btn btn-primary">Voltar</a>
            </div>


        </form>
    </div>

    <!--JS E JQUERY-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Emprestimos/index.js"></script>
</body>
</html>
