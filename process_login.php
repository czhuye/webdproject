<?php

    require('connect.php');
    session_start();

    if($_POST && !empty($_POST['username']) && !empty($_POST['password']) ){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }else{
        header("Location: error.php");
   		exit;
    }


    
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $db -> prepare($query);

    $stmt->bindValue('username',$username, PDO::PARAM_STR);
    $stmt->bindValue('password',$password, PDO::PARAM_STR);
    $stmt -> execute();

     
    $count = $stmt->rowCount();
    // echo $username;
    // echo $password.'<br>';
    // echo $count;

    if($count == 1){
        $_SESSION['username'] = $username;
        echo $_SESSION['username'];
        header("Location: login_success.php");
   		exit;
    }else{
        header("Location: error.php");
   		exit;
    }






?>