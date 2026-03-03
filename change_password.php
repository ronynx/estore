<?php
include_once "includes/header.php";
require_once "includes/auth.php";
?>

<div class="container">
    <div id="change_password_form">
        <h2>Change Password</h2>
        <form action="change_password_process.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required />
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required />
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required />
            </div>
            <div class="form-group">
                <input type="submit" id="change_btn" value="Change Password" />
            </div>
        </form>

        <?php
        if (isset($_SESSION['change_errors'])) {
            foreach ($_SESSION['change_errors'] as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            unset($_SESSION['change_errors']);
        }
        if (isset($_SESSION['success_message'])) {
            echo "<p style='color:green;'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']);
        }
        ?>
    </div>
</div>

<?php
include_once "includes/footer.php";
?>
