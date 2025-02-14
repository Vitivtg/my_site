<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Майя Иванова</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php
        require_once "header.php";
    ?>

    <div class="content">
        <div>
            <img class="headPhoto" src="./image/photo.jpg" alt="photo" >
        </div>
    </div>

    <?php
    require_once "footer.php";
    ?>
</body>

</html>