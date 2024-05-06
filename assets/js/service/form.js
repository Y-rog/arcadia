
const inputTitle = document.getElementById('title');
const inputDescription = document.getElementById('description');
const inputSubmit = document.getElementById('saveService');

inputTitle.addEventListener('keyup', validateForm);
inputDescription.addEventListener('keyup', validateForm);
inputSubmit.addEventListener('click', validateForm);


function validateForm() {
    const titleOK = validateRequired(inputTitle);
    const descriptionOk = validateRequired(inputDescription);
    if (titleOK && descriptionOk) {
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

