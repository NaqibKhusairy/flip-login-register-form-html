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
                <form action="session/login.php" method="post" name="loginForm">
                    <input type="text" placeholder="Username" name="username" required />
                    <input type="password" placeholder="Password" name="password" id="password" required />
                    <input type="checkbox" id="showPassword"> Show Password
                    <input type="submit" value="Login">
                </form>
                <a class="flipbutton" id="loginButton" href="#">Create my account →</a>
            </div>

            <div class="back">
                <h1 class="title">Register</h1>
                <form action="session/register.php" method="post" name="registerForm">
                    <input type="text" placeholder="Name" name="name" required />
                    <input type="text" placeholder="Username" name="username" required />
                    <input type="text" placeholder="Phone Number" name="phone" required />
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="password" placeholder="Password" name="password" id="password" required />
                    <input type="checkbox" id="showPassword"> Show Password
                    <input type="submit" value="Register">
                </form>
                <a class="flipbutton" id="registerButton" href="#">Login to my account →</a>
            </div>
        </div>
    </div>
    <script src="javascript.js"></script>
</body>
</html>
