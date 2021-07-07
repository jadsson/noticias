<?php 
    if(!isset($_SESSION)) session_start();
    ob_start();
    require_once 'Rules/Images/RuleImage.php';

    $i = new RuleImg;
    
    require 'head.php'; 
    
    $category = $_GET['ic'];
    $img = $i->ReadImgForCategory($category);

    if($category != 'outros' && $category != 'anime' && $category != 'game') {
        header('location: index.php');
        exit;
    }

?>

<div class="corpo--imagens" style="max-height: 1200px!important">
    <?php 
            if($img) {
                foreach ($img as $key => $value) {
                    ?>
                        <div class="img"  style="max-width: 390px; height: 150px">
                            <img class="img-pequena" src="Img/Images/<?php echo $value['nome']?>" alt="">
                            <?php 
                                if(isset($_SESSION['id_adm']) || isset($_SESSION['id_master'])) {
                                    echo "<span id='delete-img-button'>&times;</span>";
                                }
                            ?>

                        </div>
                    <?php
                }
            } 
            
            ?>
    </div>
    
    <!-- MODAL IMAGEM TELA CHEIA -->
    <div id="simpleModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content">
            <img id="img_modal" alt="">
        </div>
    </div>
    
<?php 

    if(isset($_SESSION['email'])) { 
        ?>
        <!-- MODAL ENVIAR IMAGENS -->
        <div class="upload-img-modal">
            <div class="form-modal">
                <form method="POST" enctype="multipart/form-data" multiple>
                <h1>ENVIAR IMAGEM</h1>
                <span class="close-img-modal">&times;</span>
                <span>CATEGORIA: "<?php echo strtoupper($category)?>"</span> 
                <br><br>
                <input type="file" name="arquivo[]" multiple>
                <input type="text" name="title-img" placeholder="Um título pra sua imagem">
                <input type="submit" name="submit" value="Enviar">
                <br>
                <p>SUA IMAGEM SERÁ EXIBIDA NA ABA "<?php echo strtoupper($category)?>"</p>
                <br>
                <p>Formatos permitidos: jpg | png | jpeg | jfif</p>
                </form>
            </div>
        </div>

        <!-- ÍCONE DE UPLOAD -->
        <abbr title="ENVIAR IMAGEM"><span class="icon-upload">&#8681</span></abbr>
        <?php
    }
    /**
     * FAZER UPLOAD DAS IMAGENS
     */
    if(isset($_POST['submit'])) {
        $categoryImg = $_GET['ic'];
        require_once 'Php/imgUpload.php';
        header("location: images.php?ic=$categoryImg");
    }


    if(isset($_SESSION['id_adm']) || isset($_SESSION['id_master'])) {
        ?>
        <!-- MODAL EXCLUIR IMAGEM -->
        <div id="modal-delete-img">
            <div id="content">
                <h1>EXCLUIR ESTA IMAGEM?</h1>
                <img alt="" id="img-modal-delete-img">
                <form action="" method="POST">
                    
                    <!-- ESSES DOIS INPUTS RECEBEM SEUS VALUES COM JAVASCRIPT E REPASSAM PARA AS 
                    VARIÁVEIS $caminho e $nomeImg NO MOMENTO DE EXCLUIR A IMAGEM -->
                    <input type="text" name="nome-da-imagem" id="nome-da-imagem" style="display: none;">
                    <input type="text" name="link-img-diretorio" id="link-img-diretorio" style="display: none;">
                    
                    <input type="submit" name="excluir-img" class="confirm" value="EXCLUIR">
                    <div id="close-modal-delete-img">CANCELAR</div>
                </form>
            </div>
        </div>

        <?php
    }

    /**
     * RECEBENDO OS VALORES DOS INPUTS E EXCLUINDO A IMAGEM
     */
    if(isset($_POST['excluir-img'])) {
        $caminho = $_POST['link-img-diretorio'];
        $nomeImg = $_POST['nome-da-imagem'];
        $i->DeleteImg($nomeImg);
        unlink($caminho);
        header("location: images.php?ic=$category");
    }

    require 'footer.php'; 

    ob_end_flush();
?>