<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    include('../conc/conc.php');
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM acc WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $stmt = $conn->prepare("SELECT * FROM acc WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
                session_start();
                $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                $error_message = "Logged In Successfully";
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                if ($row['username'] == "admin") {
                    $redirect_url = "../dashboard/admin.php";
                } else {
                    $redirect_url = "../dashboard/users.php";
                }
        } else {
            $error_message = "Invalid password. Please try again.";
            $redirect_url = "../index.php";
        }
    } else {
        $error_message = "Invalid username. Please register first.";
        $redirect_url = "../index.php";
    }
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
            <?php if($error_message == "Logged In Successfully") { ?>
                window.location.href = "<?php echo $redirect_url; ?>";  // Redirect to the user's dashboard
            <?php } else { ?>
                window.location.href = "<?php echo $redirect_url; ?>";  // Redirect to the login page
            <?php } ?>
        <?php endif; ?>
    </script>
</head>
<body>
</body>
</html>
