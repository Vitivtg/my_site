<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Доступ запрещен. Пожалуйста, <a href='login.php'>войдите</a>.");
}

echo "Добро пожаловать! Ваш email: {$_SESSION['email']}.";
?>
<a href="logout.php">Выйти</a>
