<?php
session_start();
require_once "includes/db.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize inputs
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $term       = $_POST['term'] ?? '';

    // Validation
    $errors = [];
    if (empty($first_name)) $errors[] = "First name is required.";
    if (empty($last_name))  $errors[] = "Last name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($password) || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($term != '1') $errors[] = "You must accept terms and conditions.";

    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        header("Location: register.php");
        exit();
    }

    // Escape strings to prevent SQL injection
    $first_name_safe = mysqli_real_escape_string($conn, $first_name);
    $last_name_safe  = mysqli_real_escape_string($conn, $last_name);
    $email_safe      = mysqli_real_escape_string($conn, $email);
    $password_hash   = password_hash($password, PASSWORD_DEFAULT);
    $term_value      = ($term == '1') ? 1 : 0;

    $check_sql = "SELECT id FROM users WHERE email='$email_safe'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['register_errors'] = ["Email already registered."];
        header("Location: register.php");
        exit();
    }

    $insert_sql = "INSERT INTO users (first_name, last_name, email, password, term) 
                   VALUES ('$first_name_safe', '$last_name_safe', '$email_safe', '$password_hash', '$term_value')";

    if (mysqli_query($conn, $insert_sql)) {
        $_SESSION['success_message'] = "Registration successful! Please login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['register_errors'] = ["Something went wrong. Please try again."];
        header("Location: register.php");
        exit();
    }

} else {
    header("Location: register.php");
    exit();
}
?>
