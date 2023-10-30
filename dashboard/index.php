<!DOCTYPE html>
<html>
<head>
    <title>Form Data</title>
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="icon" href="icon.png" type="image/png">
</head>
<body>
    <div class="flip-container">
        <div class="flipper" id="flipper">
            <center>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["process"])) {
                            $username = $_POST["username"];
                            $password = $_POST["password"];
                            $process = $_POST["process"];
                                
                            echo "<h1>Username: $username</h1>";
                            echo "<h1>Password: $password</h1>";
                            echo "<h1>You are: $process</h1>";
                        } else {
                            echo "Incomplete form data";
                        }
                    } else {
                        echo "Form not submitted";
                    }
                ?>
            </center>
        </div>
    </div>
</body>
</html>
