//carregar tudo quando a pagina abrir
$(function() {
    $('#preco').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, ''); // Remove tudo que não é número
    });
    obterAgendamento();
    obterPlano();
});

function obterAgendamento() {
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'obterAgendamento'
        },
        success: function(response) {
            var resultados = JSON.parse(response);
            var html= "";
            for(var i=0; i<resultados.dados.length;i++){
                html+="<tr>"
                html+=`<td>${resultados.dados[i].nome}</td>`;
                html+=`<td>${resultados.dados[i].telefone}</td>`;
                html+=`<td>${resultados.dados[i].plano}</td>`;
                html+=`<td>${resultados.dados[i].data_agendamento}</td>`;
                html+=`<td>${resultados.dados[i].hora_agendamento}</td>`;
                html+=`<td>
                <select id="status_${resultados.dados[i].id}" onchange="editarStatus(${resultados.dados[i].id})" >
                <option ${(resultados.dados[i].status=="Confirmado")?"selected":""}>Confirmado</option>
                <option ${(resultados.dados[i].status=="Pendente")?"selected":""}>Pendente</option>
                <option ${(resultados.dados[i].status=="Cancelado")?"selected":""}>Cancelado</option>
                </select></td>`;
                html+="<td><a href='javascript:deletarAgendamento("+resultados.dados[i].id+")'><span class='material-icons-sharp'>delete</span></a></td>"
                html+="</tr>";
            }
           
          $("#agendamento").append(html);
           
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function editarStatus(id) {
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'editar_status',
            id_agendamento:id,
            status:$(`#status_${id}`).val()
        },
        success: function(response) {
            var resultados = JSON.parse(response);
            if(resultados.codigo==0){
                toastr.success(resultados.mensagem);
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 500);
            }else{
                toastr.error(resultados.mensagem);
            }
           
          
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function deletarAgendamento(id){
    if(!confirm("Deseja remover o agendamento? ")){return false;}
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'excluir_agendamento',
            id_agendamento:id
        },
        success: function(response) {
            var resultados = JSON.parse(response);
            if(resultados.codigo==0){
                toastr.success(resultados.mensagem);
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 500);
            }else{
                toastr.error(resultados.mensagem);
            }
           
          
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function obterPlano() {
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'obterPlano'
        },
        success: function(response) {
            var resultados = JSON.parse(response);
            var html= "";
            for(var i=0; i<resultados.dados.length;i++){
                html+="<tr>"
                html+=`<td>${resultados.dados[i].nome_plano}</td>`;
                html+=`<td>${resultados.dados[i].txt_label}</td>`;
                html+=`<td>${resultados.dados[i].descricao}</td>`;
                html+=`<td>${resultados.dados[i].preco_plano}</td>`;
                html += "<td><a href='javascript:deletarPlano(" + resultados.dados[i].cod_planos + ")' style='cursor: pointer;'><span class='material-icons-sharp'>delete</span></a></td>";
                html+="</tr>";
            }
           
          $("#planos").append(html);
           
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function inserirPlano() {
    var nomePlano = $("#nomePlano").val();
    var txtLabel = $("#txtLabel").val();
    var detalhePlano = $("#detalhePlano").val();
    var preco = $("#preco").val();
    if(nomePlano=="" || nomePlano==null){
        toastr.error("Nome não pode ser vazio!");
        return false;
       }
       if(txtLabel=="" || txtLabel==null){
        toastr.error("Titulo não pode ser vazio!");
        return false;
       }
       if(detalhePlano=="" || detalhePlano==null){
        toastr.error("Descrição não pode ser vazio!");
        return false;
       }
       if(preco=="" || preco==null){
        toastr.error("preço não pode ser vazio!");
        return false;
       }
    $.ajax({
        
        type: "POST",
        url: "consulta.php",
        data: {
            nomePlano: nomePlano,
            txtLabel: txtLabel,
            detalhePlano: detalhePlano,
            preco: preco,
            acao: 'plano'
        },
        success: function(response) {
          debugger;
            var dados = JSON.parse(response);
            if(dados.codigo==0){
            toastr.success(dados.mensagem);
            $("#nomePlano").val("");
            $("#txtLabel").val("");
            $("#detalhePlano").val("");
            $("#preco").val("");
            $("#cancelar").click();
            // Redireciona para uma nova página após 3 segundos
          setTimeout(function() {
           window.location.href = 'index.php';
}, 3000); // 3000 milissegundos = 3 segundos
            }else{
              toastr.error(dados.mensagem);
            }
           
        },
        error: function(xhr, status, error) {
            toastr.error("Erro ao criar plano: " + error);
        }
    });
}


function deletarPlano(idPlano) {
    if (confirm("Tem certeza que deseja excluir este plano?")) {
        $.ajax({
            type: "POST",
            url: "consulta.php",
            data: {
                acao: 'excluirPlano',
                id_plano: idPlano
            },
            success: function(response) {
                debugger;
                var resultado = JSON.parse(response);
                if (resultado.codigo == 0) {
                    toastr.success(resultado.mensagem);
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 500);
                } else {
                    toastr.error(resultado.mensagem);  
                }
            },
            error: function(xhr, status, error) {
                toastr.error("Erro ao excluir plano: " + error);
            }
        });
    }
}
