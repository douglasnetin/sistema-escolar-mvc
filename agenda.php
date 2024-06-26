<!DOCTYPE html>
<html style="height: 100%;">
<head>
  <title>Agendamento</title>
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
<style>
        body,
        html {
            height: 100%;
        }

        .card-box {
            height: 80vh; /* Altura ajustável */
        }
        .carousel-item {
            height: 100%;
        }

        .carousel-inner {
            height: 100%;
        }

        #promocoesCarrossel {
            height: 100%;
        }

        .container-fluid {
            height: 100%;
        }

       
</style>
<body style="height: 90vh;">
  <div class="container-fluid h-50 ">
    <div class="row h-50">
      <div class="col-lg-6 h-50 mt-5" id="promocoesCarrossel"></div>
      <div class="col-lg-6 h-100 mt-5">
        <div class="card-box h-80 p-5 mt-5 bg-dark text-white">
          <h1 id="titulo" style="color: #ffffff;">Agendamento de Horário</h1>
          <div class="row ">
        <div class="col-md-6">
            <div class="campo">
            <label for="nome"><strong>Nome</strong></label>
            <input type="text" maxlength="45" name="nome" id="nome" style="width:100%;" value="" required>
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
                <div class="input-group">
                  <select name="horario" id="horario" required style="width:100%;">
                  <option selected disabled value="">Selecione</option>
                  </select>
                </div>
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
                <input type="text" name="data" id="data" disabled required style="width:88%; background-color: #ffffff;">
                <span class="input-group-addon" id="calendar-icon" style="color: #ffffff;">
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
      promocoes();
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

      function promocoes(){
          $.ajax({
            type: "POST",
            url: "processar_agendamento.php", 
            data: {
                acao:"promocoes"
            },
            success: function(response) {
    debugger;
    var dados = JSON.parse(response);
    let html = "";
    html += '<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">'
    html +=   '<div class="carousel-inner">'
    
    $.each(dados, function(index,obj){
        html += `<div class="carousel-item ${(index == 0) ? 'active' : ''}">`
        html += '<div class="row justify-content-center">'
        html += '<div class="col-md-6">'
        html += '<div class="card bg-dark text-white">'
        html += '<img src="https://via.placeholder.com/300" class="card-img-top" alt="Imagem do plano">'
        html += '<div class="card-body">'
        html += `<h5 class="card-title">${obj.label}</h5>`        
        html += `<p class="preco"><strong>${obj.desc_plano}</strong><br>`
        html += `<p class="preco"><strong>R$ ${obj.preco_plano} </strong><br>`
        html += 'parcelamos em até 3x no cartão'
        html += '</p>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
    })

    html +=   '</div>'               
    html +=   '<a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">'
    html +=     '<span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>'
    html +=     '<span class="sr-only">Previous</span>'
    html +=   '</a>'
    html +=   '<a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">'
    html +=     '<span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>'
    html +=     '<span class="sr-only">Next</span>'
    html +=   '</a>'
    html += '</div>'
    $("#promocoesCarrossel").empty();
    $("#promocoesCarrossel").append(html);
}

,
            error: function(xhr, status, error) {
              toastr.error("Erro ao criar agendamento: " + error);
            }
          });
      }
     
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
              $("#pagamento").val("");
              $("#horario").empty();
              $("#horario").append("<option selected>Selecionar</option>");
              selectPlanos();
            },
            error: function(xhr, status, error) {
              toastr.error("Erro ao criar agendamento: " + error);
            }
          });
      }
      
      $("#concluir").on("click", function(){
        agendamento();
      });

      $("#data").on("change", function(){        
        selecthorario();
      })
      
      $("#cancelar").on("click", function(){
        window.location.href="index.php";
      });
    });

    function selectPlanos(){
          $.ajax({
            type: "POST",
            url: "processar_agendamento.php", 
            data: {
                acao:"selectPlanos"
            },
            success: function(response) {
              let dados = JSON.parse(response);
              let html = "<option disabled selected>Selecionar</option>";
              for(let i = 0; i < dados.length; i++){                
                html+=`<option value="${dados[i].nome_plano}">${dados[i].nome_plano}</option>`;
              }
              $("#plano").empty();
              $("#plano").append(html);
            },
            error: function(xhr, status, error) {
              toastr.error("Erro ao criar agendamento: " + error);
            }
          });
    }
  
    function selecthorario(){
         $.ajax({
           type: "POST",
           url: "processar_agendamento.php", 
           data: {
               acao:"Hora"
           },
           success: function(response) {
            let dados = JSON.parse(response);
            debugger;
            let html = "<option disabled selected>Selecionar</option>";
            for(var i = 0; i < dados.length; i++){
              
            let validar = Validarhorario(dados[i].cod_horario); 
              if(validar<3){
               debugger;
              html+=`<option value="${dados[i].hr_horario}">${dados[i].hr_horario}</option>`;
             }
            }
             $("#horario").empty();
             $("#horario").append(html);
           },
           error: function(xhr, status, error) {
             toastr.error("Erro ao criar agendamento: " + error);
           }
         });
   }

   function Validarhorario(cod_horario){
     let data = $("#data").val();
     let partes = data.split("/");
     let datacerta = partes[2] + "-" + partes[1] + "-" + partes[0];
     let retorno;
         $.ajax({
           type: "POST",
           url: "processar_agendamento.php", 
           async: false,
           data: {
               acao:"validarhorario",
               cod_horario:cod_horario,
               data_Agendamento: datacerta
           },
           success: function(response) {
            let dados = JSON.parse(response);
            retorno = parseInt(dados[0].numAgendamentos);
           },
           error: function(xhr, status, error) {
             toastr.error("Erro ao criar agendamento: " + error);
           }
         });
         return retorno;
   }

    function validarAgendamento(){
       let nome = $("#nome").val();
       let telefone = $("#telefone").val();
       let data = $("#data").val();
       let horario = $("#horario").val();
       let plano = $("#plano").val();
       let pagamento = $("#pagamento").val();
       if(nome == ""){
        toastr.error("Nome não pode ser vazio!");
        return false;
       }
       if(telefone == ""){
        toastr.error("Telefone não pode ser vazio!");
        return false;
       }
       if(data == ""){
        toastr.error("Data não pode ser vazio!");
        return false;
       }
       if(horario == "" || horario == null){
        toastr.error("Horario não pode ser vazio!");
        return false;
       }
       if(plano == "" || plano == null){
        toastr.error("Plano não pode ser vazio!");
        return false;
       }
       if(pagamento == "" || pagamento == null){
        toastr.error("Pagamento não pode ser vazio!");
        return false;
       }
       return true;
    }
  </script>
</body>
</html>
