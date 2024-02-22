
<!DOCTYPE html>
<html>
<head>
	<title>My Awesome Login Page</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<script>
function procurar(){
        var nome = document.getElementById("nome").value;
        // Adicione o valor do campo nome à URL como parâmetro de consulta
        window.location.href = "procura.php?nome=" + nome;
    }

</script>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-search"></i></span>
							</div>
							<input type="text" id="nome" class="form-control input_user" value="" placeholder="digite um nome">
						</div>
						
				
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="button" onclick="procurar()"  name="button" class="btn login_btn">procurar</button>
				   </div>
					</form>
				</div>
		
				
			</div>
		</div>
	</div>
</body>
</html>
