<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    include('../conc/conc.php');
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM acc WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $error_message = "Username already exists. Please choose a different username.";
        $redirect_url = "../index.php";
    } else{
        $stmt = $conn->prepare("SELECT * FROM acc WHERE name=?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $error_message = "Your name is already associated with an account.";
            $redirect_url = "../index.php";
        } else{
            $stmt = $conn->prepare("SELECT * FROM acc WHERE phone=?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $error_message = "Phone number already exists. Please choose a different phone number.";
                $redirect_url = "../index.php";
            } else{
                $stmt = $conn->prepare("SELECT * FROM acc WHERE email=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result && $result->num_rows === 1) {
                    $error_message = "Email address already exists. Please choose a different email.";
                    $redirect_url = "../index.php";
                } else{
                    $insertSQL = "INSERT INTO acc (username, name, email, phone, password)
                                VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($insertSQL);
                    $stmt->bind_param("sssss", $username, $name, $email, $phone, $password);
                    if ($stmt->execute() === false) {
                        $error_message = "Registration failed. Please try again later.";
                    } else{
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $error_message = "Registration successful.";
                        $redirect_url = "../dashboard/users.php";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script>
    <?php if (!empty($error_message)) : ?>
        alert("<?php echo $error_message; ?>");
        window.location.href = "<?php echo $redirect_url; ?>";
    <?php endif; ?>
    </script>
</head>
<body>
</body>
</html>