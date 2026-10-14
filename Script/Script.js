// Create a constant with the months of the year in Portuguese from Portugal
const monthsPt = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
//import defaultExport from "code.jquery.com/jquery-3.4.1.min.js";


let selectedDay = null;
let selectedCell = null;    
let ultimodiaclick = null;




// Adds an event that triggers when the document content is fully loaded
document.addEventListener('DOMContentLoaded', function () {

    // Array containing the names of the months in Portuguese
    const tableDays = document.getElementById('dias'); // Gets the days table by ID
    const forms = document.querySelectorAll('form');



    tableDays.addEventListener('click', function (evento) {
        const celula = evento.target.closest('td');

        if (celula) {
            const daySelect = parseInt(celula.innerHTML);
            let now = new Date();
            //If this causes a problem again, checking the value of the dia_atual and dia_click variables, if the getDate of the dia_atual is changed to getDay it will give an error that it will fetch the day of the week and not the value of the day, even I don't know how to explain this properly but it works
            let dia_atual = now.getDate(); // Get the current day through the computer system itself
            let mes_atual = now.getMonth(); // Current month
            let ano_atual = now.getFullYear(); // Current year
            let dia_click = parseInt(celula.innerHTML); // Gets the clicked day from the cell content (cell) and converts it to an integer
            let mes_click = document.getElementById('mes').value; // Gets the value of the month clicked from an element with id 'mes'
            let ano_click = parseInt(document.getElementById('ano').innerText); // Gets the value of the clicked year from the text of an element with id 'year'

            document.getElementById('dia_click').value = dia_click;
            document.getElementById('mes_click').value = mes_click;
            document.getElementById('ano_click').value = ano_click;

            if (!celula.classList.contains('mes-anterior') && !celula.classList.contains('mes-proximo') && !celula.classList.contains('fim_de_semana')) {
                if (selectedDay === daySelect) {
                    celula.style.backgroundColor = null;
                    celula.style.color = null;
                    selectedDay = null;
                    selectedCell = null;
                }
                else {
                    if (selectedCell) {
                        selectedCell.style.backgroundColor = null;
                        selectedCell.style.color = null;
                    }
                    // Checks if the clicked year is greater than the current year or
                    // if the clicked month is greater than or equal to the current month and the clicked day is greater than or equal to the current day
                    if (ano_click > ano_atual || (ano_click === ano_atual && (mes_click > mes_atual || (mes_click === mes_atual && dia_click >= dia_atual)))) {
                        celula.style.backgroundColor = "#00008B";
                        celula.style.color = "#f9f9f9";
                        selectedDay = daySelect;
                        selectedCell = celula;

                        document.getElementById('dia_post').value = selectedDay;
                        
                        document.getElementById('mes_post').value = mes_click;
                        

                        document.getElementById('ano_post').value = ano_click;
                        
                        if(!celula.classList.contains('mes-anterior') && !celula.classList.contains('mes-proximo') && !celula.classList.contains('fim_de_semana')){
                            celula.addEventListener('dblclick',function(evento){
                                document.getElementById('marcar_form').submit();
                            })
                        }
                    }
                    else {
                        // If the clicked date is not valid, display the error modal ("ModalError")
                        const modall = document.getElementById("ModalError");

                        // Button to close the error modal
                        const spann = document.getElementsByClassName("closeError")[0];

                        // Display the error modal
                        modall.style.display = "block";

                        // When clicking the close button, the error modal is hidden
                        spann.onclick = function () {
                            modall.style.display = "none";
                        }

                        // If you click outside the error modal, it is also closed
                        window.onclick = function (event) {
                            if (event.target == modall) {
                                modall.style.display = "none";
                            }
                        }

                    }
                }
            }
        }
    })

    const MarcarForms = document.querySelector('form.marcar');

    if (MarcarForms) {
        MarcarForms.addEventListener('submit', function (evento) {
            if (selectedDay === null) {
                evento.preventDefault();
                const modalNotSelected = document.getElementById("ModalNotSelect");
                modalNotSelected.style.display = "block";
                const closeBtn = modalNotSelected.querySelector('.closeError');
                closeBtn.onclick = function () {
                    modalNotSelected.style.display = "none"; // Fecha o modal quando clicar no 'x'
                };
                window.onclick = function (event) {
                    if (event.target == modalNotSelected) {
                        modalNotSelected.style.display = "none"; // Fecha o modal se clicar fora dele
                    }
                };
            }
        })
    }


    // Gets the current date
    let now = new Date();

    // Current month
    let month = now.getMonth();

    // Current year
    let year = now.getFullYear();

    // Calculates the first day of the week of the month and the last day of the month
    let firstDayOfWeek = new Date(year, month, 1).getDay() - 1;
    let getLastDayThisMonth = new Date(year, month + 1, 0).getDate();

    // Updates the displayed month and year
    document.getElementById('mes').innerHTML = monthsPt[month];
    document.getElementById('mes').value = month;
    document.getElementById('ano').innerHTML = year;

    // Loop to fill in the days of the table
    for (var i = -firstDayOfWeek, index = 0; i < (42 - firstDayOfWeek); i++, index++) {
        // Creates a date object for the current loop day
        let dt = new Date(year, month, i);

        // Gets the corresponding table cell
        let dayTable = tableDays.getElementsByTagName('td')[index];

        // Gets the current day of the month and formats it to always have two digits (e.g. "05" instead of "5")
        var dd = String(now.getDate()).padStart(2, '0');

        // Gets the current month and formats it to always have two digits
        // The getMonth() function returns the month in the format 0 to 11, where January is 0
        // Then, we add 1 to represent the month in the most common way (ex: January as 1)
        var mm = String(now.getMonth() + 1).padStart(2, '0');

        // Converts the string 'dd' to an integer to work with the numeric value of the day
        let currentDay = parseInt(dd);

        // Converts the string 'mm' to an integer and subtracts 1 to use the value in a month index logic (from 0 to 11)
        let currentMounth = parseInt(mm) - 1;

        // Removes classes for previous month, next month, and current day
        dayTable.classList.remove('mes-anterior');
        dayTable.classList.remove('mes-proximo');
        dayTable.classList.remove('dia-atual');
        dayTable.classList.remove('fim_de_semana');

        // Sets the day number in the cell
        dayTable.innerHTML = dt.getDate();


        // create event listener for each table cell
        dayTable.addEventListener('click', function (evento) {

            // https://stackoverflow.com/questions/62259233/javascript-get-table-cell-content-on-click
            const celula = evento.target.closest('td');

            if (!celula) return;

            // Checks if the element's class is "mes-anterior" or "mes-proximo"
            // If it is one of these, stop the execution of the function (return immediately)
            if (celula.classList.contains("mes-anterior")) {
                return;
            }

            if (celula.classList.contains("mes-proximo")) {
                return;
            }

            if (celula.classList.contains("fim_de_semana")) {
                return;
            }


        });

        // Checks if the current date matches the loop date
        if (dt.getFullYear() == now.getFullYear() && dt.getMonth() == now.getMonth() && dt.getDate() == now.getDate()) {

            // Adds the class for the current day
            dayTable.classList.add('dia-atual');
        }

        if (dt.getDay() === 6 || dt.getDay() === 0) {
            dayTable.classList.add('fim_de_semana');
        }

        // Adds class for days from the previous month
        if (i < 1) {
            dayTable.classList.add('mes-anterior');
        }

        // Adds class for days from the next month
        if (i > getLastDayThisMonth) {
            dayTable.classList.add('mes-proximo');
        }

    }

    // Gets the buttons to navigate between months
    const buttonNext = document.getElementById('btn_prev');
    const buttonPrevious = document.getElementById('btn_ant');




    // Event for the next button
    buttonNext.onclick = function () {

        // Advances to the next month
        month++;

        // If it exceeds December
        if (month >= 12) {

            // Reset to January
            month = 0;

            // Advance to the next year
            year++;
        }

        // Updates the calendar
        updateCalendar(month, year);
    }

    // Event for the previous button
    buttonPrevious.onclick = function () {

        // Moves back to the previous month
        month--;

        // If it goes below January
        if (month < 0) {

            // Reset to December
            month = 11;

            // Move back to the previous year
            year--;
        }

        // Updates the calendar
        updateCalendar(month, year);
    }


});

