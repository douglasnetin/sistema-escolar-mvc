<?php
include '../conexao.php';

// Recebe os dados do formulário via POST
$acao = $_POST['acao'];

// Inicializa um array para armazenar a resposta
$response = array();

if ($acao == "editar_tema") {
    // Ação para editar o tema de um usuário
    $tema = $_POST['tema'];
    $id = $_POST['id'];

    // Prepara a declaração SQL
    $sql = "UPDATE usuario SET tema = ? WHERE id = ?";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Associa os parâmetros
        $stmt->bind_param("ii", $tema, $id);

        // Executa a declaração SQL
        if ($stmt->execute()) {
            // Se a atualização for bem-sucedida, define o código como 0 e a mensagem de sucesso
            $response['codigo'] = 0;
            $response['mensagem'] = "Dados alterados com sucesso.";
        } else {
            // Se houver um erro na atualização, define o código como 1 e a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro ao alterar dados: " . $stmt->error;
        }
    } else {
        // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

// Retorna a resposta como JSON
echo json_encode($response);

// Fecha a conexão com o banco de dados
$conn->close();
?>
