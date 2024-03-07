<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	//var_dump($dados);
	$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
	
	// Inserir dados na tabela "usuarios"
	$result_usuario = "INSERT INTO usuario (nome, email, senha, usuario) VALUES (
					'" .$dados['nome']. "',
					'" .$dados['email']. "',
					'" .$dados['senha']. "',
					'" .$dados['usuario']. "'
					)";
	$resultado_usario = mysqli_query($conn, $result_usuario);
	
	// Verificar se a inserção na tabela "usuarios" foi bem-sucedida
	if(mysqli_insert_id($conn)){
		// Inserir dados na tabela "alunos" com referência ao ID do usuário recém-inserido
		$id_usuario = mysqli_insert_id($conn);
		$result_aluno = "INSERT INTO alunos (nome, matricula, id_usuario) VALUES (
					'" .$dados['nome']. "',
					'" .$dados['matricula']. "',
					$id_usuario
					)";
		$resultado_aluno = mysqli_query($conn, $result_aluno);
		
		// Verificar se a inserção na tabela "alunos" foi bem-sucedida
		if($resultado_aluno){
			$_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
			header("Location: login.php");
			exit(); // Certifique-se de sair após o redirecionamento
		} else {
			$_SESSION['msg'] = "Erro ao cadastrar o aluno";
		}
	} else {
		$_SESSION['msg'] = "Erro ao cadastrar o usuário";
	}
}
?>
