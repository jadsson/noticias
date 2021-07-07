<?php 
    if(!isset($_SESSION)) session_start();

    require 'head.php'; 
    
    require_once 'Rules/News/RuleNews.php';
    require_once 'Rules/Images/RuleImage.php';

    $n = new RuleNews;
    $i = new RuleImg;

    $category = $_GET['c'];

    if($category != 'games' && $category != 'animes' && $category != 'outros') {
        header('location: index.php');
        exit;
    }

    
    ?>

<?php 
    if(isset($_POST['submit'])) {
        $search = addslashes(htmlentities($_POST['submit']));
    } else {
        $search = '';
    }
    
    $news = $n->ReadNewsForCategory($category, $search);
    

    if($news) {
    ?> 
        <div class="title-news"><?php echo strtoupper($category) ?>: </div>
        <div class="div-news"> 
    <?php
    foreach ($news as $key => $value) {
        $id = $value['id'];
        $firstImgFromNews = $i->ReadFirstImgFromOneNews($id);
        $imgData = $i->ReadOneImg($firstImgFromNews[0]);

    ?>
        <a href="newsOpen.php?id=<?php echo $value['id']?>" id="link-news">
            <div class="news">
                <div class="img"><img src="Img/Images/<?php echo $imgData['nome']?>" alt=""></div>
                <div class="news-content">
                    <h2 class="news-title">
                                        <?php  
                                            if(strlen($value['title']) > 40){ 
                                                echo substr(strtoupper($value['title']), 0, 40)."..." ; 
                                            } else { 
                                                echo strtoupper($value['title']);
                                            } 
                                        ?>
                    </h2>
                    <p class="news-date">
                                        <?php 
                                            $dia = new DateTime($value['dia']); 
                                            echo $dia->format('d-m-Y | H:i');
                                        ?>
                    </p>
                    <?php 
                        /**
                         * BOTÃO EDITAR NOTÍCIA
                         */
                        $url_edit_news = "newsAdd.php?id=".$value['id'];
                        if(isset($_SESSION['id_adm']) || isset($_SESSION['id_master'])) {
                            echo "<a href='$url_edit_news' class='news-edit-button'>!</a>"; 
                        }
                    ?>
                </div>
            </div>
        </a>
    <?php } ?> </div> <?php
    }   else    {
        echo "<h1>nenhuma notícia sobre $category</h1>";
    }
?>

<?php 
    require 'footer.php'; 
?>
