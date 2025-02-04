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
</head>
<body>
    <h1>Clients</h1>
    <div class="clients">
        <?php
            while($row=$result->fetch_assoc()){
                
            }
        ?>
    </div>
</body>
</html>