//verifier champs requis
const inputFood = document.getElementById('food');
const inputFoodQuantity = document.getElementById('food_quantity');

inputFood.addEventListener('keyup', validateForm);
inputFoodQuantity.addEventListener('keyup', validateForm);


function validateForm() {
    const foodOk = validateRequired(inputFood);
    const foodQuantityOk = validateRequired(inputFoodQuantity);

    if (healthStatusOk && foodOk && foodQuantityOk) {
        inputSubmit.disabled = false;
    }
    else {
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


