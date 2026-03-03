<?php
include_once "includes/header.php";
require_once "includes/auth.php";
?>

<div class="container">
    <div id="profile">
        <h2>Your Profile</h2>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($_SESSION['first_name']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($_SESSION['last_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <div class="profile-actions">
            <a class="dashboard-link" href="change_password.php">Change Password</a>
            <a class="dashboard-link logout" href="logout.php">Logout</a>
        </div>
    </div>
</div>

<?php
include_once "includes/footer.php";
?>
