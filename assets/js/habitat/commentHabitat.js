//verifier champs requis
const inputContent = document.getElementById('content');
const inputSubmit = document.getElementById('saveCommentHabitat');

inputContent.addEventListener('keyup', validateForm);

function validateForm() {
    const contentOk = validateRequired(inputContent);

    if (contentOk) {
        inputSubmit.disabled = false;
    } else {
        inputSubmit.disabled = true;
    }
}

function validateRequired(input) {
    if (input.value.length > 0) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        return true;
    } else {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        return false;
    }
}