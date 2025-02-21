
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <header>    
        <nav class="head">
        <li><a href="index.php">Главная</a></li>
        <li><a href="">Обо мне</a></li>
        <li><a href="">Вебинары</a></li>
        <li><a href="">Тренинги</a></li>
        <li><a href="consultation.php">Консультации</a></li>
        <li>
            <?php if (isset($_SESSION["user_id"])): ?>
                    <!-- Проверяем роль пользователя -->
                    <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1): ?>
                        <a href="clients.php">Мои клиенты</a>
                    <?php endif; ?>
            <?php endif; ?>
        </li>
        <li class="last_li">
            <?php if(isset($_SESSION["user_name"])): ?>
                <p>Привет, <a href=""><?=htmlspecialchars($_SESSION["user_name"]) ?></a></p>
                <a href="logout.php">Выйти</a>
                <?php else: ?>
                <a href="login.php">Войти</a>
                <?php endif; ?>
        </li>
        </nav>         
    </header>    
</body>
</html>