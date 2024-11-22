<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Colaboradores</title>
    <link href="../../../assets/css/views.css" rel="stylesheet"><!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--BOOTSATRAP-->
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastro de Colaboradores</h1>
        <form id="form-colaborador" onsubmit="return false">
            <div class="row">
                <!--CAMPO DO ID-->
                <div class="col-md-6">
                    <label for="txt_idColaborador">ID Colaborador</label>
                    <input type="text" id="txt_idColaborador" value="NOVO" class="form-control" required readonly>
                </div>
                <!--CAMPO DO NOME-->
                <div class="col-md-6">
                    <label for="txt_nome">Nome</label>
                    <input type="text" id="txt_nome" class="form-control" required maxlength="60" placeholder="Nome" oninput="somenteTexto(this)">

                </div>
                <!--CAMPO DO CPF-->
                <div class="col-md-6">
                    <label for="txt_cpf">CPF</label>
                    <input type="text" id="txt_cpf" class="form-control" maxlength="14" required placeholder="000.000.000-00" oninput="mascararCPF(this)" onkeypress="return somenteNumeros(event)">
                </div>
                <!--CAMPO DATA NASCIMENTO-->
                <div class="col-md-6">
                    <label for="txt_datan">Data de Nascimento</label>
                    <input type="date" id="txt_datan" class="form-control" required onblur="validarDataNascimento(this)">

                </div>
            </div>
            <br> <!--ESPACAMENTO PARA OS BOTOES-->
            <!--CAMPO DOS BOTOES-->
            <div class="text-center">
                <button class="btn btn-success" onclick="Salvar()">Salvar</button>
                <a href="cadastrados.php" class="btn btn-primary">Ver Colaboradores Cadastrados</a>
                <button class="btn btn-danger" type="reset">Cancelar</button>
                <a href="../../../sistema.php" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
    <!--JQUERY E JS-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Colaboradores/index.js"></script>
</body>
</html>
