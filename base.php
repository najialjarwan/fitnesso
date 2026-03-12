<!DOCTYPE html>
<html lang="en">
<?php
$viewData = isset($viewData) ? $viewData : false;
if (!$viewData) {
    session_start();

    if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me_token'])) {

        include 'connection.php';

        $token = $_COOKIE['remember_me_token'];
        $query = "SELECT id FROM user_tokens WHERE token = ? LIMIT 1";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $_SESSION['user_id'] = $row['id'];
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Fitnesso'; ?></title>
    <link rel="stylesheet" href="CSS/Register.css">
    <link rel="stylesheet" href="CSS/Fitnesso.css">
    <link rel="stylesheet" href="CSS/About.css">
    <link rel="stylesheet" href="CSS/Nutritionists.css">
    <link rel="stylesheet" href="CSS/FitnessAdvisers.css">
    <link rel="stylesheet" href="CSS/PersonalTrainers.css">
    <link rel="stylesheet" href="CSS/Contact.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <?php
    if (isset($content)) {
        echo $content;
    }
    ?>

    <?php
    if (
        !(isset($registerPage) && $registerPage) &&
        !(isset($signInPage) && $signInPage) &&
        !(isset($viewData) && $viewData)
    ) {
        include 'Footer.php';
    }
    ?>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script src='JS/Fitnesso.js'></script>
    <script src='JS/Header.js'></script>
</body>

</html>