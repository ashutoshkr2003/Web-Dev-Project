<?php
include("includes/config.php");

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($name) || empty($email) || empty($password)) {
    echo "<script>alert('All fields are required');
    window.location='register.php';</script>";
    exit();
}

// Check if email already exists
$check_sql = "SELECT * FROM users WHERE email = '$email'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>alert('Email already exists');
    window.location='register.php';</script>";
    exit();
}

// Insert new user
$insert_sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $insert_sql)) {
    echo "<script>alert('Registration successful'); window.location='login.php';</script>";
} else {
    echo "<script>alert('Registration failed: " . mysqli_error($conn) . "'); window.location='register.php';</script>";
}
?> 