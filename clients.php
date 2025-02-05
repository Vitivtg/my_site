<?php
require_once "config.php";

$stmt=$conn->prepare("SELECT * FROM users;");
$stmt->execute();
$result=$stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <style>
        <?php
            include"clients.css"
        ?>
    </style>
</head>
<body>
    <h1>Clients</h1>
    <div class="clients">
        <?php
            while($row=$result->fetch_assoc()){
                echo "<div class='client'>
                    <h3>$row[firstname]</h3>
                    <h3>$row[lastname]</h3>
                    <h3>$row[gender]</h3>
                    <h3>$row[email]</h3>
                    <h3>$row[phone]</h3>                    
                </div>";
            }
            $stmt->close();
        ?>
    </div>
</body>
</html>