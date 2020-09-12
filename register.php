<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "sidebar.php";


require 'config.php';

if (isset($_POST['register'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Hash password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO customer (firstname, lastname, email, password) VALUES (:f, :l, :e, :p)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':f', $firstname,PDO::PARAM_STR); //Auto sanitized
    $stmt->bindValue(':l', $lastname,PDO::PARAM_STR);
    $stmt->bindValue(':e', $email, PDO::PARAM_STR);
    $stmt->bindValue(':p', $passwordHash, PDO::PARAM_STR);

    $result = $stmt->execute();

    if ($result) {
        
        $_SESSION['message'] = 'Registered, please login';

        header('Location: login.php');
    }
}


?>

<div class="container">
    <form method="post" action="register.php">
        <div id="login">
            <h1>Login</h1>
            <div>
                <p>
                    <label for="firstname">First name:</label><br />
                    <input type="text" id="firstname" name="firstname" maxlength="50" minlength="1" required/>
                </p>
            </div>
            <div>
                <p>
                    <label for="lastname">Lastname:</label><br />
                    <input type="text" id="lastname" name="lastname" maxlength="50" minlength="1" required/>
                </p>
            </div>
            <div>
                <p>
                    <label for="email">Email:</label><br />
                    <!-- Pattern un-needed as input type email -->
                    <input type="email" id="email" name="email" maxlength="100" minlength="1" required/> 
                </p>
            </div>
            <div>
                <p>
                    <label for="Password">Password:</label><br />
                    <input type="password" id="password" name="password" maxlength="20" minlength="1" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
" required/><br />
                    <a href="#"> Forgot password?</a>
                </p>
            </div>
            <div>
                <button type="submit" value="Register" name="register" id="btn_register"> Log In </button>
            </div>
        </div>
    </form>
</div>