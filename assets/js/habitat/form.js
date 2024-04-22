
const inputName = document.getElementById('name');
const inputDescription = document.getElementById('description');
const inputSubmit = document.getElementById('saveHabitat');

inputName.addEventListener('keyup', validateForm);
inputDescription.addEventListener('keyup', validateForm);


function validateForm() {
    const nameOK = validateRequired(inputName);
    const descriptionOk = validateRequired(inputDescription);

    if (nameOK && descriptionOk) {
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