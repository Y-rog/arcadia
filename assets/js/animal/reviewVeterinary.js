//verifier champs requis
const inputFood = document.getElementById('food');
const inputFoodQuantity = document.getElementById('food_quantity');
const inputHealthStatus = document.getElementById('health_status');
const inputPassingDate = document.getElementById('passing_date');
const inputSubmit = document.getElementById('addReviewVeterinary');

inputFood.addEventListener('keyup', validateForm);
inputFoodQuantity.addEventListener('keyup', validateForm);
inputHealthStatus.addEventListener('keyup', validateForm);
inputPassingDate.addEventListener('change', validateForm);

function validateForm() {
    const foodOk = validateRequired(inputFood);
    const foodQuantityOk = validateRequired(inputFoodQuantity);
    const healthStatusOk = validateRequired(inputHealthStatus);
    const passingDateOk = validatePassingDate();
    if (foodOk && foodQuantityOk && healthStatusOk && passingDateOk) {
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




