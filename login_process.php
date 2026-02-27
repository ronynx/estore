<?php
session_start();
require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get and sanitize inputs
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        header("Location: login.php");
        exit();
    }

    // Escape input
    $email_safe = mysqli_real_escape_string($conn, $email);

    // Check if user exists
    $sql = "SELECT id, first_name, last_name, email, password FROM users WHERE email='$email_safe'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name']  = $user['last_name'];
            $_SESSION['email']      = $user['email'];

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['login_errors'] = ["Incorrect password."];
            header("Location: login.php");
            exit();
        }

    } else {
        $_SESSION['login_errors'] = ["Email not registered."];
        header("Location: login.php");
        exit();
    }

} else {
    header("Location: login.php");
    exit();
}
?>
