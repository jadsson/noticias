<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    require_once 'Rules/Users/RuleUser.php';
    require_once 'Rules/Users/CreateUser.php';

    $u = new RuleUser;
    $user = new CreateUser;

    if(isset($_POST['submit'])) {
        $email = addslashes(htmlentities($_POST['email']));
        $pass = addslashes(htmlentities($_POST['password']));
        if(!empty($email) && !empty($pass)) {
            $user->setEmail($email);
            $user->setPassword($pass);
            $u->Login($user);
        } else {
            echo '<script>alert("PREENCHA TODOS OS CAMPOS!");</script>';
        }
    }