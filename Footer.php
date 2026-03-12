<?php 
if(isset($_SESSION['user_id'])){
    echo '<footer class="footer register-footer"> 
    <p>Contact us if you have any questions or need help</p>
    <a href="Contact.php" id="contactus">Contact Us</a>';
}
else{
    echo'
    <footer class="footer">
        <h1>Do not waste time and start now!</h1>
        <p>Starting and registering on our website does not take time. Join us now and begin your journey to better health and fitness!</p>
        <a href="Register.php" id="start-link">Get Started</a>
        <p>Contact us if you have any questions or need help</p>
        <a href="Contact.php" id="contactus">Contact Us</a>
    </footer>';
}
