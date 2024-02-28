<?php 
$resultado = array();
$resultado['codigo'] = '1';
$resultado['mensagem'] = "Não foi possível realizar essa operação!";

include 'conexao.php';

if(isset($_POST['excluir'])){
    // Lógica para exclusão
    $query_delete = ""; // Defina sua consulta DELETE aqui
}

if(isset($_POST['acao'])== "E"){
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
 
    $query_editar = "UPDATE alunos SET nome='$nome' WHERE id='$id'";
    $resultado_editar = mysqli_query($conn, $query_editar);

    if($resultado_editar) {
        $resultado['codigo'] = '0';
        $resultado['mensagem'] = "Operação realizada com sucesso!";
    }
}

echo json_encode($resultado);
?>