function updateCalendar(month, year) {
    // Updates the displayed month and year
    document.getElementById('mes').innerHTML = monthsPt[month];
    document.getElementById('mes').value = month;
    document.getElementById('ano').innerHTML = year;

    // Gets the days table by ID
    const tableDays = document.getElementById('dias');

    // Calculates the first day of the week of the month and the last day of the month
    let firstDayOfWeek = new Date(year, month, 1).getDay() - 1;
    let getLastDayThisMonth = new Date(year, month + 1, 0).getDate();

    // Loop to fill in the days of the table
    for (var i = -firstDayOfWeek, index = 0; i < (42 - firstDayOfWeek); i++, index++) {

        // Creates a date object for the current loop day
        let dt = new Date(year, month, i);

        // Current date
        let dtNow = new Date();

        // Gets the corresponding table cell
        let dayTable = tableDays.getElementsByTagName('td')[index];

        // Create a new Date object representing the current date and time
        var today = new Date();

        // Gets the current day of the month and formats it to always have two digits (e.g. "05" instead of "5")
        var dd = String(today.getDate()).padStart(2, '0');

        // Gets the current month and formats it to always have two digits
        // The getMonth() function returns the month in the format 0 to 11, where January is 0
        // Then, we add 1 to represent the month in the most common way (ex: January as 1)
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!       

        // Converts the string 'dd' to an integer to work with the numeric value of the day
        let currentDay = parseInt(dd);

        // Converts the string 'mm' to an integer and subtracts 1 to use the value in a month index logic (from 0 to 11)
        let currentMounth = parseInt(mm) - 1;


        // Removes classes for previous month, next month, and current day
        dayTable.classList.remove('mes-anterior');
        dayTable.classList.remove('mes-proximo');
        dayTable.classList.remove('dia-atual');
        dayTable.innerHTML = dt.getDate(); // Sets the day number in the cell

        // Checks if the current date matches the loop date
        if (dt.getFullYear() == dtNow.getFullYear() && dt.getMonth() == dtNow.getMonth() && dt.getDate() == dtNow.getDate()) {
            dayTable.classList.add('dia-atual'); // Adds the class for the current day
        }

        if (dt.getDay() === 6 || dt.getDay() === 0) {
            dayTable.classList.add('fim_de_semana');
        }

        // Adds class for days from the previous month
        if (i < 1) {
            dayTable.classList.add('mes-anterior');
        }

        // Adds class for days from the next month
        if (i > getLastDayThisMonth) {
            dayTable.classList.add('mes-proximo');
        }

    }

}

