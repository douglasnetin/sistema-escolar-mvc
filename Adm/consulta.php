<?php
include '../conexao.php';

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
}


if ($acao == "devedores") {
    // Prepara a declaração SQL para inserção
    $sql = "SELECT 
                (SELECT TRUNCATE(SUM(p1.preco_plano) / 2, 2) 
                FROM agendamento a1 
                INNER JOIN plano p1 ON a1.plano = p1.nome_plano
                WHERE a1.status = 'pendente') AS preco_total_pendente,
                 
                (SELECT SUM(p1.preco_plano) 
                FROM agendamento a1 
                INNER JOIN plano p1 ON a1.plano = p1.nome_plano
                WHERE a1.status = 'confirmado') AS preco_total_completo,

                (SELECT SUM(p3.preco_plano) 
                FROM agendamento a3 
                INNER JOIN plano p3 on a3.plano = p3.nome_plano  
                WHERE a3.status in 
                ('pendente','confirmado') ) AS total_caixa";
    
    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Define os parâmetros e executa a declaração
        if ($stmt->execute()) {
            // Se a execução for bem-sucedida, obtém os resultados
            $stmt->bind_result($preco_total_pendente, $preco_total_completo, $total_caixa);
            $stmt->fetch();
            // Define os dados de resposta
            $response['codigo'] = 0;
            $response['mensagem'] = "Dados obtidos com sucesso.";
            $response['preco_total_pendente'] = $preco_total_pendente;
            $response['preco_total_completo'] = $preco_total_completo;
            $response['total_caixa'] = $total_caixa;
        } else {
            // Se houver um erro na execução, define a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro ao executar a consulta: " . $stmt->error;
        }
    } else {
        // Se houver um erro na preparação da declaração SQL, define a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "obterAgendamento") {
    // Prepara a declaração SQL para obter os dados de agendamento
    $sql = "SELECT id, data_agendamento, hora_agendamento, nome, telefone, status, data_criacao, plano, tipo_pagamento FROM agendamento";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Executa a declaração SQL
        $stmt->execute();

        // Vincula as colunas do resultado da consulta a variáveis PHP
        $stmt->bind_result($id, $data_agendamento, $hora_agendamento, $nome, $telefone, $status, $data_criacao, $plano, $tipo_pagamento);

        // Inicializa um array para armazenar os resultados
        $resultados = array();

        // Itera sobre os resultados da consulta
        while ($stmt->fetch()) {
            // Armazena os resultados em um array associativo
            $resultado = array(
                'id' => $id,
                'data_agendamento' => $data_agendamento,
                'hora_agendamento' => $hora_agendamento,
                'nome' => $nome,
                'telefone' => $telefone,
                'status' => $status,
                'data_criacao' => $data_criacao,
                'plano' => $plano,
                'tipo_pagamento' => $tipo_pagamento
            );

            // Adiciona o resultado ao array de resultados
            $resultados[] = $resultado;
        }

        // Define a resposta como os resultados obtidos da consulta
        $response['codigo'] = 0;
        $response['mensagem'] = "Dados obtidos com sucesso.";
        $response['dados'] = $resultados;
    } else {
        // Se houver um erro na preparação da declaração SQL, define a resposta como erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "excluir_agendamento") {
    // Ação para excluir um agendamento
    $id_agendamento = $_POST['id_agendamento'];

    // Prepara a declaração SQL para excluir o agendamento
    $sql = "DELETE FROM agendamento WHERE id = ?";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Vincula os parâmetros e executa a declaração
        $stmt->bind_param("i", $id_agendamento);
        if ($stmt->execute()) {
            // Se a exclusão for bem-sucedida, define o código como 0 e a mensagem de sucesso
            $response['codigo'] = 0;
            $response['mensagem'] = "Agendamento excluído com sucesso.";
        } else {
            // Se houver um erro na exclusão, define o código como 1 e a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro ao excluir agendamento: " . $stmt->error;
        }
    } else {
        // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "obterPlano") {
    // Prepara a declaração SQL para obter os dados do plano
    $sql = "SELECT * FROM plano";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Executa a declaração SQL
        $stmt->execute();

        // Vincula as colunas do resultado da consulta a variáveis PHP
        $stmt->bind_result($id, $nome_plano, $txt_label, $descricao, $preco_plano);

        // Inicializa um array para armazenar os resultados
        $resultados = array();

        // Itera sobre os resultados da consulta
        while ($stmt->fetch()) {
            // Armazena os resultados em um array associativo
            $resultado = array(
                'cod_planos' => $id,
                'nome_plano' => $nome_plano,
                'txt_label' => $txt_label,
                'descricao' => $descricao,
                'preco_plano' => $preco_plano
            );

            // Adiciona o resultado ao array de resultados
            $resultados[] = $resultado;
        }

        // Define a resposta como os resultados obtidos da consulta
        $response['codigo'] = 0;
        $response['mensagem'] = "Dados obtidos com sucesso.";
        $response['dados'] = $resultados;
    } else {
        // Se houver um erro na preparação da declaração SQL, define a resposta como erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "excluirPlano") {
    // Verifica se o ID do plano foi enviado
    if (isset($_POST['id_plano'])) {
        // Obtém o ID do plano a ser excluído
        $id_plano = $_POST['id_plano'];

        // Prepara a declaração SQL para excluir o plano
        $sql = "DELETE FROM plano WHERE cod_plano = ?";

        // Prepara a declaração SQL
        $stmt = $conn->prepare($sql);

        // Verifica se a preparação da declaração SQL foi bem-sucedida
        if ($stmt) {
            // Vincula os parâmetros e executa a declaração
            $stmt->bind_param("i", $id_plano);
            if ($stmt->execute()) {
                // Se a exclusão for bem-sucedida, define o código como 0 e a mensagem de sucesso
                $response['codigo'] = 0;
                $response['mensagem'] = "Plano excluído com sucesso.";
            } else {
                // Se houver um erro na exclusão, define o código como 1 e a mensagem de erro
                $response['codigo'] = 1;
                $response['mensagem'] = "Erro ao excluir plano: " . $stmt->error;
            }
        } else {
            // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
        }

        // Fecha a declaração SQL
        $stmt->close();
    } else {
        // Se o ID do plano não foi enviado, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "ID do plano não fornecido.";
    }
}

