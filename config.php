<?php
session_start();  

    try {
        $conn=new mysqli("localhost", "root", "", "site_db");
        if($conn->connect_error){
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
    }
    catch(Exception $e)
    {
        $_SESSION["error_message"]="Connection not established";
        header("Location:register.php");
        die();
    }  
