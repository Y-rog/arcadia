//verifier champs requis
const inputContent = document.getElementById('content');
const inputPassingDate = document.getElementById('passing_date');
const inputSubmit = document.getElementById('saveCommentHabitat');

inputContent.addEventListener('keyup', validateForm);
inputPassingDate.addEventListener('change', validateForm);

function validateForm() {
    const contentOk = validateRequired(inputContent);
    const passingDateOk = validatePassingDate();

    if (contentOk && passingDateOk) {
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

function validatePassingDate() {
    if (inputPassingDate.value.length > 0) {
        inputPassingDate.classList.add('is-valid');
        inputPassingDate.classList.remove('is-invalid');
        return true;
    } else {
        inputPassingDate.classList.add('is-invalid');
        inputPassingDate.classList.remove('is-valid');
        return false;
    }
}