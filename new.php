<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>JJKLJLKJNL:K</h3>
<?php
            if(isset($_SESSION["success_message"]))
            {
                echo "<div class='error'>
                <p>$_SESSION[success_message]</p>
                </div>";
                unset($_SESSION["success_message"]);
            }
?>
</body>
</html>