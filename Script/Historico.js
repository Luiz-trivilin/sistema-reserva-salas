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
                url: 'ajax/Historico.php',
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



function formatar ($d){
    let data_formatada = $d[8] + $d[9]+'-'+$d[5]+$d[6] + '-' +$d[0]+$d[1]+$d[2]+$d[3];
    return data_formatada;
}