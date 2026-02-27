<?php
include_once "includes/header.php";  
?>

<div class="container">
    <div id="login_form">
        <h2>Login</h2>
        <form action="login_process.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>

            <div class="form-group">
                <input type="submit" id="login_btn" value="Login" />
            </div>
        </form>
        <?php
        if (isset($_SESSION['login_errors'])) {
            foreach ($_SESSION['login_errors'] as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            unset($_SESSION['login_errors']);
        }
        
        if (isset($_SESSION['success_message'])) {
            echo "<p style='color:green;'>".$_SESSION['success_message']."</p>";
            unset($_SESSION['success_message']);
        }
        ?>
    </div>
</div>

<?php
include_once "includes/footer.php";  
?>
