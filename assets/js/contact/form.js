const inputEmail = document.getElementById('email');
const inputTitle = document.getElementById('title');
const inputMessage = document.getElementById('message');
const btnSendMail = document.getElementById('sendMail');


inputTitle.addEventListener('keyup', validateForm);
inputMessage.addEventListener('keyup', validateForm);
inputEmail.addEventListener('keyup', validateForm);

//Fonction  permettant de valider tout le formulaire
function validateForm() {
    let validEmail = validateEmail(inputEmail);
    let validTitle = validateRequired(inputTitle);
    let validMessage = validateRequired(inputMessage);

    if (validEmail && validTitle && validMessage) {
        btnSendMail.disabled = false;
    } else {
        btnSendMail.disabled = true;
    }
}


function validateEmail(input) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailUser = input.value;
    if (emailUser.match(emailRegex)) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        return true;
    } else {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        return false;
    }
}


function validateRequired(input) {
    if (input.value !== "") {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        return true;
    } else {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        return false;
    }
}