document.getElementById('sala').addEventListener('change', function () {
    const salaSelecionada = this.value;
    const tabelaBody = document.querySelector('#horarios-tabela tbody');

    tabelaBody.innerHTML = '';

    if (salaSelecionada) {
        document.getElementById('salas-marcadas').style.display = 'block';
        let data_formatada = `${ano_click.value}-${mes_click.value}-${dia_click.value}`;
        var sala = document.getElementById('sala').value;

        let parametros = {
            id_sala: sala,
            data_formatada: data_formatada
        };
        $.ajax({
            url: 'ajax/ajax_salas.php',
            method: 'POST',
            data: parametros,
            dataType: 'json',
            success: function (response) {
                try {
                    const horarios = response;
                    horarios.forEach(function (horario) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${horario.horario_inicio.substring(0, 5)}</td>
                            <td>${horario.horario_fim.substring(0, 5)}</td>
                            <td>
                                <input type="button" class="editar" id="botao" value="Marcar" onclick="submeter(${horario.id_horario})">
                            </td>
                        `;
                        tabelaBody.appendChild(row);
                    });
                } catch (error) {
                    console.error("Erro ao processar a resposta JSON:", error, response);
                }
            }

        });
    } else {
        document.getElementById('salas-marcadas').style.display = 'none';
    }
});

function submeter($id_horario) {
    document.getElementById('id_sala').value = document.getElementById('sala').value;
    document.getElementById('id_horario').value = $id_horario;

    document.getElementById('formulario').submit();
}



