"use strict";
let disableButton = function(button, newText = 'Loading ...') {
    button.disabled = true;
    if (newText !== null) {
        button.innerText = newText;
    }
}
let enableButton = function(button, newText = null) {
    button.disabled = false;
    if (newText !== null) {
        button.innerText = newText;
    }
}

let renderGlobalErrors = function(newErrors) {
    const errorsBag = document.getElementById('errors-bag');
    const errorList = errorsBag.querySelectorAll('li');
    const existErrors = Array.from(errorList).map(li => li.textContent.trim());
    const allErrors = [...new Set([...existErrors, ...newErrors])];

    errorsBag.innerHTML = '';

    allErrors.forEach(error => {
        const li = document.createElement('li');
        li.textContent = error;
        errorsBag.appendChild(li);
    });
}
let renderFormErrors = function(errors) {
    if (isPlainObject(errors)) {
        Object.entries(errors).forEach(([key, error]) => {
            const element = document.getElementById(key + '-error');
            element.innerText = error[0];
        });
    }
}

function isPlainObject(value) {
    return typeof value === 'object' && value !== null && !Array.isArray(value);
}
