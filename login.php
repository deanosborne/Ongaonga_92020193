<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';

include "checksession.php";
require 'config.php';

if (isset($_POST['login'])) {
    //using firstname because cbf making usernames up, we only really use admin anyway

    $firstname = $_POST['firstname'];
    $passwordAttempt = $_POST['password'];

    $sql = "SELECT customerID, firstname, password FROM customer WHERE firstname = :f";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':f', $firstname, PDO::PARAM_STR); //Auto sanitized
    $stmt->execute();

    $fname = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fname == false) {
        die('Invalid name or password!');
    } else {
        $validpass = password_verify($passwordAttempt, $fname['password']); //verify password is correct

        if ($validpass) {
            login($_SESSION['firstname'] = $fname['customerID'], $firstname);
            $_SESSION['logged_in'] = time();
            $_SESSION['logged_in'] = 1;

            $_SESSION['message'] = 'Logged in!';

            header('Location: profile.php');
        } else {
            die('Invalid name or password!');
        }
    }
}


?>

<div class="container">
    <form method="post" action="login.php">
        <div id="login">
            <h1>Login</h1>
            <div>
                <?php //grab message if used
                if (!empty($_SESSION['message'])) {
                    echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
                    unset($_SESSION['message']);
                }
                ?>
                <p>
                    <a href="register.php"> Need an account?</a>
                </p>
                <p>
                    <label for="firstname">First name:</label><br />
                    <input type="text" id="firstname" name="firstname" maxlength="20" minlength="1" required/>
                </p>
            </div>
            <div>
                <p>
                    <label for="Password">Password:</label><br />
                    <input type="password" id="password" name="password" maxlength="20" minlength="1" required/><br />
                    <a href="#"> Forgot password?</a>
                </p>
            </div>
            <div>
                <button type="submit" value="login" name="login" id="btn_login"> Log In </button>
            </div>
        </div>
    </form>
</div>