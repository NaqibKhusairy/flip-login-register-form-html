<?php
session_start();

if (isset($_SESSION['username'])&& isset($_SESSION['password'])&& isset($_SESSION['prosses'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $process = $_SESSION['prosses'];
} else {
    header("Location: ../index.php");
}
?><!DOCTYPE html>
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
                    echo "<h1>Username: $username</h1>";
                    echo "<h1>Password: $password</h1>";
                    echo "<h1>You are: $process</h1>";
                ?>
            </center>
        </div>
    </div>
</body>
</html>
