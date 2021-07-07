<?php 
    if(!isset($_SESSION['email'])) {
        header('location: ../index.php');
        exit;
    }
    require_once 'Rules/Images/RuleImage.php';
    require_once 'Rules/Users/RuleUser.php';
    require_once 'Rules/Comments/RuleComment.php';
    require_once 'Rules/Comments/CreateComment.php';
    require_once 'Rules/News/RuleNews.php';

    $c = new RuleComment;
    $comment = new CreateComment;


    if(isset($_POST['enviarComentario'])) {
        if(isset($_SESSION['id'])) { $idUser = $_SESSION['id']; }
        elseif(isset($_SESSION['id_adm'])){ $idUser = $_SESSION['id_adm']; }
        elseif(isset($_SESSION['id_master'])){ $idUser = $_SESSION['id_master']; }
        $content = addslashes(htmlentities($_POST['comment']));

        if(!empty($content)) {
            $comment->setIdNews($idNews);
            $comment->setIdUser($idUser);
            $comment->setText($content);
            
            $c->RegisterComment($comment);
        }
    }