<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        <?php
            include"login.css"
        ?>
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION["success_message"]) || isset($_SESSION["success_message1"])) {
        echo "<div class='success'>";
        if (isset($_SESSION["success_message"])) {
            echo "<p>" . htmlspecialchars($_SESSION["success_message"]) . "</p>";
            unset($_SESSION["success_message"]);
        }
        if (isset($_SESSION["success_message1"])) {
            echo "<p>" . htmlspecialchars($_SESSION["success_message1"]) . "</p>";
            unset($_SESSION["success_message1"]);
        }
        echo "</div>";
    }
    ?>

    <div class="form-container">
        <div class="form">
            <form action="">
                <h3>Вход</h3>        
                <input type="email" placeholder="Email" required>        
                <input type="password" placeholder="пароль" required>        
                <button type="submit">Вход</button>
                <div class="haveAcc">
                    <p>нет аккаунта?</p>
                    <a href="register.php">Регистрация</a>   
                </div>
            </form>
        </div>
    </div>
</body>

</html>