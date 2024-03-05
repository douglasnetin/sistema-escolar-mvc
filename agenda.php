<!DOCTYPE html>
<html style="height: 100%;">
<head>
  <title>Cadastro</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="images/favicon.png" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/agenda.css" rel="stylesheet" defer />
  <!-- Adicionando estilos do jQuery UI -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Adicionando Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Adicionando Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

</head>
<body style="height: 90vh;">
  <div class="container-fluid h-100 ">
    <div class="row h-90">
      <div class="col-lg-6 h-70 mt-5">
        <div class="card-box h-100 text-center">
          <h1 id="titulo">Planos</h1>
          <div id="carouselExampleSlidesOnly" class="carousel slide h-80 mt-5" data-ride="carousel">
            <div class="carousel-inner h-100">
              <div class="carousel-item active h-100">
                <div class="row h-100">
                  <div class="col-lg-6 h-100">
                    <div class="card-box bg-primary h-100">
                      <h5 class="tdt-slider-heading">PACOTE 50 MINUTOS - 3 SESSÕES</h5>
                      <ul>
                        3 sessões de 50 minutos;
                        Incluso biquini e acelerador de marquinha;
                      </ul>
                      <p class="preco"><strong>R$ 300,00 </strong><br>
                        parcelamos em até 3x no cartão
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-6 h-100">
                    <div class="card-box bg-primary h-100">
                      <h5 class="tdt-slider-heading">PACOTE 50 MINUTOS - 3 SESSÕES</h5>
                      <ul>
                        3 sessões de 50 minutos;
                        Incluso biquini e acelerador de marquinha;
                      </ul>
                      <p class="preco"><strong>R$ 300,00 </strong><br>
                        parcelamos em até 3x no cartão
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item h-100">
                <div class="row h-100">
                  <div class="col-lg-6 h-100">
                    <div class="card-box bg-primary h-100">
                      <h5 class="tdt-slider-heading">PACOTE 50 MINUTOS - 3 SESSÕES</h5>
                      <ul>
                        3 sessões de 50 minutos;
                        Incluso biquini e acelerador de marquinha;
                      </ul>
                      <p class="preco"><strong>R$ 300,00 </strong><br>
                        parcelamos em até 3x no cartão
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-6 h-100">
                    <div class="card-box bg-primary h-100">
                      <h5 class="tdt-slider-heading">PACOTE 50 MINUTOS - 3 SESSÕES</h5>
                      <ul>
                        3 sessões de 50 minutos;
                        Incluso biquini e acelerador de marquinha;
                      </ul>
                      <p class="preco"><strong>R$ 300,00 </strong><br>
                        parcelamos em até 3x no cartão
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 h-100 mt-5">
        <div class="card-box h-80 p-5 mt-5">
          <h1 id="titulo">Agendamento de Horário</h1>
          <div class="row ">
        <div class="col-md-6">
            <div class="campo">
                <label for="nome"><strong>Nome</strong></label>
                <input type="text" maxlength="45" name="nome" id="nome" style="width:100%;" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="campo">
                <label for="telefone"><strong>Telefone</strong></label>
                <input type="text" name="telefone" id="telefone" required style="width:100%;">
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="campo">
                <label for="horario"><strong>Horário</strong></label>
                <select name="horario" id="horario" required style="width:100%;">
                    <option selected disabled value="">Selecione</option>
                    <option>08:00</option>
                    <option>09:00</option>
                    <option>10:00</option>
                    <option>11:00</option>
                    <option>12:00</option>
                    <option>13:00</option>
                    <option>14:00</option>
                    <option>15:00</option>
                    <option>16:00</option>
                    <option>17:00</option>
                </select>
            </div>
            <div class="campo">
                <label for="horario"><strong>Plano</strong></label>
                <div class="input-group">
                <select name="plano" id="plano" required style="width:100%;">
                    <option selected disabled value="">Selecione</option>
                </select>
                </div>
            </div>
            <div>
                <button id="concluir" class="btn btn-primary" style="width:100%;">Agendar</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="campo">
                <label for="data"><strong>Data</strong></label>
                <div class="input-group">
                    <input type="text" name="data" id="data" disabled required style="width:88%;">
                    <span class="input-group-addon" id="calendar-icon">
                        <i class="material-icons">calendar_today</i>
                    </span>
                </div>
            </div>
            <div class="campo">
                <label for="horario"><strong>Pagamento</strong></label>
                
                <select name="pagamento" id="pagamento" required style="width:100%;">
                    <option selected disabled value="">Selecione</option>
                    <option>PIX</option>
                    <option>Crédito</option>
                    <option>Débito</option>
                </select>
            </div>
            <div >
                <button class="btn btn-danger" id="cancelar" style="width:100%;">Cancelar</button>
            </div>
        </div>
    </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function() {
      $('#telefone').mask('(00) 00000-0000');
      selectPlanos();
      $("#data").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: 0 // Bloqueia datas anteriores à atual
      });
      // Quando o ícone de calendário é clicado, mostra o datepicker
      $("#calendar-icon").click(function() {
        $("#data").datepicker("show");
      });
     
      function agendamento(){
        if(!validarAgendamento()){return false;}
          var nome = $("#nome").val();
          var telefone = $("#telefone").val();
          var horario = $("#horario").val();
          var data = $("#data").val();
          var pagamento = $("#pagamento").val();
          var plano = $("#plano").val();
          debugger;
          $.ajax({
            type: "POST",
            url: "processar_agendamento.php", 
            data: {
                nome: nome,
                telefone: telefone,
                horario: horario,
                data: data,
                pagamento:pagamento,
                plano:plano,
                acao:"I"
            },
            success: function(response) {
              var dados = JSON.parse(response);
              toastr.success(dados.mensagem);
              $("#nome").val("");
              $("#telefone").val("");
              $("#horario").val("");
              $("#data").val("");
            },
            error: function(xhr, status, error) {
              toastr.error("Erro ao criar agendamento: " + error);
            }
          });
      }
      
      $("#concluir").on("click", function(){
        agendamento();
      });
      
      $("#cancelar").on("click", function(){
        window.location.href="index.php";
      });
    });

    function selectPlanos(){
         
          debugger;
          $.ajax({
            type: "POST",
            url: "processar_agendamento.php", 
            data: {
                acao:"selectPlanos"
            },
            success: function(response) {
              var dados = JSON.parse(response);
             debugger;
             var html = "";
             for(var i = 0; i < dados.length; i++){
              
              html+=`<option value="${dados[i].nome_plano}">${dados[i].nome_plano}</option>`;

             }
              $("#plano").append(html);
            },
            error: function(xhr, status, error) {
              toastr.error("Erro ao criar agendamento: " + error);
            }
          });
    }
  
    function validarAgendamento(){
       var nome = $("#nome").val();
       var telefone = $("#telefone").val();
       var data = $("#data").val();
       var horario = $("#horario").val();
       var plano = $("#plano").val();
       var pagamento = $("#pagamento").val();
      debugger;
       if(nome==""){
        toastr.error("Nome não pode ser vazio!");
        return false;
       }
       if(telefone==""){
        toastr.error("Telefone não pode ser vazio!");
        return false;
       }
       if(data==""){
        toastr.error("Data não pode ser vazio!");
        return false;
       }
       if(horario=="" || horario==null){
        toastr.error("Horario não pode ser vazio!");
        return false;
       }
       if(plano=="" || plano==null){
        toastr.error("Plano não pode ser vazio!");
        return false;
       }
       if(pagamento=="" || pagamento==null){
        toastr.error("Pagamento não pode ser vazio!");
        return false;
       }
       return true;
    }
  </script>
</body>
</html>
