<?php
    // Create a database connection
    $conn = mysqli_connect("localhost", "root", "");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create the database if it doesn't exist
    $createconnSQL = "CREATE DATABASE IF NOT EXISTS OPTPS";

    if ($conn->query($createconnSQL) === false) {
        die("Error creating database: " . $conn->error);
    }

    // Close the initial connection
    mysqli_close($conn);

    // Create a connection to the database
    $conn = new mysqli("localhost", "root", "", "OPTPS");

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the table "acc" if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS acc (
        username VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($createTableSQL) === false) {
        die("Error creating table: " . $conn->error);
    }

    //insert administrator account if not exists
    $username   = "admin";
    $name = "System Administrator";
    $email    = "admin@test.com";
    $phone  = "0123456789";
    $password   = "admin";

    
    // Check if the admin account already exists
    $checkAdminSQL = "SELECT * FROM acc WHERE username = ?";
    $stmt = $conn->prepare($checkAdminSQL);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert admin account
        $insertAdminSQL = "INSERT INTO acc (username, name, email, phone, password)
                       VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertAdminSQL);
        $stmt->bind_param("sssss", $username, $name, $email, $phone, $password);
        if ($stmt->execute() === false) {
            echo "Error inserting data: " . $stmt->error;
        }
    }
?>
