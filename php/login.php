<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userName = $_POST['userName']; // Assuming your email input is for the username
    $password = $_POST['password'];

    // Validate form data (add your own validation logic)

    // Database connection
    $mysqli = new mysqli("localhost", "root", "", "profile");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Fetch user data from the database based on the username
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE userName = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
    $mysqli->close();
} 
?>
