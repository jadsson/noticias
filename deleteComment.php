<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    require_once 'Rules/Comments/CreateComment.php';
    require_once 'Rules/Comments/RuleComment.php';
    require_once 'Rules/Users/RuleUser.php';
    $c = new RuleComment;
    $u = new RuleUser;

    
    $idUser = $_GET['id'];
    $idComment = $_GET['c'];
    $idNews = $_GET['n'];

    $commentGuy = $u->ReadOneUser($idUser);
    
    if(isset($_SESSION['id_master']) || (isset($_SESSION['id_adm']) && $commentGuy['type_user'] != 'master')) {
        $c->DeleteComment($idComment);
        header("location: newsOpen.php?id=$idNews");
        exit;
    }
    elseif(isset($_SESSION['id']) && ($_SESSION['id'] == $idUser)) {
        $c->DeleteComment($idComment);
        header("location: newsOpen.php?id=$idNews");
        exit;
    }

    header('location: index.php');
