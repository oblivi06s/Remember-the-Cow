<?php

    session_start();

    $username = "studentnumber";
    $password = "12345";

    if (empty($_POST['name']) || empty($_POST['password'])) {
        header("HTTP/1.1 400 Invalid Request");
        exit;
    }

    $providedUsername = $_POST['name'];
    $providedPassword = $_POST['password'];

    error_log("Provided Username: $providedUsername, Provided Password: $providedPassword, CorrectUsername: $username, CorrectPassword: $password");


    if($providedUsername == $username && $providedPassword == $password){
        header("Location: todolist.php");

        $_SESSION["name"] = $providedUsername;

    }else{
        //Go to index.php
        header("Location: index.php");

        $_SESSION["failed"] = true;
    }

?>