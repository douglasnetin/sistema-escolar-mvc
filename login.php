<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Celke - Login</title>
    <style>
        * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: "Poppins", sans-serif;
}

body {
  width: 100%;
  min-height: 100vh;
  background: linear-gradient(45deg, rgb(212, 175, 55) 0%, rgb(212, 175, 55) 25%, #474747 50%, #000000 75%);
  display: flex;
  justify-content: center;
  align-items: center;
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

.btnLogin {
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
</head>
<body>
<div class="container">
      <div class="header">
        <h2>Login</h2>
      </div>

      <form method="POST" id="form" class="form" action="valida.php">
            <div class="form-control">
                <label for="usuario">Nome de usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu nome de usuário..." />
                <i class="fas fa-exclamation-circle"></i>
                <i class="fas fa-check-circle"></i>
                <small>Mensagem de erro</small>
            </div>

            <div class="form-control">
                <label for="password">Senha</label>
                <input type="password" id="password" name="senha" placeholder="Digite sua senha..." />
                <i class="fas fa-exclamation-circle"></i>
                <i class="fas fa-check-circle"></i>
                <small>Mensagem de erro</small>
            </div>
            <input type="submit" class="btnLogin"  name="btnLogin" value="Acessar" class="btn">	
            <br>
        </form>
        <div id="toast" class="toast"></div>
</div>
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
