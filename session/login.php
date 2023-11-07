<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    include('../conc/conc.php');
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM acc WHERE username=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die('Query execution failed: ' . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Password is correct
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['prosses'] = "Login";
                $error_message = "Logged In Successfully";
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: ../dashboard/index.php");
                exit;
            } else {
                $error_message = "Invalid password. Please try again.";
            }
        } else {
            // User not found
            $error_message = "Invalid username. Please register first.";
        }
    } else {
        die('Statement preparation failed: ' . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script>
    <?php if (!empty($error_message)) : ?>
        alert("<?php echo $error_message; ?>");
        <?php if($error_message == "Logged In Successfully"){ ?>
            window.location.href = "../dashboard/index.php";
        <?php }else{
        ?>
            window.location.href = "../index.php";
        <?php }
        ?>
    <?php endif; ?>
    </script>
</head>
<body>
</body>
</html>
