<?php 
    if(!isset($_SESSION)) session_start();

    require_once 'Rules/Images/RuleImage.php';
    require_once 'Rules/News/RuleNews.php';

    $i = new RuleImg;
    $n = new RuleNews;

    $imgs = $i->ReadFiveImgs();
    $news = $n->ReadFourNews();
    
    /**
     * Pegando a primeira imagem de cada notícia
     * 
     * Primeiro é utilizado o método que retorna o ID da primeira imagem relacionada à notícia
     * Em seguida este ID é utilizado para retornar a imagem correspondente
     */
    foreach ($news as $key => $value) {
        $id_img = $i->ReadFirstImgFromOneNews($value['id']);
        $firstImg[] = $i->ReadOneImg($id_img[0]);
    }

    require 'head.php'; 

?>
    <style>
        /* NEWS */
        .title-index {
            font-size: 40px;
            font-weight: 700;
            text-align: left;
        }
        .news-index {
            margin: 0 0 50px 0;
        }
        #news-principal {
            width: calc(100% - 4px);
            height: 450px;
            background: #520700;
            border-radius: 10px;
            margin: 5px 2px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #news-principal h1{
            color: #fff;
            font-size: 20px;
            position: absolute;
            bottom: 40px;
            left: 40px;
        }
        #news-principal p {
            font-size: 14px;
            font-weight: normal;
            position: absolute;
            bottom: 15px;
            left: 40px;
            color: #ddd;
        }
        #news-principal img {
            width: 100%;
        }
        #news-principal span {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(15deg, rgba(0,0,0,.8), rgba(0,0,0,.1));
        }
        #news-secundary {
            display: flex;
        }
        .news-secundary-content {
            margin: 0 2px;
            height: 200px;
            border-radius: 10px;
            background: #520700;
            width: calc((100%/3) - 4px);
            position: relative;
            overflow: hidden;
        }
        .news-secundary-content h1{
            color: #fff;
            font-size: 16px;
            padding: 5px;
            position: absolute;
            text-align: left;
            bottom: 20px;
            left: 5px;
        }
        .news-secundary-content p{
            font-size: 13px;
            font-weight: normal;
            position: absolute;
            bottom: 5px;
            left: 10px;
            color: #ddd;
        }
        .news-secundary-content a{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .news-secundary-content span {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(15deg, rgba(0,0,0,.9) 5%, rgba(0,0,0,.1)95%);
        }
        .news-secundary-content img {
            width: 100%;
        }

        /* IMAGENS */
        #section-title-and-img{
            margin: 50px 0;
        }
        #section-img-index {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .img-unique-index {
            width: 100%;
            height: 130px;
            overflow: hidden;
            margin: 5px 2px 0px 2px;
            transition: .5s all ease;
        }
        .img-unique-index img {
            width: 100%;
            transition: all ease .5s;
        }
        .img-unique-index:hover {
            height: 500px;
        }
    </style>

    <section id="body-index">
        <!-- SEÇÃO DE NOTÍCIAS -->
        <div class="news-index">
            <h1 class="title-index">NOTÍCIAS MAIS RECENTES</h1>
            <a href="newsOpen.php?id=<?php echo $news[0]['id']?>">
                <div id="news-principal">
                    <span></span>
                    <img src="Img/Images/<?php echo $firstImg[0]['nome']?>" alt="">
                    <h1><?php echo $news[0]['title']; echo ' | '; echo $news[0]['category']?></h1>
                    <p>enviado em 
                        <?php   
                            $dia = new DateTime($news[0]['dia']);
                            echo $dia->format('d-m-Y à\s H:i');
                        ?>
                    </p>
                </div>
            </a>
            <div id="news-secundary">
                
                <?php 
                    
                    for($i=1; $i<4; $i++){
                        ?>
                        <div class="news-secundary-content">
                            <span></span>
                            <img src="Img/Images/<?php echo $firstImg[$i]['nome']?>" alt="">
                            <h1><?php echo $news[$i]['title']; echo ' | '; echo $news[$i]['category'] ?></h1>
                            <p>enviado em 
                                <?php 
                                    $dia = new DateTime($news[$i]['dia']);
                                    echo $dia->format('d-m-Y à\s H:i');
                                ?>
                            </p>
                            <a href="newsOpen.php?id=<?php echo $news[$i]['id']?>"></a>
                        </div>

                        <?php
                        }
                    ?>
            </div>
        </div>

        <!-- SEÇÃO DE IMAGENS -->
        <hr>
        <div id="section-title-and-img">
            <h1 class="title-index">IMAGENS MAIS RECENTES</h1>
            <div id="section-img-index">

                <?php 
                
                    if($imgs){
                        foreach ($imgs as $key => $value) {
                            ?>
                            <div class="img-unique-index">
                                <img src="Img/Images/<?php echo $value['nome']?>" alt="">
                            </div>                    
                            <?php
                        }
                    }else{
                        echo "<h1>AINDA NÃO HÁ IMAGENS A SEREM MOSTRADAS</h1>";
                    }
                
                ?>

            </div>
        </div>
    </section>
    
<?php require 'footer.php'; ?>