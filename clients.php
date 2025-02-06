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
    <header>    
        <nav class="head">
        <li><a href="index.php">Главная</a></li>
        <li><a href="">Обо мне</a></li>
        <li><a href="">Вебинары</a></li>
        <li><a href="">Тренинги</a></li>
        <li><a href="">Консультации</a></li>
        <li><a href="login.php">Войти</a></li>
        </nav>         
    </header>

    <h1>Список клиентов</h1>
    <div class="clients">
        <table cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Пол</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Подробности</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['firstname']}</td>
                            <td>{$row['lastname']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td><a href='client.php?id=$row[id]'>подробнее</a></td>
                        </tr>";
                    }
                    $stmt->close();
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Сайт лучшего психолога мира... Да чего там мира-ПМР!!!</p>
    </footer>
</body>
</html>