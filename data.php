<?php
    session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $firstname=htmlspecialchars(trim($_POST["firstname"]));
    $lastname=htmlspecialchars(trim($_POST["lastname"]));
    $email=htmlspecialchars(filter_var(trim($_POST["email"])));
    $phone=htmlspecialchars(trim($_POST["phone"]));
    $password=trim($_POST["password"]);
    $confirmPassword=trim($_POST["confirmPassword"]);

    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $firstname))
    {
        $_SESSION["error_name"]="Имя должно содержать только буквы.";
        header("Location:register.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $lastname))
    {
        $_SESSION["error_lastname"]="Фамилия должна содержать только буквы.";
        header("Location:register.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Z0-9]+[a-zA-Z0-9._-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))
    {
        $_SESSION["error_email"]="Неверный формат Email";
        header("Location:register.php");
        exit();
    }

    if (!preg_match("/^\+\d{10,14}$/", $phone))
    {
        $_SESSION["error_phone"]="Телефон должен содержать + и не менее 10 цифр";
        header("Location:register.php");
        exit();
    }

    if (!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $password))
    {
        $_SESSION["error_password"]="Пароль должен состоять минимум из восьми символов и должен содержать минимум одну заглавную букву и одну цифру";
        header("Location:register.php");
        exit();
    }

    if($confirmPassword!=$password)
    {
        $_SESSION["error_confirmPassword"]="Пароли не совпадают";
        header("Location:register.php");
        exit();
    }

    $_SESSION["success_message"]="Регистрация прошла успешно.";
    $_SESSION["success_message1"]="Теперь Вы можете войти";
    header("Location: login.php");
    exit();
}




?>


