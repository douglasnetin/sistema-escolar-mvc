<?php
session_start();

if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    header("Location: login.php");
    exit();
}

include_once("conexao.php");

// Consulta SQL para obter os dados do usuário
$obterUsuario = "SELECT * FROM usuario WHERE id = $id";
$resultadoUsuario = mysqli_query($conn, $obterUsuario);
$usuario = mysqli_fetch_assoc($resultadoUsuario);

// Consulta SQL para obter os dados do agendamento
$obterAgendamento = "SELECT * FROM agendamento";
$resultadoAgendamento = mysqli_query($conn, $obterAgendamento);

// consulta sql para obter os planos 
$obterPlanos = "SELECT * FROM plano";
$resultadoPlano = mysqli_query($conn, $obterPlanos);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="images/favicon.png" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Rounded" rel="stylesheet" />
  <link href="/assets/css/painel.css" rel="stylesheet" defer />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Adicionando Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
  <div class="sidebar">
    <div class="logo">
      <a class="sidebar-link" href="#">
        <span class="material-symbols-rounded"> dashboard </span>
        <p>Dashboard</p>
      </a>
    </div>
    <div class="menu">
      <ul>
        <a href="#">
          <li class="sidebar-link selected">
            <span class="material-symbols-rounded"> home </span>
            <p>Home</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> badge </span>
            <p>Profile</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> message </span>
            <p>Messages</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> history </span>
            <p>History</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> task </span>
            <p>Tasks</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> people </span>
            <p>Communities</p>
          </li>
        </a>
        <br />
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> settings </span>
            <p>Settings</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> support </span>
            <p>Support</p>
          </li>
        </a>
        <a href="#">
          <li class="sidebar-link">
            <span class="material-symbols-rounded"> security </span>
            <p>Privacy</p>
          </li>
        </a>
      </ul>
    </div>
  </div>
  <header>
    
    <div class="notification-area">
      <span class="material-symbols-rounded"> notifications_active </span>
      <img class="profile-picture" src="images/profile-pictures/profile-pic1.png" alt="profile picture" />
      <p><?php echo $usuario['nome']; ?></p>
    </div>
  </header>
  <main>
    <div class="projects">
      <div class="project-card-container">
        <div class="project-card">
          <table>
              <thead>
                  <tr>
                      <th colspan="7" style="text-align: center;">Agendamentos</th>
                  </tr>
                  <tr>
                      <th style="text-align: center;">Nome</th>
                      <th style="text-align: center;">Telefone</th>
                      <th style="text-align: center;">Plano</th>
                      <th style="text-align: center;">Data</th>
                      <th style="text-align: center;">Horário</th>
                      <th style="text-align: center;">Status</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                    if (mysqli_num_rows($resultadoAgendamento) > 0) {
                        while($row = mysqli_fetch_assoc($resultadoAgendamento)) {
                            ?>
                            <tr>
                            <td style="text-align: center;"><?php echo $row['nome']; ?></td>
                            <td style="text-align: center;"><?php echo $row['telefone']; ?></td>
                            <td style="text-align: center;"><?php echo $row['plano']; ?></td>
                            <td style="text-align: center;"><?php echo $row['data_agendamento']; ?></td>
                            <td style="text-align: center;"><?php echo $row['hora_agendamento']; ?></td>
                            <td style="text-align: center;">
                                <select id="status_<?php echo $row['id']; ?>" onchange="editarStatusAgendamentos(<?php echo $row['id']; ?>)">
                                    <option value="Pendente" <?php if($row['status'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                                    <option value="Confirmado" <?php if($row['status'] == 'Confirmado') echo 'selected'; ?>>Confirmado</option>
                                    <option value="Cancelado" <?php if($row['status'] == 'Cancelado') echo 'selected'; ?>>Cancelado</option>
                                </select>
                                </td>
                            </tr>
                        <?php
                        }
                    
                    }
                  ?>
              </tbody>
          </table>
        </div>
        <div class="project-card">
        <div class="project-card-icons">
            <span class="material-symbols-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal"> add </span>
            
          </div>
        <table>
              <thead>
                  <tr>
                      <th colspan="5" style="text-align: center;">Planos</th>
                  </tr>
                  <tr>
                      <th style="text-align: center;">Nome Plano</th>
                      <th style="text-align: center;">Texto Label</th>                 
                      <th style="text-align: center;">Detalhes do Plano</th>
                      <th style="text-align: center;" >Preço</th>
                      <th style="text-align: center;" >Ação</th>
                  </tr>
              </thead>
                  <tbody>
                  <?php
                    if (mysqli_num_rows($resultadoPlano) > 0) {
                        while($row = mysqli_fetch_assoc($resultadoPlano)) {
                            ?>
                            <tr>
                            <td style="text-align: center;"><?php echo $row['nome_plano']; ?></td>
                            <td style="text-align: center;"><?php echo $row['txt_label']; ?></td>
                            <td style="text-align: center;"><?php echo $row['descricao']; ?></td>
                            <td style="text-align: center;"><?php echo $row['preco_plano']; ?></td>
                            <td style="text-align: center;"><div class="project-card-icons"><span class="material-symbols-rounded" onclick="deletar(<?php echo $row['cod_plano']; ?>)"> delete </span></div></td>
                            </tr>
                        <?php
                        }
                    
                    }
                  ?>


                  </tbody>
                  </table>
           
            </div>
        <div class="project-card">
          <div>
            <p>Impossible App</p>
            <p>
              In hac habitasse platea dictumst. Vivamus dictum rutrum arcu, a
              placerat velit sagittis id.
            </p>
          </div>
          <div class="project-card-icons">
           
          </div>
        </div>
        <div class="project-card">
          <div>
            <p>Easy Peasy App</p>
            <p>
              Etiam cursus eros ac efficiur fringilla. Vestibulum dignissim
              urna eget accumsan aliquam. Curabitur dignissim nisi in tortor
              commondo, ac bibendum magna tincidunt.
            </p>
          </div>
          <div class="project-card-icons">
            <span class="material-symbols-rounded"> bookmark </span>
            <span class="material-symbols-rounded"> delete </span>
            <span class="material-symbols-rounded"> share </span>
          </div>
        </div>
        <div class="project-card">
          <div>
            <p>Ad Blocker</p>
            <p>
              Quisque eget rutrum nisl. Nam augue justo, cursus vitae metus
              vel, pharetra hendrerit felis. Aliquam sed malesuada eros.
            </p>
          </div>
          <div class="project-card-icons">
            <span class="material-symbols-rounded"> bookmark </span>
            <span class="material-symbols-rounded"> delete </span>
            <span class="material-symbols-rounded"> share </span>
          </div>
        </div>
        <div class="project-card">
          <div>
            <p>Money Maker</p>
            <p>
              Prasent convallis, libero quis congue elementum, nunc ante
              faucibus sapien, ac scelerisque tortor purus sit amet ex.
              Pellentesque mollis nec sem vel aliquam.
            </p>
          </div>
          <div class="project-card-icons">
            <span class="material-symbols-rounded"> bookmark </span>
            <span class="material-symbols-rounded"> delete </span>
            <span class="material-symbols-rounded"> share </span>
          </div>
        </div>
      </div>
    </div>
    <div class="announcements">
      <p class="section-title">Announcements</p>
      <div>
        <div>
          <p>Site Maintenance</p>
          <p>
            Vestibulum condimentum tellus lacus, in accumsan elit maximus ac.
            Donec hendrerit sodales congue...
          </p>
        </div>
        <div>
          <p>Community Share Day</p>
          <p>
            Nam vel lectus tincidunt, rutrum nulla eu, ornare libero. Aliquam
            dictum accumsan porttitor...
          </p>
        </div>
        <div>
          <p>Updated Privacy Policy</p>
          <p>
            Phasellus efficitur nisi eget elit consectetur, eget condimentum
            ante auctor. Cras frigilla sagittis sem in mattis...
          </p>
        </div>
      </div>
    </div>
    <div class="trending">
      <p class="section-title">Trending</p>
      <div>
        <div>
          <img class="profile-picture" src="images/profile-pictures/profile-pic2.png" alt="profile picture 1" />
          <div>
            <p>@tegan</p>
            <p>World Peace Builder</p>
          </div>
        </div>
        <div>
          <img class="profile-picture" src="images/profile-pictures/profile-pic1.png" alt="profile picture 2" />
          <div>
            <p>@emuel</p>
            <p>Super Cool Project</p>
          </div>
        </div>
        <div>
          <img class="profile-picture" src="images/profile-pictures/profile-pic4.png" alt="profile picture 3" />
          <div>
            <p>@kendall</p>
            <p>Life Changing App</p>
          </div>
        </div>
        <div>
          <img class="profile-picture" src="images/profile-pictures/profile-pic5.png" alt="profile picture 4" />
          <div>
            <p>@alex</p>
            <p>No Traffic Maker</p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <p>
      Made with ❤️ by
      <a href="https://github.com/emuel-vassallo/" target="_blank">
        Emuel Vassallo
      </a>
    </p>
  </footer>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Plano</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Corpo da modal -->
          
                   <div class="row">
                     <div class="col-lg-6 text-center">
                  
                     <label >Nome do Plano</label>

                     </div> 
                     <div class="col-lg-6 text-center">
                     <input class="form-control" id="nomePlano" type="text">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-lg-6 text-center">
                  
                     <label >Texto Label</label>

                     </div> 
                     <div class="col-lg-6 text-center">
                     <input class="form-control" id="txtLabel" type="text">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-lg-6 text-center">
                  
                     <label >Detalhe Plano</label>

                     </div> 
                     <div class="col-lg-6 text-center">
                     <textarea class="form-control" name="" id="detalhePlano" cols="30" rows="10"></textarea>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-lg-6 text-center">
                  
                     <label >Preço</label>

                     </div> 
                     <div class="col-lg-6 text-center">
                     <input class="form-control" id="preco" type="text">
                     </div>
                   </div>
                    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelar">Cancelar</button>
          <button type="button" class="btn btn-primary" id="salvar">Salvar</button>
        </div>
      </div>
    </div>
  </div>
<script>
 function inserirPlano() {
    var nomePlano = $("#nomePlano").val();
    var txtLabel = $("#txtLabel").val();
    var detalhePlano = $("#detalhePlano").val();
    var preco = $("#preco").val();

    $.ajax({
        type: "POST",
        url: "admcrud.php",
        data: {
            nomePlano: nomePlano,
            txtLabel: txtLabel,
            detalhePlano: detalhePlano,
            preco: preco,
            acao: 'plano'
        },
        success: function(response) {
            var dados = JSON.parse(response);
            if(dados.codigo==0){
            toastr.success(dados.mensagem);
            window.location.href = "administrativo.php";
            $("#nomePlano").val("");
            $("#txtLabel").val("");
            $("#detalhePlano").val("");
            $("#preco").val("");
            $("#cancelar").click();
            }else{
              toastr.error(dados.mensagem);
            }
           
        },
        error: function(xhr, status, error) {
            toastr.error("Erro ao criar plano: " + error);
        }
    });
}

$("#salvar").on("click", function() {
    inserirPlano();
});

function deletar(id) {
    if (!confirm("Deseja excluir este plano?")) {
        return false;
    }
    $.ajax({
        type: "POST",
        url: "admcrud.php",
        data: {
            acao: 'E',
            idPlano: id
        },
        success: function(response) {
            var dados = JSON.parse(response);
            if(dados.codigo==0){
            toastr.success(dados.mensagem);
            window.location.href = "administrativo.php";
            }else{
              toastr.error(dados.mensagem);
            }
        },
        error: function(xhr, status, error) {
            toastr.error("Erro ao excluir plano: " + error);
        }
    });
}
function editarStatusAgendamentos(id) {
  var status = $(`#status_${id}`).val();
  debugger;
  if(!confirm("Tem certeza que deseja editar o status?")){return false;}

    $.ajax({
        type: "POST",
        url: "admcrud.php",
        data: {
            id_agendamento:id,
            acao: 'editar_status',
            status:status
        },
        success: function(response) {
        
            var dados = JSON.parse(response);
            if(dados.codigo==0){
            toastr.success(dados.mensagem);
            }else{
              toastr.error(dados.mensagem);
            }
        },
        error: function(xhr, status, error) {
            toastr.error("Erro ao criar plano: " + error);
        }
    });
  }
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>



</html>