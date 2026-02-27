<?php 
include_once "includes/header.php";
?>

<div class="container">
    <div id="register_form">
        <h2>Register</h2>
        <form action="register_process.php" method="post" onsubmit="return validate()">

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required />
                <span class="validation_error" id="first_name_error"></span>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required />
                <span class="validation_error" id="last_name_error"></span>
            </div>    

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />
                <span class="validation_error" id="email_error"></span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required />
                <span class="validation_error" id="password_error"></span>
            </div>

            <div class="form-group">
                <p>Do you accept terms and conditions ?</p>
                <div class="radio-group">
                    <input type="radio" name="term" value="1" id="term_yes" />
                    <label for="term_yes">Yes</label>
                    <input type="radio" name="term" value="0" id="term_no" />
                    <label for="term_no">No</label>
                </div>
                <span class="validation_error" id="term_error"></span>
            </div>

            <div class="form-group">
                <input type="submit" value="Register Now" id="Register_btn" />
            </div>

        </form>
        <?php
        if(isset($_SESSION['register_errors'])) {
            foreach($_SESSION['register_errors'] as $error){
                echo "<p style='color:red;'>$error</p>";
            }
            unset($_SESSION['register_errors']);
        }
        if(isset($_SESSION['success_message'])){
            echo "<p style='color:green;'>".$_SESSION['success_message']."</p>";
            unset($_SESSION['success_message']);
        }
        ?>
    </div>
</div>

<?php
include_once "includes/footer.php";  
?>
