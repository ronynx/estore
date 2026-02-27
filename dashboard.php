<?php
include_once "includes/header.php";
require_once "includes/auth.php";
?>

<div class="container">
    <div id="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h1>
        <p>You have successfully logged in to your eStore dashboard.</p>

        <div class="dashboard-actions">
            <a href="index.php">Go to Homepage</a> |
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<?php
include_once "includes/footer.php";
?>
