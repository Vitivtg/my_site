<?php
require_once "config.php";

session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){   
    $email=htmlspecialchars(filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL));    
    $password=trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $_SESSION["error_message"] = "Все поля обязательны для заполнения!";
        header("Location:login.php");
        exit();
    }  
    
    if (!preg_match("/^[a-zA-Z0-9]+[a-zA-Z0-9._-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)||(!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $password)))
    {
        $_SESSION["error_message"]="Неверное имя пользователя или пароль";
        header("Location:login.php");
        exit();
    }  
    
    $_SESSION["success_message"]="Все хорошо";
    header("Location:new.php");
    exit();    
}
else{
    header("Location:login.php");
}

function logUser($email, $password)
{
    
}
?>