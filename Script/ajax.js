$(document).ready(function () {
    setTimeout(carregarHorarios, 500);
})

let primeiravez = true;

function carregarHorarios() {
    var sala_id = document.getElementById('sala').value;
    var data_marcada = document.getElementById('marcacao_id').value;
    var horarioSelect = document.getElementById('horario');
    var horarioAtual = document.getElementById('id_horario').value;

    if (sala_id != "") {
        $.ajax({
            url: 'ajax/Horarios.php',
            method: 'POST',
            data: { id_sala: sala_id, data_marcada: data_marcada,id_horario_atual: horarioAtual },
            dataType: 'json',
            success: function (resposta) {
                try {
                    horarioSelect.innerHTML = '';

                    if (primeiravez) {
                        var defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = document.getElementById('horario_inicio').value;
                        defaultOption.textContent += " - " + document.getElementById('horario_fim').value;
                        horarioSelect.appendChild(defaultOption);
                        primeiravez = false;
                    }


                    if (Array.isArray(resposta) && resposta.length > 0) {
                        resposta.forEach(function (horario) {
                            var option = document.createElement('option');
                            option.value = horario.id_horario;
                            option.textContent = horario.horario_inicio.substring(0, 5) + ' - ' + horario.horario_fim.substring(0, 5);
                            horarioSelect.appendChild(option);
                        });
                    } else {
                        var noHorariosOption = document.createElement('option');
                        noHorariosOption.value = '';
                        noHorariosOption.textContent = 'Nenhum horário encontrado';
                        horarioSelect.appendChild(noHorariosOption);
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
        horarioSelect.innerHTML = '';
        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Selecione a Sala primeiro';
        horarioSelect.appendChild(defaultOption);

    }
}