const inputSchedules = document.getElementById('schedules');
const inputSubmitSchedules = document.getElementById('editSchedules');

inputSchedules.addEventListener('keyup', validateForm);
inputSubmitSchedules.addEventListener('click', validateForm);

// On autorise l'envoi du formulaire si tous les champs obligatoires sont remplis
function validateForm() {
    const schedulesOk = validateRequired(inputSchedules);

    if (schedulesOk) {
        inputSubmitSchedules.disabled = false;
    }
    else {
        inputSubmitSchedules.disabled = true;
    }
}

// On vérifie que les champs obligatoires sont remplis
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

