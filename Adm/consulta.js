$(function() {
    $('#preco').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    obterPromocao()
    obterAgendamento();
    obterPlano();
    devedores();
    obterusuario();
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
                var telefoneFormatado = formatarNumero(resultados.dados[i].telefone);
                html+=`<td><a href="https://api.whatsapp.com/send?phone=${telefoneFormatado}" target="_blank">${resultados.dados[i].telefone}</a></td>`;
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

function formatarNumero(num) {
    return num.replace(/\D/g, '');
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

function obterPromocao() {
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'obterPromocao'
        },
        success: function(response) {
            var resultados = JSON.parse(response);
            var html= "";
            for(var i=0; i<resultados.dados.length;i++){
                html+="<tr>"
                html+=`<td>${resultados.dados[i].titulo}</td>`;
                html+=`<td>${resultados.dados[i].descricao}</td>`;
                html+=`<td>${resultados.dados[i].label}</td>`;
                html += "<td><a href='javascript:deletarPromocao(" + resultados.dados[i].id + ")' style='cursor: pointer;'><span class='material-icons-sharp'>delete</span></a></td>";
                html+="</tr>";
            }
           
          $("#promocoesTable").append(html);
           
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function obterusuario() {
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'obterUsuario'
        },
        success: function(response) {
            debugger;
            var resultados = JSON.parse(response);
            var html= "";
            for(var i=0; i<resultados.dados.length;i++){
                html+="<tr>"
                html+=`<td style="text-align: center;">${resultados.dados[i].usuario}</td>`;
                html+=`<td style="text-align: center;">${resultados.dados[i].nome}</td>`;
                html+=`<td style="text-align: center;">${resultados.dados[i].email}</td>`;
                html += "<td style='text-align: center;'><a href='javascript:deletarUsuario(" + resultados.dados[i].id + ")' style='cursor: pointer;'><span class='material-icons-sharp'>delete</span></a></td>";
                html+="</tr>";
            }
           
          $("#usuarioModal").empty().append(html);
           
        },error: function(xhr, status, error) {
          toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function deletarPromocao(id){
    if(!confirm("Deseja remover a promoção? ")){return false;}
    $.ajax({
        type: "POST",
        url: "consulta.php",
        data: {
            acao: 'excluir_promocao',
            id_promocao:id
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
            var dados = JSON.parse(response);
            if(dados.codigo==0){
            toastr.success(dados.mensagem);
            $("#nomePlano").val("");
            $("#txtLabel").val("");
            $("#detalhePlano").val("");
            $("#preco").val("");
            $("#cancelar").click();
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000); 
            }else{
              toastr.error(dados.mensagem);
            }
           
        },
        error: function(xhr, status, error) {
            toastr.error("Erro ao criar plano: " + error);
        }
    });
}

function inserirPromocao() {
    var nomePromocao = $("#nomePromocao").val();
    var tituloPromocao = $("#tituloPromocao").val();
    var detalhePromocao = $("#detalhePromocao").val();
    var precoPromocao = $("#precoPromocao").val();

    if(nomePromocao == "" || nomePromocao == null){
        toastr.error("Nome não pode ser vazio!");
        return false;
    }

    if(tituloPromocao == "" || tituloPromocao == null){
        toastr.error("Titulo não pode ser vazio!");
        return false;
    }

    if(detalhePromocao == "" || detalhePromocao == null){
        toastr.error("Descrição não pode ser vazio!");
        return false;
    }

    $.ajax({    
        type: "POST",
        url: "consulta.php",
        data: {
            nomePromocao: nomePromocao,
            tituloPromocao: tituloPromocao,
            detalhePromocao: detalhePromocao,
            acao: 'adicionarPromocao'
        },
        success: function(response) {
            var dados = JSON.parse(response);
            if(dados.codigo==0){
            toastr.success(dados.mensagem);
            $("#nomePlano").val("");
            $("#txtLabel").val("");
            $("#detalhePlano").val("");
            $("#preco").val("");
            $("#cancelar").click();
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000); 
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
          $("#total_pendente").append(dados.preco_total_pendente ?? 0);
          $("#total_completos").append(dados.preco_total_completo ?? 0);
          $("#total_caixa").append(dados.total_caixa ?? 0);

          var t = parseInt(dados.total_caixa ?? 0); 
          var c = parseInt(dados.preco_total_completo ?? 0);
          var p = parseInt(dados.preco_total_pendente ?? 0);
          var porcentagemCompleto = (c == 0) ? 0 : (c / t) * 100;
          var porcentagemPendente = (p == 0) ? 0 : (p / t) * 100;
          var p_completo = `<div class="chart" data-percent="${porcentagemCompleto}" data-bar-color="#a7d212">
                                <span class="percent" data-after="%">${porcentagemCompleto}</span>
                            </div>`;
          var p_pendente =  `<div class="chart" data-percent="${porcentagemPendente *2}" data-bar-color="#edc214">
                                <span class="percent" data-after="%">${porcentagemPendente *2}</span>
                            </div>`;
            $("#porcentagem_completo").append(p_completo);
            $("#porcentagem_pendente").append(p_pendente);

            
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
