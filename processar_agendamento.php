<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Captura os valores dos campos do formulário do POST
$data = $_POST['data'];
$horario = $_POST['horario'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$plano = $_POST['plano']; // Novo campo enviado do formulário
$tipo_pagamento = $_POST['pagamento']; // Novo campo enviado do formulário

// Prepara a declaração SQL para inserção
$sql = "INSERT INTO agendamento (data_agendamento, hora_agendamento, nome, telefone, plano, tipo_pagamento, status) VALUES (STR_TO_DATE(?, '%d/%m/%Y'), ?, ?, ?, ?, ?, 'Pendente')";

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Inicializa um array para armazenar a resposta
$response = array();

// Verifica se a preparação da declaração SQL foi bem-sucedida
if ($stmt) {
    // Define os parâmetros e executa a declaração
    $stmt->bind_param("ssssss", $data, $horario, $nome, $telefone, $plano, $tipo_pagamento);
    if ($stmt->execute()) {
        // Se a inserção for bem-sucedida, define o código como 0 e a mensagem de sucesso
        $response['codigo'] = 0;
        $response['mensagem'] = "Dados inseridos com sucesso.";
    } else {
        // Se houver um erro na inserção, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro ao inserir dados: " . $stmt->error;
    }
} else {
    // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
    $response['codigo'] = 1;
    $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
}

// Retorna a resposta como JSON
echo json_encode($response);

// Fecha a declaração SQL e a conexão com o banco de dados
$stmt->close();
$conn->close();
?>
