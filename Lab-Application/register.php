<?php

$full_name = $_POST['full_name'] ?? '';
$email = $_POST['email'] ?? '';
$gender = $_POST['gender'] ?? '';

$full_name = trim($full_name);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);


$errors = array();

if (empty($full_name)) {
    $errors[] = "Full name is required.";
}

if (empty($email)) {
    $errors[] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

if (empty($gender)) {
    $errors[] = "Gender is required.";
}


if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_registration";
// I CREATE TABLE IN DATABASE NAMED (student_registration) 
// TABLE SQL CODE:
// CREATE TABLE(
//    id INT AUTO_INCREMENT PRIMARY KEY,
//    full_name VARCHAR(255),
//    email VARCHAR(255),
//    gender ENUM('Male', 'Female')
// );


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";

if ($conn->query($sql) === TRUE) {
    echo "Student registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
