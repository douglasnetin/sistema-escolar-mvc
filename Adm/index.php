<?php
session_start();
//existe essas sessões: id, nome, nivel, email, tema 
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
   
    header("Location: ../login.php");
    exit();
}
$tema = $_SESSION['tema'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
    <script src="plugins/jquery-2.2.4.min.js"></script>
    <script src="plugins/jquery.appear.min.js"></script>
    <script src="plugins/jquery.easypiechart.min.js"></script> 
    <title>Responsive Dashboard Design #1 | AsmrProg</title>
    
</head>

<body>
<script>
        $(function() {
            Tema();
        });
       
        function Tema() {
            var id = "<?php echo $_SESSION["id"]; ?>";
             $.ajax({                
                type: "POST",
                url: "consulta.php",
                data: {
                    acao : "usuario",
                    id:id
                },
                success: function(response) {
                    var dados = JSON.parse(response);
                    if(dados.tema === 1){        
                        document.body.classList.toggle('dark-mode-variables');
                        darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
                        darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Erro ao criar plano: " + error);
                }
            });
        }
    </script>
    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>Asmr<span class="danger">Prog</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>History</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Tickets</h3>
                    <span class="message-count">27</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Sale List</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Reports</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="../cadastrar.php">
                    <span class="material-icons-sharp">
                        add
                    </span>
                    <h3>New Login</h3>
                </a>
                <a href="../sair.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Analytics</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Caixa</h3>
                            <h1 id="total_caixa"></h1>
                        </div>
                        <br>
                        <div class="b-skills">
                             <div class="skill-item center-block">
                                 <div class="chart-container">
                                     <div class="chart" data-percent="65" data-bar-color="#23afe3">
                                         <span class="percent" data-after="%">65</span>
                                     </div>
                                 </div>
                                 <p>TOTAL CAIXA</p>
                             </div>
                        </div> 
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                    <div class="info">
                            <h3>Caixa</h3>
                            <h1 id="total_completos"></h1>
                        </div>
                        <div class="b-skills">
                             <div class="skill-item center-block">
                                 <div class="chart-container" id="porcentagem_completo">
                                     
                                 </div>
                                 <p>COMPLETOS</p>
                             </div>
                        </div> 
                        
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                    <div class="info">
                            <h5>Caixa</h3>
                            <h1 id="total_pendente"></h1>
                        </div>
                        <div class="b-skills">
                             <div class="skill-item center-block" >
                                 <div class="chart-container "  id="porcentagem_pendente">
                                    
                                 </div>
                                 <p >PENDENTES</p>
                             </div>
                        </div> 
                    
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->
            
            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Agendamentos</h2>
                <table>
              <thead>
                  <tr>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Plano</th>
                      <th>Data</th>
                      <th>Horário</th>
                      <th>Status</th>
                  </tr>
              </thead>
                  <tbody id="agendamento">
                  </tbody>
                  </table>
                <a href="#">Show All</a>
            </div>
            <!-- End of Recent Orders -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Planos</h2>
                <table>
              <thead>
                  <tr>
                      <th colspan="5" ><a style="text-align: right;"  href="#ex1" rel="modal:open" ><span class='material-icons-sharp'>add</span></a></th>
                  </tr>
                  <tr>
                      <th style="text-align: center;">Nome Plano</th>
                      <th style="text-align: center;">Texto Label</th>                 
                      <th style="text-align: center;">Detalhes do Plano</th>
                      <th style="text-align: center;" >Preço</th>
                      <th style="text-align: center;" >Ações</th>
                  </tr>
              </thead>
                  <tbody id="planos">

                  </tbody>
                  </table>
                <a href="#">Show All</a>
            </div>
            <!-- End of Recent Orders -->
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active " onclick="editarTema(<?php echo $_SESSION['id']; ?> , 0)" >
                        light_mode
                    </span>
                    <span class="material-icons-sharp" onclick="editarTema(<?php echo $_SESSION['id']; ?> , 1)">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $_SESSION['id']; ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="images/profile-1.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>AsmrProg</h2>
                    <p>Fullstack Web Developeraaaa</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Reminders</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Add Reminder</h3>
                    </div>
                </div>

            </div>

        </div>


    </div>
    
    <script src="consulta.js"></script>
    <script src="index.js"></script>
    
    
</body>
<!-- MODAL -->
<div id="ex1" class="modal">
    <!-- MODAL BODY -->

    <div class="row campo">
    <div class="titulo">
  <h2 style="color:black">Adicionar Plano</h2>
</div>

<div class="row campo">
  <div class="col-lg-6">
    <label for="nomePlano" style="color:black">Nome do Plano</label>
    <input class="form-control" id="nomePlano" type="text">
  </div>
  <div class="col-lg-6">
    <label for="txtLabel" style="color:black">Texto Titulo</label>
    <input class="form-control" id="txtLabel" type="text">
  </div>
</div>

<div class="row campo">
  <div class="col-lg-6">
    <label for="detalhePlano" style="color:black">Detalhe Plano</label>
    <textarea class="form-control" id="detalhePlano" rows="4"></textarea>
  </div>
  <div class="col-lg-6">
    <label for="preco" style="color:black">Preço</label>
    <input class="form-control" id="preco" type="text">
  </div>
</div>

<div class="botoes">
  <a class="btn btn-secondary"id="cancelar" rel="modal:close">Cancelar</a>
  <button class="btn btn-primary" id="salvar" onclick="inserirPlano()">Salvar</button>
</div>
    
                    
    <!--FINAL MODAL BODY -->

</div>


</html>