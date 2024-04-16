//verifier champs requis

const inputUsername = document.getElementById('user_name');
const inputContent = document.getElementById('content');

inputUsername.addEventListener('keyup', validateForm);
inputContent.addEventListener('keyup', validateForm);


function validateForm() {
    validateRequired(inputUsername);
    validateRequired(inputContent);
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
 