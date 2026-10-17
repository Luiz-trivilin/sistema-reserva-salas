document.addEventListener("DOMContentLoaded", function () {
    // Acessando o valor do PHP no HTML
    const usuariologado = document.getElementById('user-info').getAttribute('data-usuariologado');
    const tipo = document.getElementById('user-tipo').getAttribute('data-tipo');

    document.getElementById('professor').addEventListener('change', function () {
        const professorSelecionado = this.value;
        const tabelaBody = document.querySelector('#horarios-tabela tbody');
        tabelaBody.innerText = '';

        if (professorSelecionado) {
            document.getElementById('professores').style.display = "block";
            $.ajax({
                url: 'ajax/ajax_professor.php',
                method: 'POST',
                data: { professor: professorSelecionado },
                dataType: 'json',
                success: function (resposta) {
                    try {
                        if (Array.isArray(resposta) && resposta.length > 0) {
                            resposta.forEach(function (marcacao) {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${marcacao.nomesala}</td> 
                            <td>${formatar(marcacao.data_marcada)}</td>
                            <td>${marcacao.horario_inicio.substring(0, 5)} - ${marcacao.horario_fim.substring(0, 5)}</td>`
                            
                            if (usuariologado == marcacao.id_utilizador || tipo == 0) {
                                let eliminar = '<td> <input type="button" class="btn btn-eliminar" id="botao" value="Eliminar" onclick="submeter_eliminar('+marcacao.id+')"></td>';
                                    let linha = '<td>';
                                    linha += '<input type="button"  class="btn btn-editar" value="Editar" ';
                                    linha += 'onclick="submeter_editar(\'' + marcacao.id + '\',\'' + marcacao.nomesala + '\',\'' + marcacao.horario_inicio + '\',\'' + marcacao.horario_fim + '\',\'' + marcacao.nomecompleto + '\',\''+ marcacao.id_sala + '\',\''+marcacao.id_horario+'\',\''+marcacao.numfuncionario+'\')">'; 
                                    linha += '</td>';
                                row.insertAdjacentHTML("beforeend",eliminar);
                                row.insertAdjacentHTML("beforeend", linha);
                                
                            } 
                                tabelaBody.appendChild(row);
                            });
                        }
                        else {
                            tabelaBody.innerHTML = '<tr><td colspan="2">Nenhum horário encontrado</td></tr>';
                        }
                    } catch (error) {
                        console.error("Erro ao processar a resposta JSON:", error, resposta);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erro na requisição AJAX:", status, error);
                }
            });
        } else {
            document.getElementById('professores').style.display = 'none';
        }
    });

});

window.addEventListener('DOMContentLoaded', function() {
    const defaultOption = document.getElementById('default-option');
    defaultOption.style.display = 'none';
});

document.getElementById('professor').addEventListener('change',function(){

    const defaultOption = document.getElementById('default-option');
    if(this.value !== ""){
        defaultOption.style.display = 'none';
    }
    else{
        defaultOption.style.display = 'block';
    }
})


function submeter_eliminar($marcacao) {
    Swal.fire({
        title: "Tem certeza que predente eliminar a marcação?",
        text: "Esta operação não pode ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim",
        cancelButtonText: "Não"
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: "Deletado",
            text: "Sua marcação foi deletada.",
            icon: "success" 
          }).then(() => {
            document.getElementById('id_marcacao').value = $marcacao;
            document.getElementById('eliminar').submit();  
          
          });
        }
      });
    // const confirmar = confirm("Tem certeza de que deseja eliminar essa marcação?");
    // if(confimar){
    //     document.getElementById('id_marcacao').value = $marcacao;
    //     document.getElementById('eliminar').submit();
    
    // }
}


//function submeter_editar($marcacao,$nomesala,$horario_inicio,$horario_fim,$nomecompleto) {
function submeter_editar($marcacao,$nomesala,$horario_inicio,$horario_fim,$nomecompleto,$id_sala,$id_horario,$numfuncionario) {

    document.getElementById('id_marcacao_editar').value = $marcacao;
    document.getElementById('nomesala').value = $nomesala;
    document.getElementById('horario_inicio').value = $horario_inicio.substring(0, 5);
    document.getElementById('horario_fim').value = $horario_fim.substring(0, 5);
    document.getElementById('nome_professor').value = $nomecompleto;
    document.getElementById('id_sala').value = $id_sala;
    document.getElementById('id_horario').value = $id_horario;
    document.getElementById('id_professor').value = $numfuncionario;
    document.getElementById('alterar').submit();
}

function submeter_teste(){
}


function formatar ($d){
    let data_formatada = $d[8] + $d[9]+'-'+$d[5]+$d[6] + '-' +$d[0]+$d[1]+$d[2]+$d[3];
    return data_formatada;
}