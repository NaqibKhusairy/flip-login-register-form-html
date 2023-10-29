var loginButton = document.getElementById("loginButton");
var registerButton = document.getElementById("registerButton");

loginButton.onclick = function () {
    document.querySelector("#flipper").classList.toggle("flip");
    // Reset the login form
    document.querySelector("#flipper .front form[name='loginForm']").reset();
};

registerButton.onclick = function () {
    document.querySelector("#flipper").classList.toggle("flip");
    // Reset the register form
    document.querySelector("#flipper .back form[name='registerForm']").reset();
};
