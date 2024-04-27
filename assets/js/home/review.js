//verifier champs requis
const inputUsername = document.getElementById('user_name');
const inputContent = document.getElementById('content');
const inputSubmit = document.getElementById('addReview');

inputUsername.addEventListener('keyup', validateForm);
inputContent.addEventListener('keyup', validateForm);

function validateForm() {
    const usernameOk = validateRequired(inputUsername);
    const contentOk = validateRequired(inputContent);

    if (usernameOk && contentOk) {
        inputSubmit.disabled = false;
    } else {
        inputSubmit.disabled = true;
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




