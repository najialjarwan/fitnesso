<header>
    <div>
        <div class="logo">
            <a href="index.php" id="fitnesso">Fitnesso</a>
        </div>
        <div id='menu'>
            <ul>
                <li><a href="About.php">About</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="PersonalTrainers.php">Personal Trainers</a></li>
                <li><a href="Nutritionists.php">Nutritionists</a></li>
                <li><a href="FitnessAdvisers.php">Fitness Advisers</a></li>
                <li><a href="viewData.php">View Data</a></li>
                <li><a class="phone-menu-register" href="Register.php">Register</a></li>
            </ul>
        </div>

        <div class="register-button">

            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<a href="logOut.php" id="start" onmousedown="changeSize1(this)" onmouseup="changeSize2(this)">
                    log Out</a>';
            } else {
                if (!(isset($registerPage) && $registerPage) && !(isset($signInPage) && $signInPage) && !(isset($userDataPage) && $userDataPage)) {
                    echo '<a href="Register.php" id="start" onmousedown="changeSize1(this)" onmouseup="changeSize2(this)">
                        Start Now</a>';
                } else if (isset($registerPage) && $registerPage) {
                    echo '<a href="signin.php" id="start" onmousedown="changeSize1(this)" onmouseup="changeSize2(this)">
                        Sign In</a>';
                } else if (isset($signInPage) && $signInPage) {
                    echo '<a href="Register.php" id="start" onmousedown="changeSize1(this)" onmouseup="changeSize2(this)">
                        Sign Up</a>';
                }
            }
            ?>

        </div>

        <div class='menu-icons' id="menu-icons">
            <img id="menu-icon-open" src="Images/menu-icon.png" alt="menu icon">
            <img id="menu-icon-close" src="Images/menu-icon-close.png" alt="menu icon close">
        </div>

    </div>
</header>