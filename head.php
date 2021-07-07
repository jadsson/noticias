<?php 
    if(!isset($_SESSION)) session_start(); 

    require_once 'Rules/News/RuleNews.php';
    require_once 'Rules/Users/RuleUser.php';
    $u = new RuleUser;
    isset($_SESSION['email']) ? $dataUser = $u->ReadOneUserFromEmail($_SESSION['email']) : false;

    $n = new RuleNews;
    $games = $n->ReadLastNewsFromCategory('games');
    $animes = $n->ReadLastNewsFromCategory('animes');
    $outros = $n->ReadLastNewsFromCategory('outros');

    isset($_SESSION['id'])          ? $id = $_SESSION['id'] : false;
    isset($_SESSION['id_adm'])      ? $id = $_SESSION['id_adm'] : false;
    isset($_SESSION['id_master'])   ? $id = $_SESSION['id_master'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+N</title>
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/header.css">
    <link rel="stylesheet" href="Css/news.css">
    <link rel="stylesheet" href="Css/formularios.css">
    <link rel="stylesheet" href="Css/modalDeleteNews.css">
    <link rel="stylesheet" href="Css/modalImgOpen.css">
    <link rel="stylesheet" href="Css/comments.css">
    <link rel="stylesheet" href="Css/footer.css">
    <link rel="stylesheet" href="Css/modalUploadImg.css">
    <link rel="stylesheet" href="Css/modalDeleteImg.css">
    <link rel="stylesheet" href="Css/userPerfil.css">
    <link rel="stylesheet" href="Css/userDelete.css">
</head>
<body>
    <header>
        <div class="header--width">
            <nav>
                <ul id="header--ul--principal">
                    <li>
                        <a href="index.php">INÍCIO</a>
                    </li>

            <?php if(isset($_SESSION['id_master']) || isset($_SESSION['id_adm'])) { ?>

                <li>
                    <a href="showUsers.php"
                        style="margin: 0px 0 0 15px;"
                    >
                    USUÁRIOS
                    </a>
                </li>

            <?php } ?>

                    <li class="header--li">IMAGENS
                        <ul class="header--ul--images ul">
                            <li><a href="images.php?ic=game">GAMES</a></li>
                            <li><a href="images.php?ic=anime">ANIMES</a></li>
                            <li><a href="images.php?ic=outros">OUTROS</a></li>
                        </ul>
                    </li>
                    <li class="header--li">NOTÍCIAS
                        <ul class="header--ul--news ul">
                            <li><a href="newsOpen.php?id=<?php echo $games[0]?>">GAMES</a></li>
                            <li><a href="newsOpen.php?id=<?php echo $animes[0]?>">ANIMES</a></li>
                            <li><a href="newsOpen.php?id=<?php echo $outros[0]?>">OUTROS</a></li>
            <?php if(isset($_SESSION['id_master']) || isset($_SESSION['id_adm'])) { ?>
                            <li><a href="newsAdd.php">+ADD</a></li>
            <?php } ?>
                        </ul>
                    </li>

            <?php if(isset($_SESSION['email'])) { ?>
                    
                    <li class="header--li"><?php echo strtoupper($dataUser['user_name']); ?>
                        <ul class="header--ul--user ul">
                            <li><a href="userPerfil.php?user=<?php echo $id?>">PERFIL</a></li>
                            <li><a href="userAccount.php?user=<?php echo $id?>">CONTA</a></li>
                            <li><a href="Php/exit.php">SAIR</a></li>

            <?php } else { ?>

                    <li class="header--li">ENTRAR
                        <ul class="header--ul--user ul">
                            <li><a href="signin.php">LOGIN</a></li>
                            <li><a href="signup.php">CADASTRAR</a></li>
                            
            <?php } ?>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </header>