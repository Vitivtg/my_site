<?php
require_once "config.php";

$stmt = $conn->prepare("SELECT * FROM users;");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <style>
        <?php include "clients.css"; ?>
    </style>
</head>

<body>

    <?php require_once "header.php"; ?>

    <h1>Список клиентов</h1>
    <div class="clients">
        <table cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>#</th> <!-- Номер строки -->
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Пол</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Информация</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1; // Счетчик строк
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$count}</td>  <!-- Выводим номер строки -->
                            <td>{$row['firstname']}</td>
                            <td>{$row['lastname']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>                            
                            <td><a href='client.php?id={$row['id']}'>подробнее</a></td>
                        </tr>";
                    $count++; // Увеличиваем счетчик
                }
                $stmt->close();
                ?>
            </tbody>
        </table>
    </div>

    <?php require_once "footer.php"; ?>
</body>

</html>