if ($acao == "usuario") {
    // Prepara a declaração SQL para inserção
    $sql = "SELECT * FROM usuario";
        if (!empty($_POST['id'])) {
            // Se não estiver vazio, você pode adicionar o filtro WHERE na sua consulta SQL
            $id = $_POST['id'];
            $sql .= " WHERE id = $id";
        }
    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Define os parâmetros e executa a declaração
        if ($stmt->execute()) {
            // Se a execução for bem-sucedida, obtém os resultados
            $stmt->bind_result($id, $nome, $email, $usuario, $senha, $nivel, $tema);
            $stmt->fetch();
            // Define os dados de resposta
            $response['codigo'] = 0;
            $response['mensagem'] = "Dados obtidos com sucesso.";
            $response['id'] = $id;
            $response['nome'] = $nome;
            $response['email'] = $email;
            $response['usuario'] = $usuario;
            $response['nivel'] = $nivel;
            $response['tema'] = $tema;
        } else {
            // Se houver um erro na execução, define a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro ao executar a consulta: " . $stmt->error;
        }
    } else {
        // Se houver um erro na preparação da declaração SQL, define a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "adicionarPromocao") {
    // Ação para inserir um novo plano
    $nomePromocao = $_POST['nomePromocao'];
    $tituloPromocao = $_POST['tituloPromocao'];
    $detalhePromocao = $_POST['detalhePromocao'];
	 
  // Prepara a declaração SQL para inserção
    $sql = "INSERT INTO promocao(titulo, descricao, label) VALUES (?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Define os parâmetros e executa a declaração
        $stmt->bind_param("sss", $nomePromocao, $tituloPromocao, $detalhePromocao);
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

if ($acao == "obterPromocao") {
    // Prepara a declaração SQL para obter os dados do plano
    $sql = "SELECT idPromocao, titulo, descricao, label FROM promocao";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Executa a declaração SQL
        $stmt->execute();

        // Vincula as colunas do resultado da consulta a variáveis PHP
        $stmt->bind_result($idPromocao,$titulo, $descricao, $label);

        // Inicializa um array para armazenar os resultados
        $resultados = array();

        // Itera sobre os resultados da consulta
        while ($stmt->fetch()) {
            // Armazena os resultados em um array associativo
            $resultado = array(
                'id' => $idPromocao,
                'titulo' => $titulo,
                'descricao' => $descricao,
                'label' => $label
            );

            // Adiciona o resultado ao array de resultados
            $resultados[] = $resultado;
        }

        // Define a resposta como os resultados obtidos da consulta
        $response['codigo'] = 0;
        $response['mensagem'] = "Dados obtidos com sucesso.";
        $response['dados'] = $resultados;
    } else {
        // Se houver um erro na preparação da declaração SQL, define a resposta como erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "obterUsuario") {
    // Prepara a declaração SQL para obter os dados do plano
    $sql = "SELECT * FROM usuarios";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração SQL foi bem-sucedida
    if ($stmt) {
        // Executa a declaração SQL
        $stmt->execute();

        // Vincula as colunas do resultado da consulta a variáveis PHP
        $stmt->bind_result($id,$nome, $email, $usuario,$senha,$nivel,);

        // Inicializa um array para armazenar os resultados
        $resultados = array();

        // Itera sobre os resultados da consulta
        while ($stmt->fetch()) {
            // Armazena os resultados em um array associativo
            $resultado = array(
                'id' => $idPromocao,
                'titulo' => $titulo,
                'descricao' => $descricao,
                'label' => $label
            );

            // Adiciona o resultado ao array de resultados
            $resultados[] = $resultado;
        }

        // Define a resposta como os resultados obtidos da consulta
        $response['codigo'] = 0;
        $response['mensagem'] = "Dados obtidos com sucesso.";
        $response['dados'] = $resultados;
    } else {
        // Se houver um erro na preparação da declaração SQL, define a resposta como erro
        $response['codigo'] = 1;
        $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
    }

    // Fecha a declaração SQL
    $stmt->close();
}

if ($acao == "excluir_promocao") {
    // Verifica se o ID do plano foi enviado
    if (isset($_POST['id_promocao'])) {
        // Obtém o ID do plano a ser excluído
        $id_promocao = $_POST['id_promocao'];

        // Prepara a declaração SQL para excluir o plano
        $sql = "DELETE FROM promocao WHERE idPromocao = ?";

        // Prepara a declaração SQL
        $stmt = $conn->prepare($sql);

        // Verifica se a preparação da declaração SQL foi bem-sucedida
        if ($stmt) {
            // Vincula os parâmetros e executa a declaração
            $stmt->bind_param("i", $id_promocao);
            if ($stmt->execute()) {
                // Se a exclusão for bem-sucedida, define o código como 0 e a mensagem de sucesso
                $response['codigo'] = 0;
                $response['mensagem'] = "Plano excluído com sucesso.";
            } else {
                // Se houver um erro na exclusão, define o código como 1 e a mensagem de erro
                $response['codigo'] = 1;
                $response['mensagem'] = "Erro ao excluir plano: " . $stmt->error;
            }
        } else {
            // Se houver um erro na preparação da declaração SQL, define o código como 1 e a mensagem de erro
            $response['codigo'] = 1;
            $response['mensagem'] = "Erro na preparação da declaração SQL: " . $conn->error;
        }

        // Fecha a declaração SQL
        $stmt->close();
    } else {
        // Se o ID do plano não foi enviado, define o código como 1 e a mensagem de erro
        $response['codigo'] = 1;
        $response['mensagem'] = "ID do plano não fornecido.";
    }
}


echo json_encode($response);
$conn->close();

?>
