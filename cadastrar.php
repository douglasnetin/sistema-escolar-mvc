<?php
session_start();
ob_start();

// Função para validar o email
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Verificar se o formulário foi submetido
if(isset($_POST['btnCadUsuario'])) {
    // Verificar se todos os campos estão preenchidos
    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['usuario']) || empty($_POST['senha'])) {
        $_SESSION['msg'] = "Por favor, preencha todos os campos.";
    } else {
        // Conectar ao banco de dados
        include_once 'conexao.php';

        // Escapar os valores dos campos para prevenir SQL injection
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);

        // Verificar se o email é válido
        if(!validarEmail($email)) {
            $_SESSION['msg'] = "Por favor, insira um endereço de e-mail válido.";
        } else {
            // Verificar se a senha tem pelo menos 8 caracteres
            if(strlen($senha) < 8) {
                $_SESSION['msg'] = "A senha deve ter pelo menos 8 caracteres.";
            } else {
                // Verificar se o usuário já existe no banco de dados
                $query_verificar_usuario = "SELECT * FROM usuario WHERE usuario = '$usuario'";
                $resultado_verificar_usuario = mysqli_query($conn, $query_verificar_usuario);
                if(mysqli_num_rows($resultado_verificar_usuario) > 0) {
                    $_SESSION['msg'] = "Este usuário já está em uso. Por favor, escolha outro.";
                } else {
                    // Hash da senha
                    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                    // Inserir os dados na tabela de usuários
                    $query_inserir_usuario = "INSERT INTO usuario (nome, email, usuario, senha) VALUES ('$nome', '$email', '$usuario', '$senha_hash')";
                    $resultado_inserir_usuario = mysqli_query($conn, $query_inserir_usuario);
                    
                    if($resultado_inserir_usuario) {
                        $_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
                        header("Location: /Adm/index.php");
                        exit(); // Termina o script após o redirecionamento
                    } else {
                        $_SESSION['msg'] = "Erro ao cadastrar o usuário.";
                    }
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
}

body {
    width: 100%;    
    background: linear-gradient(45deg, rgb(212, 175, 55) 0%, rgb(212, 175, 55) 25%, #474747 50%, #000000 75%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}


	.container {
	background-color: #fafafa;
	border-radius: 10px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
	width: 400px;
	max-width: 100%;
	overflow: hidden;
	}

	.header {
	background-color: #eee;
	padding: 20px;
	}

	.form {
	padding: 20px;
	}

	.form-control {
	margin-bottom: 10px;
	padding-bottom: 20px;
	position: relative;
	}

	.form-control label {
	display: inline-block;
	margin-bottom: 5px;
	}

	.form-control input {
	border: 2px solid #f0f0f0;
	display: block;
	border-radius: 10px;
	font-size: 14px;
	width: 100%;
	padding: 10px;
	}

	.form-control i {
	position: absolute;
	top: 45px;
	right: 10px;
	visibility: hidden;
	}

	.form-control small {
	position: absolute;
	bottom: 0;
	left: 0;
	visibility: hidden;
	}

	#btnLogin {
	background-color: #333;
	color: #fff;
	font-size: 14px;
	width: 100%;
	border-radius: 10px;
	padding: 10px;
	cursor:pointer;
	}

	/* Error and Success */
	.form-control.success input {
	border-color: #2ecc71;
	}

	.form-control.error input {
	border-color: #e74c3c;
	}

	.form-control.success i.fa-check-circle {
	color: #2ecc71;
	visibility: visible;
	}

	.form-control.error i.fa-exclamation-circle {
	color: #e74c3c;
	visibility: visible;
	}

	.form-control.error small {
	visibility: visible;
	color: #e74c3c;
	}
	.toast {
    visibility: hidden;
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #333;
    color: #fff;
    padding: 15px;
    border-radius: 5px;
    z-index: 1;
}
</style>
<body>
    <div class="container">
      	<div class="header">
        	<h2>Criar Uma Conta</h2>
      	</div>

		  <form id="form" class="form" method="post" action="#">
    <div class="form-control">
        <label for="usuario" class="cols-sm-2 control-label">Usuario</label>
        <input type="text" required maxlength="12" name="usuario" id="usuario"  placeholder="Digite seu Usuário"/>
        <i class="fas fa-exclamation-circle"></i>
        <i class="fas fa-check-circle"></i>
        <small>Mensagem de erro</small>
    </div>

    <div class="form-control">
        <label for="name">Nome</label> 
        <input type="text" required maxlength="18"  name="nome" id="name"  placeholder="Digite seu nome"/>
        <i class="fas fa-exclamation-circle"></i>
        <i class="fas fa-check-circle"></i>
        <small>Mensagem de erro</small>
    </div>

    <div class="form-control">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Digite seu email.." />
        <i class="fas fa-exclamation-circle"></i>
        <i class="fas fa-check-circle"></i>
        <small>Mensagem de erro</small>
    </div>

    <div class="form-control">
        <label for="password">Senha</label>
        <input type="password" name="senha" id="password" placeholder="Digite sua senha..."/>
        <i class="fas fa-exclamation-circle"></i>
        <i class="fas fa-check-circle"></i>
        <small>Mensagem de erro</small>
    </div>

    <input type="submit" id="btnLogin" name="btnCadUsuario" value="Cadastrar" class="btn">
    Já tem uma conta? <a href="login.php">Fazer login</a>
</form>

		</div>
		<div id="toast" class="toast"></div>
	<script src="https://kit.fontawesome.com/f9e19193d6.js" crossorigin="anonymous"></script>
	<script>
    function showToast(message) {
        var toast = document.getElementById('toast');
        toast.textContent = message;
        toast.style.visibility = 'visible';
        setTimeout(function() {
            toast.style.visibility = 'hidden';
        }, 3000);
    }

    <?php
    if(isset($_SESSION['msg'])) {
        echo "showToast('" . $_SESSION['msg'] . "');";
        unset($_SESSION['msg']);
    }
    if(isset($_SESSION['msgcad'])) {
        echo "showToast('" . $_SESSION['msgcad'] . "');";
        unset($_SESSION['msgcad']);
    }
    ?>
</script>
</body>
</html>