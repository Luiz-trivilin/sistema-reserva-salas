
let botao = '<td> <input name="editar" type="submit" value="Atualiar" onclick="mostrarTextoSelecionado()"> </td>';
const tabelaBody = document.querySelector('#horarios-tabela');
const row = document.createElement('tr');
row.innerHTML = botao;
tabelaBody.appendChild(row);


function mostrarTextoSelecionado() {
    let sala = document.getElementById("sala");
    let horario = document.getElementById("horario");
    let professor = document.getElementById("professor");
    if (!sala || !horario) {
        console.error("Erro: Um dos elementos não foi encontrado.");
        return;
    }
    let opcaosala = sala.options[sala.selectedIndex];
    let opcaohorario = horario.options[horario.selectedIndex];
    let opcaoprofessor = null;
    if (professor) {
        if (professor.selectedIndex > 0) {
            opcaoprofessor = professor.options[professor.selectedIndex];
        }
    }
    if (!opcaosala || !opcaohorario) {
        console.error("Erro: Nenhuma opção selecionada.");
        return;
    }

    let NomeSala = opcaosala.text;
    let id_Horario = opcaohorario.value;
    let NomeProfessor = "";

    if(NomeProfessor){
        NomeProfessor = opcaoprofessor.text;
    }

    
    document.getElementById('Nome_sala').value = NomeSala;
    document.getElementById('id_horario').value = id_Horario;
    document.getElementById('Nome_professor').value = NomeProfessor;

    Swal.fire({
        title: "Tem certeza que predente atualizar a marcação?",
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
                title: "Atualizado",
                text: "Sua marcação foi atualizada.",
                icon: "success"
            }).then(() => {
                document.getElementById('editar_form').submit();
            })
        }
    })

}