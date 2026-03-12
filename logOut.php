<?php
include 'connection.php';
session_start();
session_unset();
session_destroy();
if (isset($_COOKIE['remember_me_token'])) {
    $token = $_COOKIE['remember_me_token'];
    $query = "DELETE FROM user_tokens WHERE token = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();

    setcookie('remember_me_token', '', time() - 3600, "/");
}
header('Location: index.php');
exit();
?>