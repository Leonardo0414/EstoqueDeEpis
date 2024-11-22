<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="assets/css/index.css" rel="stylesheet">
</head>

<body>
    <form id="form-login" onsubmit="return false"> <!--FORMULARIO-->
        <div class="main-login"><!-- CONTAINER PARA O LOGIN AJUSTES CSS-->
     <!-- DEFINE O LADO DA IMAGEN E IMPORTA A IMAGEN-->
            <div class="left-login">
                <h1>Faça login</h1>
                <img src="assets/imagens/sistema/Login.svg" class="left-login-image" alt="Sistema De EPIs"> <!--IMAGEN-->
            </div>
            <!-- LADO DO CAMPO DE LOGIN-->
            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>
                    <!--CAMPO DO USUARIO-->
                    <div class="textfield">
                        <label for="txt_usuario">Usuário</label>
                        <input type="text" id="txt_usuario" placeholder="Seu Usuário" required>
                    </div>
                    <!--CAMPO SENH-->
                    <div class="textfield">
                        <label for="txt_senha">Senha</label>
                        <input type="password" id="txt_senha" placeholder="Sua Senha" required>
                    </div>
                    <!--CAMPO DO BOTAO-->
                    <button class="btn-login" onclick="Entrar()">Entrar</button>
                    <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024</p>
                </div>

            </div>
        </div>
    </form>


    <!--JQUERY E JS-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/index.js"></script>
</body>
</html>
