<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: signin.php');
    exit();
}

$title = 'Fitnesso - Your Data';
$viewData = true;

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = '$id'";
$queryResult = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($queryResult);

$full_name = $row['full_name'];
$age = $row['age'];
$height = $row['height'];
$weight = $row['weight'];
$gender = $row['gender'];
$workout_type = $row['workout_type'];
$workout_intensity = $row['workout_intensity'];
$goal = $row['goal'];

$content = '
        <div class="gettingStarted"><h1>Your Fitenss Data</h1></div>
        <div class="resultContainer">
            <h1>Your Data</h1>
            <table class="infoTable">
                <tr><th>Full Name:</th><td>' . $full_name . '</td></tr>
                <tr><th>Age:</th><td>' . $age . '</td></tr>
                <tr><th>Height(cm):</th><td>' . $height . '</td></tr>
                <tr><th>Weight(kg):</th><td>' . $weight . '</td></tr>
                <tr><th>Gender:</th><td>' . $gender . '</td></tr>
                <tr><th>Type of Workout:</th><td>' . $workout_type . '</td></tr>
                <tr><th>Workout Intensity:</th><td>' . $workout_intensity . '</td></tr>
               <tr><th>Goal:</th><td>' . $goal . '</td></tr>
            </table>
        </div>
        
        <footer class="footer register-footer"> 
            <p>Contact us if you have any questions or need help</p>
            <a href="Contact.php" id="contactus">Contact Us</a>
        </footer>';

include 'base.php';
