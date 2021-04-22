<?php

    require('connect.php');
    
   
    // echo $_POST['password'];
    

    if($_POST && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_repeat']) ){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password_repeat = filter_input(INPUT_POST, 'password_repeat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    }else{
        header("Location: error.php");
   		exit;
    }

    
    if($password == $password_repeat){
        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $statement = $db ->prepare($query);

        //Bind values to the parameters
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);

        $statement->execute();

        header("Location: register_success.php");
   		exit;
    }else{
        header("Location: error.php");
   		exit;
    }
        






        // $username = $_POST['username'];
        // $email = $_POST['email'];
        // $password_1 = $_POST['password_1'];
        // $password_2 = $_POST['password_2'];
        // //echo $username;
        // $user_check= "SELECT * FROM users WHERE username = {$username} LIMIT 1";
        // //$user_check= "SELECT * FROM users WHERE id = 10 LIMIT 1";
        // $statement = $db -> prepare($user_check);
        // $statement -> execute();
        // $row = $statement->fetch();
        // //echo "user:". $username;
        // //echo " row:". $row['username'];
      
        // if (is_null($row['username'])){ 
        //   if ($password_1 == $password_2){
        //     $password = $password_1;
      
        //     $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
        //     $statement = $db ->prepare($query);
      
        //     $statement->bindValue(':username', $username);
        //     $statement->bindValue(':email', $email);
        //     $statement->bindValue(':password', $password);
      
        //     $statement->execute();
        //   }
          
        // }else{
        //   echo "Use different Username";
        // }




?>