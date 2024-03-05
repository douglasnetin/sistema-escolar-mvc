<?php
include 'conexao.php';

// Recebe os dados do formulário via POST
$acao = $_POST['acao'];

// Inicializa um array para armazenar a resposta
$response = array();

if ($acao == "plano") {
    // Ação para inserir um novo plano
    $nomePlano = $_POST['nomePlano'];
    $txtLabel = $_POST['txtLabel'];
    $detalhePlano = $_POST['detalhePlano'];
    $preco = $_POST['preco'];
	
    $sql_verificar_nome = "SELECT nome_plano FROM plano WHERE nome_plano = ?";
    $stmt_verificar_nome = $conn->prepare($sql_verificar_nome);
    $stmt_verificar_nome->bind_param("s", $nomePlano);
    $stmt_verificar_nome->execute();
    $stmt_verificar_nome->store_result();

if ($stmt_verificar_nome->num_rows > 0) {
        // Se o nome do plano já existe, retorna uma mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "O nome do plano já existe.";
    } else {
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
   }

 
     $stmt_verificar_nome->close();
  
}elseif ($acao == "E") {
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



if ($acao == "devedores") {
    // Ação para inserir um novo plano
    $status = $_POST['status'];
    $preco = $_POST['preco'];

    // Prepara a declaração SQL para inserção
    $sql = `SELECT 
    (SELECT SUM(p1.preco_plano) 
     FROM agendamento a1 , plano p1  
     WHERE a1.status = 'pendente') AS preco_total_pendente,
     
    (SELECT SUM(p2.preco_plano) 
     FROM agendamento a2 
     , plano p2  
     WHERE a2.status = 'confirmado') AS preco_total_completo;
`;

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Define os parâmetros e executa a declaração
        $stmt->bind_param($nome, $status,$preco);
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
}
echo json_encode($response);
$conn->close();

?>
