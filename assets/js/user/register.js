const inputFirstName = document.getElementById('first_name');
const inputLastName = document.getElementById('last_name');
const inputEmail = document.getElementById('email');
const inputRole = document.getElementById('role');
const inputPassword = document.getElementById('password');
const inputConfirmPassword = document.getElementById('confirmPassword');
const btnValidation = document.getElementById('saveUser');

inputFirstName.addEventListener('keyup', validateForm);
inputLastName.addEventListener('keyup', validateForm);
inputEmail.addEventListener('keyup', validateForm);
inputPassword.addEventListener('keyup', validateForm);
inputConfirmPassword.addEventListener('keyup', validateForm);
inputRole.addEventListener('change', validateForm);

//Fonction  permettant de valider tout le formulaire
function validateForm() {
    const firstNameOk = validateRequired(inputFirstName);
    const lastNameOk = validateRequired(inputLastName);
    const emailOk = validateEmail(inputEmail);
    const roleOk = validateRequired(inputRole);
    const passwordOk = validatePassword(inputPassword);
    const confirmPasswordOk = validateConfirmPassword(inputPassword, inputConfirmPassword);
    
    if (firstNameOk && lastNameOk && emailOk && passwordOk && confirmPasswordOk && roleOk) {
        if (inputPassword.value === inputConfirmPassword.value) {
            btnValidation.disabled = false;
        } else {
            btnValidation.disabled = true;
        }
    }
}

function validateConfirmPassword(inputPassword, inputConfirmPassword) {
    if (inputPassword.value === inputConfirmPassword.value) {
        inputConfirmPassword.classList.add('is-valid');
        inputConfirmPassword.classList.remove('is-invalid');
        return true;
    } else {
        inputConfirmPassword.classList.add('is-invalid');
        inputConfirmPassword.classList.remove('is-valid');
        return false;
    }
}


function validatePassword(input){
    //Définir mon regex
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
    const passwordUser = input.value;
    if(passwordUser.match(passwordRegex)){
        input.classList.add("is-valid");
        input.classList.remove("is-invalid"); 
        return true;
    }
    else{
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        return false;
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

