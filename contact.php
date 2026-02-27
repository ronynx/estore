<?php
include("includes/header.php");
?>

<div id="content">
    <div id="contact_form">
        <h1>Contact Us</h1>
        <p>If you have any questions, suggestions, or concerns, please fill out the form below and we will get back to you as soon as possible.</p>

        <form id="contactUs" method="post" action="send_contact.php" onsubmit="return validateContactForm()">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>
                <span class="validation_error" id="name_error"></span>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>
                <span class="validation_error" id="email_error"></span>
            </div>

            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <span class="validation_error" id="message_error"></span>
            </div>

            <input type="submit" value="Send Message">
        </form>
    </div>
</div>

<?php
include("includes/footer.php");  
?>
