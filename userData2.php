<?php
include 'connection.php';

$title = 'Fitnesso - Your Data';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $sql1 = "SELECT id, email, password FROM users WHERE email = '$email'";
    $queryResult1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($queryResult1);

    if ($row1) {

        if (password_verify($password, $row1["password"])) {
            $_SESSION['user_id'] = $row1['id'];

            $token = bin2hex(random_bytes(32));
            $user_id = $_SESSION['user_id'];

            $query = "INSERT INTO user_tokens (user_id, token, created_at) VALUES (?, ?, NOW())";
            $stmt = $con->prepare($query);
            $stmt->bind_param("is", $user_id, $token);
            $stmt->execute();

            setcookie('remember_me_token', $token, time() + (30 * 24 * 60 * 60), "/");

            echo '<script>location.href = "viewData.php";</script>';
        } else {
            echo '
            <script type="text/javascript">
            alert("Password Incorrect!");
            location.href = "signin.php";
            </script>';
        }
    } else {
        echo '<script type="text/javascript">
            alert("Email not found! Check your E-mail or sign up.");
            location.href = "signin.php";
        </script>';
    }
}
