
const inputName = document.getElementById('name');
const inputDescription = document.getElementById('description');
const inputImage = document.getElementById('image');
const inputSubmit = document.getElementById('saveHabitat');

inputName.addEventListener('keyup', validateForm);
inputDescription.addEventListener('keyup', validateForm);
inputImage.addEventListener('change', validateForm);
inputSubmit.addEventListener('click', validateForm);


function validateForm() {
    const nameOK = validateRequired(inputName);
    const descriptionOk = validateRequired(inputDescription);
    const imageOk = validateRequired(inputImage);
    const imageValid = validateImage(inputImage);

    if (nameOK && descriptionOk && imageOk && imageValid) {
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