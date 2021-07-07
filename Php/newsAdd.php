<?php 
    if(!isset($_SESSION['id_master']) && !isset($_SESSION['id_adm'])) {
        header('location: index.php');
        exit;
    }
    date_default_timezone_set('America/Sao_Paulo');

    require_once 'Rules/News/CreateNews.php';
    require_once 'Rules/News/RuleNews.php';

    $n = new CreateNews;
    $upNews = new RuleNews;

    if(isset($_POST['submit'])) {
        $category = addslashes(htmlentities($_POST['category']));
        $title = addslashes(htmlentities($_POST['title']));
        $text = addslashes(htmlentities($_POST['text']));
        if(isset($_SESSION['id_adm'])){ $id = $_SESSION['id_adm']; }
        if(isset($_SESSION['id_master'])){ $id = $_SESSION['id_master']; }

        if(!empty($category) && !empty($title) && !empty($text)) {
            $n->setIdUser($id);
            $n->setCategory($category);
            $n->setTitle($title);
            $n->setText($text);
    
            if($upNews->RegisterNews($n)) {
                echo "<script>alert('NOTÍCIA REGISTRADA COM SUCESSO')</script>";

                $idLastNews = $upNews->ReadLastNews();
                $categoryImg = 'news';

                require_once 'imgUpload.php';

            } else {
                echo "<script>alert('ERRO AO REGISTRAR NOTÍCIA')</script>";
            }
        } else {
            echo "<script>alert('PREENCHA TODOS OS CAMPOS')</script>";
        }
    }elseif(isset($_POST['att-news'])) {
        $category = addslashes(htmlentities($_POST['category']));
        $title = addslashes(htmlentities($_POST['title']));
        $text = addslashes(htmlentities($_POST['text']));
        $idNews = $_POST['id_news'];
        if(isset($_SESSION['id_adm'])){ $id = $_SESSION['id_adm']; }
        if(isset($_SESSION['id_master'])){ $id = $_SESSION['id_master']; }

        if(!empty($category) && !empty($title) && !empty($text)) {
            $n->setId($idNews);
            $n->setIdUpd($id);
            $n->setCategory($category);
            $n->setTitle($title);
            $n->setText($text);
            $n->setUpd('');
            $upNews->UpdateNews($n);
        } else {
            echo "<script>alert('PREENCHA TODOS OS CAMPOS')</script>";
        }


    }
