<?php
//include ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form data (add your own validation logic)

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        exit;
    }

    // Hash the password (use a strong hashing algorithm in production)
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $mysqli = new mysqli("localhost", "root", "", "profile");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert user data into the database using prepared statement
    $sql = "INSERT INTO users (firstName, lastName, userName, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    //echo "SQL Query: " . $sql;

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $mysqli->error]);
        exit;
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssss", $firstName, $lastName, $userName, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registration successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $mysqli->close();
}
?>