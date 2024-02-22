<a href="index.php">Voltar para a página principal</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">nome</th>
      <th scope="col">sobrenome</th>
      <th scope="col">idade</th>
      <th scope="col">cpf</th>
      <th scope="col">endereço</th>
      <th scope="col">telefone</th>
    </tr>
  </thead>
  <tbody>
    <?php
include "conexao.php";
if(isset($_GET['nome']) && $_GET['nome'] !== ''){
    $sql = "SELECT * FROM pessoa WHERE nome ='". $_GET['nome']."'";
    $result = $connection->query($sql);

    // Se houver resultados, exibe-os em uma tabela
    if ($result->rowCount() > 0) {
        
        // Saída de dados de cada linha
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row["idpessoa"]."</td>";
            echo "<td>".$row["nome"]."</td>";
            echo "<td>".$row["sobrenome"]."</td>";
            echo "<td>".$row["idade"]."</td>";
            echo "<td>".$row["cpf"]."</td>";
            echo "<td>".$row["endereco"]."</td>";
            echo "<td>".$row["telefone"]."</td>";
            echo "</tr>";
        }
        
    } else {
        echo "<tr>";
        echo "<td colspan='7'class='text-center' > nome não encontrado </td>";
        echo "</tr>";
    }
}else {

    $sql = "SELECT * FROM pessoa";
    $result = $connection->query($sql);

    // Se houver resultados, exibe-os em uma tabela
    if ($result->rowCount() > 0) {
        
        // Saída de dados de cada linha
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row["idpessoa"]."</td>";
            echo "<td>".$row["nome"]."</td>";
            echo "<td>".$row["sobrenome"]."</td>";
            echo "<td>".$row["idade"]."</td>";
            echo "<td>".$row["cpf"]."</td>";
            echo "<td>".$row["endereco"]."</td>";
            echo "<td>".$row["telefone"]."</td>";
            echo "</tr>";
        }
        
    } 



}
$connection->_conn = null;
?>
  </tbody>
</table>
</body>
</html>
