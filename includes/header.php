<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eStore</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script src="validation.js" defer></script>
</head>
<body>

<div id="header">

    <div id="logo">
        <img src="assets/images/logo.png" alt="eStore Logo" title="eStore">
    </div>

    <div id="navbar">
        <a href="index.php">Home</a>
        <a href="product.php">Products</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
    </div>

    <div id="login_reg_panel">
        <?php if (!isset($_SESSION["user_id"])): ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php else: ?>
            <span id="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION["first_name"]); ?></span>
            <div class="user-actions">
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            </div>
        <?php endif; ?>
    </div>

</div>
