//carregar tudo quando a pagina abrir
$(function() {
    $('#preco').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, ''); // Remove tudo que não é número
    });
    obterAgendamento();
    obterPlano();
    devedores();
    Tema();
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

function devedores() {
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'devedores'
        },
        success: function(response) {
            var dados = JSON.parse(response);
          $("#total_pendente").append(dados.preco_total_pendente);
          $("#total_completos").append(dados.preco_total_completo);
          $("#total_caixa").append(dados.total_caixa);

          var t = parseInt(dados.total_caixa);
          var c = parseInt(dados.preco_total_completo);
          var p = parseInt(dados.preco_total_pendente);
          var porcentagemCompleto = (c / t) * 100;
          var porcentagemPendente = (p / t) * 100;
          var p_completo = `<div class="chart" data-percent="${porcentagemCompleto}" data-bar-color="#a7d212">
                                <span class="percent" data-after="%">${porcentagemCompleto}</span>
                            </div>`;
          var p_pendente =  `<div class="chart" data-percent="${porcentagemPendente}" data-bar-color="#edc214">
                                <span class="percent" data-after="%">${porcentagemPendente}</span>
                            </div>`;
            $("#porcentagem_completo").append(p_completo);
            $("#porcentagem_pendente").append(p_pendente);

            
        },
        error: function(xhr, status, error) {
            toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function Tema() {
  
    $.ajax({
        
        type: "POST",
        url: "consulta.php",
        data: {
           acao : "usuario"
        },
        success: function(response) {
          var dados = JSON.parse(response);
          if(dados.Tema == null){
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

function editarTema(id,tema) {
    $.ajax({
        type: "POST",
        url: "consulta2.php",
        data: {
            acao: 'editar_tema',
            id:id,
            tema:tema
        },
        success: function(response) {
            debugger;
            var resultados = JSON.parse(response);
            if(resultados.codigo==0){
                window.location.href = 'index.php';
            }
           
          
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

'use strict';

var $window = $(window);

function run()
{
	var fName = arguments[0],
		aArgs = Array.prototype.slice.call(arguments, 1);
	try {
		fName.apply(window, aArgs);
	} catch(err) {
		 
	}
};
 
/* chart
================================================== */
function _chart ()
{
	$('.b-skills').appear(function() {
		setTimeout(function() {
			$('.chart').easyPieChart({
				easing: 'easeOutElastic',
				delay: 3000,
				barColor: '#369670',
				trackColor: '#fff',
				scaleColor: false,
				lineWidth: 21,
				trackWidth: 21,
				size: 250,
				lineCap: 'round',
				onStep: function(from, to, percent) {
					this.el.children[0].innerHTML = Math.round(percent);
				}
			});
		}, 150);
	});
};
 

$(document).ready(function() {
  
	run(_chart);
  
    
});
