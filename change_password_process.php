<?php
session_start();
require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: change_password.php");
    exit();
}

$current_password = $_POST['current_password'] ?? '';
$new_password     = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

$errors = [];

if (empty($current_password)) {
    $errors[] = "Current password is required.";
}
if (empty($new_password) || strlen($new_password) < 6) {
    $errors[] = "New password must be at least 6 characters.";
}
if ($new_password !== $confirm_password) {
    $errors[] = "New password and confirmation do not match.";
}

if (!empty($errors)) {
    $_SESSION['change_errors'] = $errors;
    header("Location: change_password.php");
    exit();
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit();
}

$user_id_safe = (int) $user_id;
$sql = "SELECT password FROM users WHERE id=$user_id_safe";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) !== 1) {
    $_SESSION['change_errors'] = ["User not found."];
    header("Location: change_password.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$hashed = $row['password'];

if (!password_verify($current_password, $hashed)) {
    $_SESSION['change_errors'] = ["Current password incorrect."];
    header("Location: change_password.php");
    exit();
}

$new_hash = password_hash($new_password, PASSWORD_DEFAULT);
$new_hash_safe = mysqli_real_escape_string($conn, $new_hash);
$update_sql = "UPDATE users SET password='$new_hash_safe' WHERE id=$user_id_safe";
if (mysqli_query($conn, $update_sql)) {
    $_SESSION['success_message'] = "Password changed successfully.";
    header("Location: change_password.php");
    exit();
} else {
    $_SESSION['change_errors'] = ["Failed to update password. Please try again."];
    header("Location: change_password.php");
    exit();
}
?>
