<?php

$title = 'Fitnesso - Sign Up';
$registerPage = true;

$content = '
<div class="gettingStarted">
    <h1>Getting Started</h1>
</div>
<h1 id="formInfo">Please fill in the information below:</h1>

<div id="formContainer">
    <form id="welcomeForm" action="userData1.php" method="post">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br>

        <label for="height">Height (cm):</label>
        <input type="number" id="height" name="height" required><br>

        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>

        <label for="workoutType">Type of Workout:</label>
        <select id="workoutType" name="workout_type" required>
            <option value="gym workout">Gym Workout</option>
            <option value="running">Running</option>
            <option value="jumping rope">Jumping Rope</option>
            <option value="calisthenics">Calisthenics</option>
            <option value="cycling">Cycling</option>
        </select><br>

        <label for="workoutIntensity">Workout Intensity:</label>
        <select id="workoutIntensity" name="workout_intensity" required>
            <option value="1">1 day/week</option>
            <option value="2">2 days/week</option>
            <option value="3">3 days/week</option>
            <option value="4">4 days/week</option>
            <option value="5">5 days/week</option>
            <option value="6">6 days/week</option>
            <option value="7">7 days/week</option>
        </select><br>

        <div class="goalRadioDiv">
            <label>Choose your goal:</label><br>
            <input type="radio" id="loseWeight" name="goal" value="loseWeight" required>
            <label for="loseWeight">Lose Weight</label><br>
            <input type="radio" id="gainWeight" name="goal" value="gainWeight" required>
            <label for="gainWeight">Gain Weight</label><br>
        </div><br>

        <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("welcomeForm").addEventListener("submit", function (e) {
            var passwordError = document.getElementById("passwordError");
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            // Reset the error message
            passwordError.style.display = "none";

            if (password !== confirmPassword) {
                passwordError.textContent = "Passwords do not match!";
                passwordError.style.display = "block";
                e.preventDefault();
            } else if (password.length < 8) {
                passwordError.textContent = "Password should be at least 8 characters!";
                passwordError.style.display = "block";
                e.preventDefault();
            }
        });
    });
        </script>

        <span id="passwordError" style="color: red; display: none;">Passwords do not match!</span><br>
        <button type="submit">Sign up</button><br>
        </form>
        
        <p id="formInfo">Already have an account?<a href="signin.php"> Sign In</a></p>
        </div>
        
        <footer class="footer register-footer"> 
            <p>Contact us if you have any questions or need help</p>
            <a href="Contact.php" id="contactus">Contact Us</a>
        </footer>
';

include 'base.php';
