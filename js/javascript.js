var loginButton = document.getElementById("loginButton");
var registerButton = document.getElementById("registerButton");
var loginForm = document.forms["loginForm"];
var registerForm = document.forms["registerForm"];

loginButton.onclick = function () {
    document.querySelector("#flipper").classList.toggle("flip");
    resetForm(loginForm);
};

registerButton.onclick = function () {
    document.querySelector("#flipper").classList.toggle("flip");
    resetForm(registerForm);
};

// Show/hide password function
function togglePasswordVisibility() {
    var passwordFields = document.getElementsByName("password");
    for (var i = 0; i < passwordFields.length; i++) {
        if (passwordFields[i].type === "password") {
            passwordFields[i].type = "text";
        } else {
            passwordFields[i].type = "password";
        }
    }
}

var passwordInputs = document.getElementsByName("password");
if (passwordInputs.length > 0) {
    var showPasswordCheckboxes = document.querySelectorAll('#showPassword');
    showPasswordCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", togglePasswordVisibility);
    });
}

// Function to reset form fields
function resetForm(form) {
    form.reset();
    var passwordFields = document.getElementsByName("password");
    for (var i = 0; i < passwordFields.length; i++) {
        passwordFields[i].type = "password"; // Change input type to password
    }
}
