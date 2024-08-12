<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ucp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$ucp = $_POST['ucp'];
$verify_code = $_POST['verifycode'];

// Check UCP in database
$ucp_query = "SELECT * FROM playerucp WHERE ucp = '$ucp'";
$ucp_result = $conn->query($ucp_query);

if ($ucp_result->num_rows > 0) {
    // Check Verification Code in database
    $code_query = "SELECT * FROM playerucp WHERE verifycode = '$verify_code'";
    $code_result = $conn->query($code_query);

    if ($code_result->num_rows > 0) {
        echo "Registration successful!";
        // Further processing can be added here like saving session or redirecting user
    } else {
        echo "Verification code not found!";
    }
} else {
    echo "UCP not found!";
}

$conn->close();
?>