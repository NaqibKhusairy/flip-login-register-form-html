<?php
    session_start();
    session_destroy();
    header("Location: ../index.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>FKPark - Logout</title>
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="icon" href="src/logo.png" type="image/png">
</head>
<body>
</body>
</html>
