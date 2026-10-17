
function mostrarTextoSelecionado() {

    let sala = document.getElementById("sala");
    let horario = document.getElementById("horario");
    let professor = document.getElementById("professor");

    if (!sala || !horario) {
        console.error("Erro: Sala ou horário não encontrado.");
        return;
    }

    let opcaosala = sala.options[sala.selectedIndex];
    let opcaohorario = horario.options[horario.selectedIndex];

    let opcaoprofessor = null;

    if (professor && professor.selectedIndex >= 0) {
        opcaoprofessor = professor.options[professor.selectedIndex];
    }

    if (!opcaosala || !opcaohorario) {
        Swal.fire({
            title: "Atenção!",
            text: "Selecione uma sala e um horário.",
            icon: "warning"
        });
        return;
    }

    let NomeSala = opcaosala.text;
    let id_Horario = opcaohorario.value;
    let NomeProfessor = "";

    if (opcaoprofessor) {
        NomeProfessor = opcaoprofessor.text;
    }

    document.getElementById("Nome_sala").value = NomeSala;
    document.getElementById("id_horario").value = id_Horario;
    document.getElementById("Nome_professor").value = NomeProfessor;

    Swal.fire({
        title: "Tem a certeza que pretende atualizar a marcação?",
        text: "Esta operação não pode ser desfeita.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, atualizar",
        cancelButtonText: "Cancelar"

    }).then((result) => {

        if (result.isConfirmed) {

            document.getElementById("editar_form").submit();

        }

    });
}
