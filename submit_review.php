<?php
// Database Connection Settings
$host = "localhost";
$user = "root";
$password = "";
$database = "reviews_db";

// Establish Connection
$conn = new mysqli($host, $user, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email']; 
    $password = ($_POST['password']); // Hash password
    $country = $_POST['country'];
    $suggestion = $_POST['suggestion'];
    $rating = intval($_POST['rating']);

    // Insert Query
    $stmt = $conn->prepare("INSERT INTO customer_reviews (name, gender, email, password, country, suggestion, rating) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $name, $gender, $email, $password, $country, $suggestion, $rating);

    if ($stmt->execute()) {
        echo "Thank you, your review has been submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>