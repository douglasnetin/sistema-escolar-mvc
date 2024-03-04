<?php 
session_start();

// Check if user is logged in
if(empty($_SESSION['id'])){
    $_SESSION['msg'] = "Área restrita";
    header("Location: login.php");    
}

// Check if 'selecao' is submitted via POST or GET
if(isset($_POST['selecao'])) {
    $selecao = $_POST['selecao'];
    $_SESSION['selecao'] = $selecao;
} elseif(isset($_GET['selecao'])) {
    $selecao = $_GET['selecao'];
    $_SESSION['selecao'] = $selecao;
} else {
    // Initialize 'selecao' session variable if not submitted
    $_SESSION['selecao'] = 'home';
}
include 'conexao.php';
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
		<a class="flex items-center justify-center mt-3" href="index.php">
			<svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
				<path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
			</svg>
		</a>
		<div class="flex flex-col items-center mt-3 border-t border-gray-700">
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="administrativo.php?selecao=home">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				 	<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
				</svg>
			</a>
			<a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700 hover:text-gray-300" href="#">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
				</svg>
			</a>
			<a class="flex items-center justify-center w-12 h-12 mt-2  rounded hover:bg-gray-700 hover:text-gray-300" href="#">
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
	<?php
if(isset($_SESSION['selecao']) && $_SESSION['selecao'] === 'home') {
?>
	<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mt-7.5 grid grid-cols-12 gap-4 md:gap-6 2xl:gap-7.5">
              <!-- ===== Leads Report Start ===== -->
              <div class="col-span-12">
                <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                  <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                      <div>
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                         Agendamentos
                        </h2>
                      </div>

                      
                    </div>
                  </div>

                  <div class="border-b border-stroke px-4 pb-5 dark:border-strokedark md:px-6 xl:px-7.5">
                    <div class="flex items-center gap-3">

                      <div class="w-6/12 2xsm:w-5/12 md:w-8/12">
                        <span class="font-medium">Nome</span>
                      </div>

                      <div class="w-6/12 2xsm:w-5/12 md:w-8/12">
                        <span class="font-medium">Data</span>
                      </div>

                      <div class=" w-6/12 md:block xl:w-8/12">
                        <span class="font-medium">Hora</span>
                      </div>

                      <div class="w-6/12 2xsm:w-5/12 md:w-8/12">
                        <span class="font-medium">Status</span>
                      </div>

                      <div class="w-6/12 2xsm:w-5/12 md:w-8/12">
                        <span class="font-medium">Criação</span>
                      </div>

                      <div class="w-6/12 2xsm:w-5/12 md:w-1/12">
                        <span class="font-medium">Actions</span>
                      </div>
					  
                    </div>
                  </div>

                  <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex flex-col gap-7">
					<?php

$obterNivel = "SELECT nivel FROM usuario WHERE id =" . $_SESSION['id'];
$resultadoNivel = mysqli_query($conn, $obterNivel);

if($resultadoNivel) {
    $row_nivel = mysqli_fetch_assoc($resultadoNivel);
    $_SESSION['nivel'] = $row_nivel['nivel'];
}

$obterAgendamento = "SELECT u.nome,
                     a.data_agendamento, 
                     a.hora_agendamento, 
                     a.status_agendamento, 
                     a.d_criacao  
                     FROM agendamento a
                     INNER JOIN usuario u ON a.usuario_id = u.id";

$resultadoAgendamento = mysqli_query($conn, $obterAgendamento);

if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == '1') {
    if ($resultadoAgendamento && mysqli_num_rows($resultadoAgendamento) > 0) {
        while ($row_Agendamento = mysqli_fetch_assoc($resultadoAgendamento)) {
           ?>
		   
		   <div class="flex items-center gap-3">
                        <div class="w-2/12 xl:w-4/12">
                          <div class="flex items-center gap-4">
                           <span  class="" ><?php echo $row_Agendamento["nome"]; ?></span>
                          </div>
                        </div>
                        <div class="w-6/12 2xsm:w-4/12 md:w-3/12">
                          <span class=""><?php echo $row_Agendamento["data_agendamento"]; ?></span>
                        </div>
                        <div class="hidden w-6/12 md:block xl:w-5/12">
                          <span class=""><?php echo $row_Agendamento["hora_agendamento"]; ?></span>
                        </div>
                        <div class="hidden w-6/12 xl:block">
                          <span class=""><?php echo $row_Agendamento["status_agendamento"]; ?></span>
                        </div>
						<div class="hidden w-6/12 xl:block">
                          <span class=""><?php echo $row_Agendamento["d_criacao"]; ?></span>
                        </div>
                        
                        <div class=" w-2/12 2xsm:block md:w-1/12">
                          <button class="mx-auto block hover:text-meta-1">
                            <svg class="mx-auto fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M16.8094 3.02498H14.1625V2.4406C14.1625 1.40935 13.3375 0.584351 12.3062 0.584351H9.65935C8.6281 0.584351 7.8031 1.40935 7.8031 2.4406V3.02498H5.15623C4.15935 3.02498 3.33435 3.84998 3.33435 4.84685V5.8781C3.33435 6.63435 3.78123 7.2531 4.43435 7.5281L4.98435 18.9062C5.0531 20.3156 6.22185 21.4156 7.63123 21.4156H14.3C15.7093 21.4156 16.8781 20.3156 16.9469 18.9062L17.5312 7.49372C18.1844 7.21872 18.6312 6.5656 18.6312 5.84373V4.81248C18.6312 3.84998 17.8062 3.02498 16.8094 3.02498ZM9.38435 2.4406C9.38435 2.26873 9.52185 2.13123 9.69373 2.13123H12.3406C12.5125 2.13123 12.65 2.26873 12.65 2.4406V3.02498H9.41873V2.4406H9.38435ZM4.9156 4.84685C4.9156 4.70935 5.01873 4.57185 5.1906 4.57185H16.8094C16.9469 4.57185 17.0844 4.67498 17.0844 4.84685V5.8781C17.0844 6.0156 16.9812 6.1531 16.8094 6.1531H5.1906C5.0531 6.1531 4.9156 6.04998 4.9156 5.8781V4.84685V4.84685ZM14.3344 19.8687H7.6656C7.08123 19.8687 6.59998 19.4218 6.5656 18.8031L6.04998 7.6656H15.9844L15.4687 18.8031C15.4 19.3875 14.9187 19.8687 14.3344 19.8687Z" fill=""></path>
                              <path d="M11 11.1375C10.5875 11.1375 10.2094 11.4812 10.2094 11.9281V16.2937C10.2094 16.7062 10.5531 17.0843 11 17.0843C11.4125 17.0843 11.7906 16.7406 11.7906 16.2937V11.9281C11.7906 11.4812 11.4125 11.1375 11 11.1375Z" fill=""></path>
                              <path d="M13.7499 11.825C13.303 11.7906 12.9593 12.1 12.9249 12.5469L12.7187 15.5719C12.6843 15.9844 12.9937 16.3625 13.4405 16.3969C13.4749 16.3969 13.4749 16.3969 13.5093 16.3969C13.9218 16.3969 14.2655 16.0875 14.2655 15.675L14.4718 12.65C14.4718 12.2031 14.1624 11.8594 13.7499 11.825Z" fill=""></path>
                              <path d="M8.21558 11.825C7.80308 11.8594 7.45933 12.2375 7.49371 12.65L7.73433 15.675C7.76871 16.0875 8.11246 16.3969 8.49058 16.3969C8.52496 16.3969 8.52496 16.3969 8.55933 16.3969C8.97183 16.3625 9.31558 15.9844 9.28121 15.5719L9.04058 12.5469C9.04058 12.1 8.66246 11.7906 8.21558 11.825Z" fill=""></path>
                            </svg>
                          </button>
                        </div>
						</div>

<?php
        }
    }
}else { 
	$obterAgendamento = "SELECT u.nome,
                     a.data_agendamento, 
                     a.hora_agendamento, 
                     a.status_agendamento, 
                     a.d_criacao  
                     FROM agendamento a
                     INNER JOIN usuario u ON a.usuario_id = u.id
                     WHERE a.usuario_id = ".$_SESSION['id'];

$resultadoAgendamento = mysqli_query($conn, $obterAgendamento);


    if ($resultadoAgendamento && mysqli_num_rows($resultadoAgendamento) > 0) {
        while ($row_Agendamento = mysqli_fetch_assoc($resultadoAgendamento)) {
		  
	?>
	 <div class="flex items-center gap-3">
                        <div class="w-2/12 xl:w-4/12">
                          <div class="flex items-center gap-4">
                           <span  class="" ><?php echo $row_Agendamento["nome"]; ?></span>
                          </div>
                        </div>
                        <div class="w-6/12 2xsm:w-4/12 md:w-3/12">
                          <span class=""><?php echo $row_Agendamento["data_agendamento"]; ?></span>
                        </div>
                        <div class="hidden w-6/12 md:block xl:w-5/12">
                          <span class=""><?php echo $row_Agendamento["hora_agendamento"]; ?></span>
                        </div>
                        <div class="hidden w-6/12 xl:block">
                          <span class=""><?php echo $row_Agendamento["status_agendamento"]; ?></span>
                        </div>
						<div class="hidden w-6/12 xl:block">
                          <span class=""><?php echo $row_Agendamento["d_criacao"]; ?></span>
                        </div>
                        
                        <div class=" w-2/12 2xsm:block md:w-1/12">
                          <button class="mx-auto block hover:text-meta-1">
                            <svg class="mx-auto fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M16.8094 3.02498H14.1625V2.4406C14.1625 1.40935 13.3375 0.584351 12.3062 0.584351H9.65935C8.6281 0.584351 7.8031 1.40935 7.8031 2.4406V3.02498H5.15623C4.15935 3.02498 3.33435 3.84998 3.33435 4.84685V5.8781C3.33435 6.63435 3.78123 7.2531 4.43435 7.5281L4.98435 18.9062C5.0531 20.3156 6.22185 21.4156 7.63123 21.4156H14.3C15.7093 21.4156 16.8781 20.3156 16.9469 18.9062L17.5312 7.49372C18.1844 7.21872 18.6312 6.5656 18.6312 5.84373V4.81248C18.6312 3.84998 17.8062 3.02498 16.8094 3.02498ZM9.38435 2.4406C9.38435 2.26873 9.52185 2.13123 9.69373 2.13123H12.3406C12.5125 2.13123 12.65 2.26873 12.65 2.4406V3.02498H9.41873V2.4406H9.38435ZM4.9156 4.84685C4.9156 4.70935 5.01873 4.57185 5.1906 4.57185H16.8094C16.9469 4.57185 17.0844 4.67498 17.0844 4.84685V5.8781C17.0844 6.0156 16.9812 6.1531 16.8094 6.1531H5.1906C5.0531 6.1531 4.9156 6.04998 4.9156 5.8781V4.84685V4.84685ZM14.3344 19.8687H7.6656C7.08123 19.8687 6.59998 19.4218 6.5656 18.8031L6.04998 7.6656H15.9844L15.4687 18.8031C15.4 19.3875 14.9187 19.8687 14.3344 19.8687Z" fill=""></path>
                              <path d="M11 11.1375C10.5875 11.1375 10.2094 11.4812 10.2094 11.9281V16.2937C10.2094 16.7062 10.5531 17.0843 11 17.0843C11.4125 17.0843 11.7906 16.7406 11.7906 16.2937V11.9281C11.7906 11.4812 11.4125 11.1375 11 11.1375Z" fill=""></path>
                              <path d="M13.7499 11.825C13.303 11.7906 12.9593 12.1 12.9249 12.5469L12.7187 15.5719C12.6843 15.9844 12.9937 16.3625 13.4405 16.3969C13.4749 16.3969 13.4749 16.3969 13.5093 16.3969C13.9218 16.3969 14.2655 16.0875 14.2655 15.675L14.4718 12.65C14.4718 12.2031 14.1624 11.8594 13.7499 11.825Z" fill=""></path>
                              <path d="M8.21558 11.825C7.80308 11.8594 7.45933 12.2375 7.49371 12.65L7.73433 15.675C7.76871 16.0875 8.11246 16.3969 8.49058 16.3969C8.52496 16.3969 8.52496 16.3969 8.55933 16.3969C8.97183 16.3625 9.31558 15.9844 9.28121 15.5719L9.04058 12.5469C9.04058 12.1 8.66246 11.7906 8.21558 11.825Z" fill=""></path>
                            </svg>
                          </button>
                        </div>
						</div>

	<?php
			}
		}
	}
	?>				
				</div>
              </div>
              <!-- ===== Leads Report End ===== -->
            </div>
          </div>

<?php
}
if(isset($_SESSION['selecao']) && $_SESSION['selecao'] == 'a') {
    echo 'teste';
}
?>	
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
							<label> </label>                              
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex flex-column-reverse flex-lg-row row">
				<div class="form-group">
					<div class="col-lg-8">
						<div class="input-group input-group-sm col-lg-5">              
							<label class="input-group-addon" >Matricula: </label>
							<label> </label>
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