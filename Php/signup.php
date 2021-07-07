<?php

    require_once 'Rules/Users/RuleUser.php';
    require_once 'Rules/Users/CreateUser.php';

    $u = new RuleUser;
    $user = new CreateUser;

    if(isset($_POST['submit'])) {
        $name = addslashes(htmlentities($_POST['username']));
        $email = addslashes(htmlentities($_POST['email']));
        $pass = addslashes(htmlentities($_POST['password']));
        $conf = addslashes(htmlentities($_POST['confpass']));
        if(!empty($name) && !empty($email) && !empty($pass) && !empty($conf)) {
            if($pass === $conf) {
                $user->setUserName($name);
                $user->setEmail($email);
                $user->setPassword($conf);
                if($u->RegisterUser($user)) {
                    echo '<script>alert("Cadastro Realizado com Sucesso!");</script>';
                }
            } else {
                echo '<script>alert("Senhas divergentes!");</script>';
            }
        } else {
            echo '<script>alert("Preencha todos os campos!");</script>';
        }
    }
