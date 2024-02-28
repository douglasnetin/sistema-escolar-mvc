<?php 
session_start();
if(empty($_SESSION['id'])){
	$_SESSION['msg'] = "Área restrita";
	header("Location: login.php");	
}
include ('conexao.php');
$result_alunos = "SELECT * FROM `alunos` WHERE id = ".$_SESSION['id'];
$resultado_alunos = mysqli_query($conn, $result_alunos);
if($resultado_alunos){
	$row_alunos = mysqli_fetch_assoc($resultado_alunos);
		$_SESSION['nome'] = $row_alunos['nome'];
		$_SESSION['matricula'] = $row_alunos['matricula'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<title>Document</title>

</head>
<body class="flex w-screen h-screen p-0 space-x-6 bg-gray-300">

<div class="flex flex-col items-center w-16 h-full overflow-hidden text-gray-400 bg-gray-900 rounded">
		<a class="flex items-center justify-center mt-3" href="#">
			<svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
				<path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
			</svg>
		</a>
		<div class="flex flex-col items-center mt-3 border-t border-gray-700">
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				 	<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
				</svg>
			</a>
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
				</svg>
			</a>
			<a class="flex items-center justify-center w-12 h-12 mt-2 text-gray-200 bg-gray-700 rounded" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
				</svg>
			</a>
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
				</svg>
			</a>
		</div>
		<div class="flex flex-col items-center mt-2 border-t border-gray-700">
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
				</svg>
			</a>
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
				</svg>
			</a>
			<a class="relative flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
				</svg>
				<span class="absolute top-0 left-0 w-2 h-2 mt-2 ml-2 bg-indigo-500 rounded-full"></span>
			</a>
		</div>
		<button id="usurio" data-bs-toggle="modal" data-bs-target="#exampleModal" class="flex items-center justify-center w-16 h-16 mt-auto bg-gray-800 hover:bg-gray-700 hover:text-gray-300" href="#">
			<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
			</svg>
		</button>
	</div>
	<!-- Component End  -->
	
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações do usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
		<div class="modal-body">
			<div class="d-flex flex-column-reverse flex-lg-row row">
				<div class="form-group">
					<div class="col-lg-8">
						<div class="input-group input-group-sm col-lg-5">                              
							<label class="input-group-addon" >Nome: </label>
							<label><?php echo $_SESSION['nome'];?> </label>                              
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex flex-column-reverse flex-lg-row row">
				<div class="form-group">
					<div class="col-lg-8">
						<div class="input-group input-group-sm col-lg-5">              
							<label class="input-group-addon" >Matricula: </label>
							<label><?php echo $_SESSION['matricula'];?> </label>
						</div>
					</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
        <button type="button" id="editar" class="btn btn-primary" >Editar</button>
		<button type="button" id="salvar" class="btn btn-success" >Salvar</button>
        <button id="deslogar" type="button" class="btn btn-secondary">Deslogar</button>
      </div>
    </div>
  </div>
</div>

</body>
<script>
$(document).ready(function(){
	$("#salvar").hide();
    $("#deslogar").click(function(){
		window.location.href = "sair.php";// Substitua "pagina.html" pelo caminho da sua página
    });
	$("#editar").click(function(){
        var nome = "<?php echo $_SESSION['nome'];  ?>";
		$(".modal-body").empty().append(
			"<input id='nome-modal' type='text' class='form-control' value='"+nome+"'> "
		);
		$("#salvar").show();
		$("#editar").hide();

	})
	$("#salvar").click(function(){

	var nomeModal=$('#nome-modal').val(); 
	var id= "<?php echo $_SESSION['id'];  ?>"
	$.ajax({
		type:'POST',
		url:"crud.php",
		data:{
			nome:nomeModal,
			id:id,
			acao:"E"
		},
		success: function(data){
			var i = JSON.parse(data);
			//colocar aqui a mensagem que retorna do php
			alert(i.mensagem);
			debugger;
			window.location.reload();
		}
	
	})
	})
});
</script>
</html>