<?php
include 'conexao.php';

// Recebe os dados do formulário via POST
$acao = $_POST['acao'];

// Inicializa um array para armazenar a resposta
$response = array();

// Verifica a ação
if ($acao == "plano") {
    // Ação para inserir um novo plano
    $nomePlano = $_POST['nomePlano'];
    $txtLabel = $_POST['txtLabel'];
    $detalhePlano = $_POST['detalhePlano'];
    $preco = $_POST['preco'];

    // Prepara a declaração SQL para inserção
    $sql = "INSERT INTO plano (nome_plano, txt_label, descricao, preco_plano) VALUES (?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Define os parâmetros e executa a declaração
        $stmt->bind_param("ssss", $nomePlano, $txtLabel, $detalhePlano, $preco);
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

    $stmt->close();
} elseif ($acao == "E") {
    // Ação para excluir um plano
    $cod_id = $_POST['idPlano'];

    // Prepara a declaração SQL para exclusão
    $sql = "DELETE FROM plano WHERE cod_plano = ?";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Define os parâmetros e executa a declaração
        $stmt->bind_param("s", $cod_id);
        if ($stmt->execute()) {
            // Se a exclusão for bem-sucedida, define o código como 0 e a mensagem de sucesso
            $response['codigo'] = 0;
            $response['mensagem'] = "Dados excluídos com sucesso.";
        } else {
            // Se houver um erro na exclusão, define o código como 1 e a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro ao excluir dados: " . $stmt->error;
        }
    } else {
        // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    $stmt->close();
} elseif ($acao == "editar_status") {
    // Ação para editar o status de um agendamento
    $id_agendamento = $_POST['id_agendamento'];
    $status = $_POST['status'];

    $sql ="UPDATE agendamento SET status = ? WHERE id = ?";
          
          $response['SQL'] = "UPDATE agendamento AS a 
          JOIN usuario AS u ON a.id = u.id 
          SET a.status = $status 
          WHERE a.id = $id_agendamento" ;  
    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        
        $stmt->bind_param("si", $status, $id_agendamento);
        if ($stmt->execute()) {
            $response['codigo'] = 0;
            $response['mensagem'] = "Dados alterados com sucesso.";
        } else {
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro ao alterar dados: " . $stmt->error;
        }
         } else {
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
        }

    $stmt->close();
} else {
    // Se a ação não for reconhecida, retorna uma mensagem de erro
    $response['codigo'] = 1;
    $response['mensagem'] = "Ação inválida: " . $acao;
}

// Retorna a resposta como JSON
echo json_encode($response);

// Fecha a conexão com o banco de dados
$conn->close();
?>
