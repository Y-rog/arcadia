const inputFirstName = document.getElementById('first_name');
const inputRace = document.getElementById('race');
const inputImage = document.getElementById('image');
const inputHabitat = document.getElementById('habitat_id');
const inputSubmit = document.getElementById('saveAnimal');

inputFirstName.addEventListener('keyup', validateForm);
inputRace.addEventListener('keyup', validateForm);
inputHabitat.addEventListener('change', validateForm);
inputImage.addEventListener('change', validateForm);
inputSubmit.addEventListener('click', validateForm);

// On autorise l'envoi du formulaire si tous les champs obligatoires sont remplis
function validateForm() {
    const firstNameOK = validateRequired(inputFirstName);
    const raceOk = validateRequired(inputRace);
    const imageOk = validateRequired(inputImage);
    const imageValid = validateImage(inputImage);
    const inputHabitatOk = validateRequired(inputHabitat);

    if (firstNameOK && raceOk && imageOk && imageValid && inputHabitatOk) {
        inputSubmit.disabled = false;
    }
    else {
        inputSubmit.disabled = true;
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

// On informe l'utilisateur que l'image doit être au format jpg, jpeg, png ou gif
function validateImage(input) {
    const image = input.value;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (allowedExtensions.exec(image)) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        return true;
    } else {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        return false;
    }
}

