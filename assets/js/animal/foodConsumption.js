//verifier champs requis
const inputFoodGiven = document.getElementById('food_given');
const inputFoodQuantityGiven = document.getElementById('food_quantity');
const inputGiveAt = document.getElementById('give_at');
const inputSubmit = document.getElementById('saveFoodConsumption');

inputFoodGiven.addEventListener('keyup', validateForm);
inputFoodQuantityGiven.addEventListener('keyup', validateForm);

function validateForm() {
    const foodGivenOk = validateRequired(inputFoodGiven);
    const foodQuantityGivenOk = validateRequired(inputFoodQuantityGiven);
    const passingDateOk = valdateInputGiveAt();
    if (foodGivenOk && foodQuantityGivenOk && passingDateOk) {
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

function valdateInputGiveAt() {
    if (inputGiveAt.value.length > 0) {
        inputGiveAt.classList.add('is-valid');
        inputGiveAt.classList.remove('is-invalid');
        return true;
    } else {
        inputGiveAt.classList.add('is-invalid');
        inputGiveAt.classList.remove('is-valid');
        return false;
    }
}