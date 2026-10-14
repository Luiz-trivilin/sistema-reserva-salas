function validarCarateres(texto, op) {
    let carateresEspeciais = '';
    if (op == 0 || undefined) { // espaços
        carateresEspeciais = /[ ]+/;
    }
    else if (op == 1) { // carateres especiais
        carateresEspeciais = /[!@#$%^&*()ºª€£§«»¨_+\-=\[\]{};':"\\|,.<>\/?]+/;
    }
    else if (op == 2) { // carateres portugueses
        carateresEspeciais = /[áàâãäéèêëíìîïóòôõöúùûçñÁÀÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÇÑ]+/;
    }
    if (carateresEspeciais.test(texto)) {
        return true;
    }
    return false;
}

function validarUsername() {
    const username = document.getElementById('utilizador');
    const username_label = document.getElementById('username-label');
    let msg = 'Nome de utilizador';
    if (username.value.trim().length == 0) {
        msg = 'Nome de utilizador: Preencha este campo';
    }
    else if (username.value.trim().length < 4) {
        msg = 'Nome de utilizador: Pelo menos 4 carateres';
    }
    else if (validarCarateres(username.value.trim(), 0)) {
        msg = 'Nome de utilizador: Não digite espaços';
    }
    else if (validarCarateres(username.value.trim(), 1)) {
        msg = 'Nome de utilizado: Não digite carateres especiais';
    }
    else if (validarCarateres(username.value.trim(), 2)) {
        msg = 'Nome de utilizador: Não digite carateres portugueses';
    }
    if (msg != 'Nome de utilizador') {
        username.className = 'form-control is-invalid my-2';
        username_label.style.color = 'red';
        username_label.innerHTML = msg;
    }else {
        const endereco = 'ajax/ajax_verificar_utilizador.php';
        var parametros = 'utilizador="' + username.value.trim() + '"';
        //console.log("Validar");
        $.ajax({
            type: 'POST',
            url: endereco,
            data: parametros,
            dataType: "html",
            timeout: 500,
            success: function (resultado) {
                console.log(resultado);
                if (resultado != 0) {
                    username.className = 'form-control is-invalid my-2';
                    username_label.style.color = 'red';
                    msg = 'Nome de utilizador: Já existe um utilizador com esse nome';
                }
                else {
                    username.className = 'form-control is-valid my-2';
                    username_label.style.color = 'green';
                    msg = "Nome de utilizador";
                }
                username_label.innerHTML = msg;
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log("Erro em criar_utilizador.js:", jqXhr, textStatus, errorMessage);
            }
        });
}
}

function validarPassword() {
    const password = document.getElementById('pass');
    const password_label = document.getElementById('pass-label');
    const confpassword = document.getElementById('confpass');
    const confpassword_label = document.getElementById('confpass-label');
    let msg = 'Palavra passe';
    

    if (password.value.length == 0) {
        msg = 'Palavra passe: Preencha este campo';
    }
    else if (password.value.length < 8) {
        msg = 'Palavra passe: Digite pelo menos 8 carateres';
    }
    else if (validarCarateres(password.value, 0)) {
        msg = 'Palavra passe: Não digite espaços';
    }
    else if (validarCarateres(password.value, 2)) {
        msg = 'Palavra passe: Não digite carateres portugueses';
    }
    else if (confpassword.value.length >= 8 && password.value == confpassword.value) {
        confpassword.className = 'form-control is-valid my-2';
        confpassword_label.style.color = 'green';
        confpassword_label.innerHTML = 'Confirme a palavra passe';
    }
    else if (confpassword.value.length >= 8 && password.value != confpassword.value) {
        confpassword.className = 'form-control is-invalid my-2';
        confpassword_label.style.color = 'red';
        confpassword_label.innerHTML = 'Confirme Palavra passe: Palavras passe diferentes';
    }
    if (msg != 'Palavra passe') {
        password.className = 'form-control is-invalid my-2';
        password_label.style.color = 'red';
    }
    else {
        password.className = 'form-control is-valid my-2';
        password_label.style.color = 'green';
    }
    password_label.innerHTML = msg;
}

function validarConfpassword() {
    const password = document.getElementById('pass');
    const confpassword = document.getElementById('confpass');
    const confpassword_label = document.getElementById('confpass-label');
    let msg = 'Confirme a palavra passe';

    if (confpassword.value.length == 0) {
        msg = 'Confirme a palavra passe: Preencha este campo';
    }
    else if (confpassword.value.length < 8) {
        msg = 'Confirme a palavra passe: Digite pelo menos 8 carateres';
    }
    else if (password.value.length >= 8 && password.value != confpassword.value) {
        msg = 'Confirme a palavra passe: Palavras passe diferentes';
    }
    if (msg != 'Confirme a palavra passe') {
        confpassword.className = 'form-control is-invalid my-2';
        confpassword_label.style.color = 'red';
    }
    else {
        confpassword.className = 'form-control is-valid my-2';
        confpassword_label.style.color = 'green';
    }
    confpassword_label.innerHTML = msg;
}