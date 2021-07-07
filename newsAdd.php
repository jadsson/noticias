<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['id_master']) && !isset($_SESSION['id_adm'])) {
        header('location: index.php');
        exit;
    }
    require_once 'Rules/News/RuleNews.php';
    $n = new RuleNews;

    /**
     * DADOS DA NOTÍCIA A SER ATUALIZADA
     */
    if(isset($_GET['id'])) {
        $news = $n->ReadOneNews($_GET['id']);

        /**
         * EVITANDO QUE O USUÁRIO INSIRA NA URL O ID DE UMA NOTÍCIA QUE NÃO EXISTE
         */
        if(!$news) {
            header('location: index.php');
            exit;
        }
    }

    require 'head.php'; 

?>

<h1>
    <?php 
        if(isset($_GET['id'])){ echo 'ATUALIZAR'; } 
        else { echo 'ADICIONAR'; } 
    ?>
     NOTÍCIA
</h1>

<form action="" method="POST" enctype="multipart/form-data" multiple>
    CATEGORIA 
    <?php 
        if(isset($_GET['id'])) echo "ATUAL";
    ?>: 
    <select name="category">
        <option value="<?php echo $news['category']?>">
            <?php 
                if(isset($_GET['id'])) echo strtoupper($news['category']) 
            ?>
        </option>
        <option value="outros">OUTROS</option>
        <option value="games">GAMES</option>
        <option value="animes">ANIMES</option>
    </select><br><br>


    <input name="title" type="text" placeholder="TÍTULO" 
    <?php 
        if(isset($_GET['id'])) { 
        ?> value="<?php  echo $news['title']; } ?>" 
    >


    <textarea name="text" placeholder="TEXTO DA NOTÍCIA"
    ><?php if(isset($_GET['id'])) echo $news['content'];?></textarea>


    <?php 
        if(!isset($_GET['id'])) {
            ?>
            <br><br>
            <h3>IMAGENS DA NOTÍCIA</h3><br>
            <input type="file" name="arquivo[]" multiple>
            <input type="text" placeholder="TÍTULO PARA AS IMAGENS" name="title-img" maxlength="20">
            <?php
        }
    ?>


    <input type="submit" class="confirm" 
        <?php 
            if(isset($_GET['id'])) 
                                {echo "value='ATUALIZAR NOTÍCIA' name='att-news'"; }
                            else{ echo "value='ENVIAR NOTÍCIA' name='submit'"; } 
        ?> 
    >
    <a href=<?php 
                if(isset($_GET['id'])) echo "news.php?c=".$news['category'];
                else echo 'index.php';
            ?>
        
        style="background:orangered; color:#fff; margin: 20px 0; text-align: center; line-height: 40px;"
    >
    CANCELAR
    </a>

    <?php 
        if(isset($_GET['id'])){
            ?>
                <!-- ENVIANDO ID DA NOTÍCIA A SER ATUALIZADA -->
                <input type="text" name="id_news" value="<?php echo $news['id']?>"
                
                    style="display: none;"
                >
            <?php
        }
    ?>
</form>

<?php 
    require_once 'Php/newsAdd.php';
    require 'footer.php'; 
?>