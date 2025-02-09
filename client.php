<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Безопасное преобразование параметра id в целое число


    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("d", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        die("Клиент не найден.");
    }
} else {
    die("Некорректный запрос.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
    <style>
        <?php
        include "client.css"
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

    <h1>Клиент</h1>
    <div class="clients">
        <table cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Пол</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Дата регистрации</th>
                    <th>Блокировка</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo "<tr>
                            <td>{$client['firstname']}</td>
                            <td>{$client['lastname']}</td>
                            <td>{$client['gender']}</td>
                            <td>{$client['email']}</td>
                            <td>{$client['phone']}</td>
                            <td>{$client['created_at']}</td>
                            <td>" . ($client['block'] ? 'Заблокирован' : 'Нет') . "</td>
                            <td>
                                <form action='update_status.php' method='POST'>
                                <input type='hidden' name='id' value='{$client['id']}'>
                                <input type='hidden' name='block' value='" . ($client['block'] ? '0' : '1') . "'>
                                <button type='submit'>" . ($client['block'] ? 'Разблокировать' : 'Заблокировать') . "</button>
                                </form>
                            </td>
                    </tr>";
                ?>
            </tbody>
        </table>
        <a class="a1" href="clients.php">назад к списку клиентов</a>
    </div>

    <footer>
        <p>Сайт лучшего психолога мира... Да чего там мира-ПМР!!!</p>
    </footer>
</body>

</html>