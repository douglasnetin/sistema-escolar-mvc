<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/css/Login.css">
    <title>Login</title>
    <style>
        /* Adicionando estilo para centralizar o formulário */
        .centered-form {
            margin-top: 60px;
        }
    </style>
</head>
<body>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if(isset($_SESSION['msgcad'])){
    echo $_SESSION['msgcad'];
    unset($_SESSION['msgcad']);
}
?>
<form method="POST" action="valida.php">
    <div class="container">
        <div class="row justify-content-center centered-form">
            <div class="col-md-4">
                    <div class="card-body">
                        <form action="" autocomplete="off">
						<div class="main-login2 main-center">
                            <div class="form-group">
                                <label for="usuario" class="cols-sm-2 control-label">Usuário:</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Digite o seu usuário">
                            </div>
                            <div class="form-group">
                                <label for="senha" class="cols-sm-2 control-label">Senha:</label>
                               <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite a sua senha">
                            </div>
                            
                        </form>
						 <input type="submit"  name="btnLogin" value="Acessar" class="btn">
                         <br>  
						 <div class="login-register-wrapper">
   						 <h3 class="login-register">esqueceu sua senha? <a href="cadastrar.php"> resgatar</a></h3>
						</div>
                    </div>
                
            </div>
        </div>
    </div>
</form>
</body>
</html>
