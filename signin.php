<?php

$title = 'Fitnesso - Sign in';
$signInPage = true;
$content = '
<div class = "gettingStarted"><h1>Welcome back!</h1></div>

<h1 id="formInfo">To Access your account fill in your account information below:</h1>
    <div id="formContainer">
        <form id="welcomeForm" action="userData2.php" method= "post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <span id="emailError" style="color: red; display: none;">Invalid email address!</span><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <span id="passwordError" style="color: red; display: none;">Incorrect password!</span><br>
            <button type="submit">Sign in</button><br>
            <p>Already have an account? <a class="signUp" href="Register.php"> Sign Up</a></p>        
        </form>
    </div>

    <footer class="footer register-footer"> 
        <p>Contact us if you have any questions or need help</p>
        <a href="Contact.php" id="contactus">Contact Us</a>
    </footer>';

include 'base.php';

