<?php

if(!empty($_POST['email']) && !empty($_POST['password'])){
    // VARIABLES
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $error = 1;

    
    //VERIF EMAIL/PW
    $adminCheck = $bdd->prepare('SELECT * FROM admins WHERE email = :email');
    $adminCheck->bindValue(':email', $email, PDO::PARAM_STR);
    $adminCheck->execute();
    $user = $adminCheck->fetch(PDO::FETCH_ASSOC);
    if(isset($user['email']) && password_verify($password, $user['password']) ){
        var_dump($user['password']. '---' . $password);
        $error = 0;
        $_SESSION['connect'] = 1;
        $_SESSION['user'] = $user['firstname'].' '.$user['lastname'];
        header('location:./administration.php');
    } else {
        header('location:./administration.php?error=1');
    }

} 