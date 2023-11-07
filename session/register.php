<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    include('../conc/conc.php');
    
    $checkUsernameQuery = "SELECT * FROM acc WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $checkUsernameQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "Username already exists. Please choose a different username.";
        } else {
            $checkPhoneQuery = "SELECT * FROM acc WHERE phone = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $checkPhoneQuery)) {
                mysqli_stmt_bind_param($stmt, "s", $phone);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $error_message = "Phone number already exists. Please choose a different phone number.";
                } else {
                    $checkEmailQuery = "SELECT * FROM acc WHERE email = ?";
                    $stmt = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($stmt, $checkEmailQuery)) {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($result) > 0) {
                            $error_message = "Email address already exists. Please choose a different email.";
                        } else {
                            $checkNameQuery = "SELECT * FROM acc WHERE name = ?";
                            $stmt = mysqli_stmt_init($conn);

                            if (mysqli_stmt_prepare($stmt, $checkNameQuery)) {
                                mysqli_stmt_bind_param($stmt, "s", $name);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($result) > 0) {
                                    $error_message = "Your name is already associated with an account.";
                                } else {
                                    $insertQuery = "INSERT INTO acc (name, username, phone, email, password) VALUES (?, ?, ?, ?, ?)";
                                    $stmt = mysqli_stmt_init($conn);

                                    if (mysqli_stmt_prepare($stmt, $insertQuery)) {
                                        mysqli_stmt_bind_param($stmt, "sssss", $name, $username, $phone, $email, $password);
                                        if (mysqli_stmt_execute($stmt)) {
                                            session_start();
                                            $_SESSION['username'] = $username;
                                            $_SESSION['password'] = $password;
                                            $_SESSION['process'] = "Register";
                                            $error_message = "Registration successful.";
                                        } else {
                                            $error_message = "Registration failed. Please try again later.";
                                        }
                                    } else {
                                        $error_message = "Error preparing the insert statement.";
                                    }
                                }
                            } else {
                                $error_message = "Error preparing the name check statement.";
                            }
                        }
                    } else {
                        $error_message = "Error preparing the email check statement.";
                    }
                }
            } else {
                $error_message = "Error preparing the phone check statement.";
            }
        }
    } else {
        $error_message = "Error preparing the username check statement.";
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script>
    <?php if (!empty($error_message)) : ?>
        alert("<?php echo $error_message; ?>");
        <?php if ($error_message == "Registration successful.") : ?>
            window.location.href = "../dashboard/index.php";
        <?php else : ?>
            window.location.href = "../index.php";
        <?php endif; ?>
    <?php endif; ?>
    </script>
</head>
<body>
</body>
</html>