<?php
include 'connection.php';

$title = 'Fitnesso - Your Data';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $workout_type = $_POST['workout_type'];
    $workout_intensity = $_POST['workout_intensity'];
    $goal = $_POST['goal'];

    $sql1 = "SELECT * FROM users WHERE email = '$email'";
    $queryResult1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($queryResult1);

    if ($row1) {
        echo '<script>
            alert("Email already exists! Sign in or try a different Email.");
            location.href = "Register.php";
        </script>';
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = "
            INSERT INTO users (email, password, full_name, gender, age, height, weight, workout_type, workout_intensity, goal)
            VALUES ('$email', '$hashed_password', '$full_name', '$gender', $age, $height, $weight, '$workout_type', '$workout_intensity', '$goal');
        ";
        $queryResult2 = mysqli_query($con, $sql2) or die("Unable to execute the query: " . mysqli_error($con));

        $user_id = mysqli_insert_id($con);
        $_SESSION['user_id'] = $user_id;


        $token = bin2hex(random_bytes(32));

        $query = "INSERT INTO user_tokens (user_id, token, created_at) VALUES (?, ?, NOW())";
        $stmt = $con->prepare($query);
        $stmt->bind_param("is", $user_id, $token);
        $stmt->execute();

        setcookie('remember_me_token', $token, time() + (30 * 24 * 60 * 60), "/");
        echo '<script>location.href = "viewData.php";</script>';
    }
}
