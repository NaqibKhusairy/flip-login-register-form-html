<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" href="icon.png" type="image/png">
</head>
<body>
    <div class="flip-container">
        <div class="flipper" id="flipper">
            <div class="front">
                <h1 class="title">Login</h1>
                <form action="dashboard/index.php" method="post" name="loginForm">
                    <input type="text" placeholder="Username" name="username" required />
                    <input type="password" placeholder="Password" name="password" id="password" required />
                    <input type="checkbox" id="showPassword"> Show Password
                    <input type="hidden" name="process" value="login" required />
                    <input type="submit" value="Login">
                </form>
                <a class="flipbutton" id="loginButton" href="#">Create my account →</a>
            </div>

            <div class="back">
                <h1 class="title">Register</h1>
                <form action="dashboard/index.php" method="post" name="registerForm">
                    <input type="text" placeholder="Name" name="name" required />
                    <input type="text" placeholder="Username" name="username" required />
                    <input type="text" placeholder="Phone Number" name="phone" required />
                    <input type="email" placeholder="Email" name "email" required />
                    <input type="password" placeholder="Password" name="password" id="password" required />
                    <input type="checkbox" id="showPassword"> Show Password
                    <input type="hidden" name="process" value="register" required />
                    <input type="submit" value="Register">
                </form>
                <a class="flipbutton" id="registerButton" href="#">Login to my account →</a>
            </div>
        </div>
    </div>
    <script src="javascript.js"></script>
    <script>
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
    </script>
</body>
</html>
