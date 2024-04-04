<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Captura o valor do campo 'acao' do formulário POST
$acao = $_POST['acao'];

// Verifica se a ação é 'I' (indicando inserção)
if ($acao === 'I') {
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

        // Fecha a declaração SQL
        $stmt->close();
    } else {
        // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }
} 

if ($acao === 'selectPlanos')  {
  
    
    // Prepara a declaração SQL para inserção
    $sql = "SELECT cod_plano , nome_plano FROM plano";
    
    // Executa a consulta SQL
    $result = $conn->query($sql);
    
    // Inicializa um array para armazenar os resultados
    $response = array();

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        
        $contador=0;
        while($row = $result->fetch_assoc()) {
            $contador++;
            $response[] = $row;
        }
        // Define o código como 0 e a mensagem de sucesso
        $response['codigo'] = 0;
        $response['length'] = $contador;
        $response['mensagem'] = "Dados selecionados com sucesso.";
    } else {
        // Se não houver resultados, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Nenhum dado encontrado.";
    }
}
if ($acao === 'Hora')  {
  
    
    // Prepara a declaração SQL para inserção
    $sql = "SELECT cod_horario , hr_horario FROM horario";
    
    // Executa a consulta SQL
    $result = $conn->query($sql);
    
    // Inicializa um array para armazenar os resultados
    $response = array();

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        
        $contador=0;
        while($row = $result->fetch_assoc()) {
            $contador++;
            $response[] = $row;
        }
        // Define o código como 0 e a mensagem de sucesso
        $response['codigo'] = 0;
        $response['length'] = $contador;
        $response['mensagem'] = "Dados selecionados com sucesso.";
    } else {
        // Se não houver resultados, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Nenhum dado encontrado.";
    }
}

if ($acao === 'validarhorario')  {
    $horario = $_POST['cod_horario'];
    $data_Agendamento = $_POST['data_Agendamento'];
    // Prepara a declaração SQL para inserção
    $sql = "SELECT COUNT(hora_agendamento) AS numAgendamentos
            FROM agendamento a
            WHERE a.hora_agendamento = 
            (SELECT hr_horario 
            FROM horario 
            WHERE cod_horario=".$horario.")
            AND a.data_agendamento = '".$data_Agendamento."'";

    // Executa a consulta SQL
    $result = $conn->query($sql);

    // Inicializa um array para armazenar os resultados
    $response = array();

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {

        $contador = 0;
        while ($row = $result->fetch_assoc()) {
            $contador++;
            $response[] = $row;
        }
        // Define o código como 0 e a mensagem de sucesso
        $response['codigo'] = 0;
        $response['length'] = $contador;
        $response['mensagem'] = "Dados selecionados com sucesso.";
    } else {
        // Se não houver resultados, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Nenhum dado encontrado.";
    }
}

if ($acao === 'promocoes')  {
    // Prepara a declaração SQL para inserção
    $sql = "SELECT b.descricao AS desc_plano
                  ,a.label
                  ,b.preco_plano
            FROM promocao a 
            INNER JOIN plano b on a.titulo = b.nome_plano";

    // Executa a consulta SQL
    $result = $conn->query($sql);

    // Inicializa um array para armazenar os resultados
    $response = array();

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {

        $contador = 0;
        while ($row = $result->fetch_assoc()) {
            $contador++;
            $response[] = $row;
        }
        // Define o código como 0 e a mensagem de sucesso
        $response['codigo'] = 0;
        $response['length'] = $contador;
        $response['mensagem'] = "Dados selecionados com sucesso.";
    } else {
        // Se não houver resultados, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Nenhum dado encontrado.";
    }
}

echo json_encode($response);

// Fecha a conexão com o banco de dados
$conn->close();
?>
