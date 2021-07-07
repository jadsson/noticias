<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    require_once 'Rules/Images/RuleImage.php';

    $i = new RuleImg;

    if(isset($_SESSION['id']))  $id = $_SESSION['id'];
    if(isset($_SESSION['id_adm']))  $id = $_SESSION['id_adm'];
    if(isset($_SESSION['id_master']))  $id = $_SESSION['id_master'];

    $images = $i->ReadImgFromUser($id);

?>

<style>
    #body-images-user {
        display: flex; 
        flex-wrap: wrap; 
        align-items:center; 
        justify-content:center;
    }
    #images-user {
        width: 350px; 
        height: 120px; 
        margin: 2px; 
        border-radius: 5px; 
        overflow:hidden;
        position: relative;
    }
    #images-user img {
        width: 100%;
        transition: .5s;
    }
    #images-user img:hover {
        transform: scale(1.2);
        cursor: pointer;
    }
    /* BOTÃO EXCLUIR IMAGEM */
    #images-user span {
        opacity: 0;
        font-size: 40px; 
        cursor:pointer; 
        position: absolute; 
        top: -10px; 
        right:10px;
        font-weight: 700;
        color: rgb(255, 75, 75);   
        text-shadow: 2px 2px 0px var(--red--dark);   
        transition: all ease .5s;          
    }
    #images-user span:hover {
        opacity: 1;
    }
    #images-user img:hover {
        transform: scale(1.2);
    }
</style>

    <div id="body-images-user">

        <?php
            if($images) {
                foreach ($images as $key => $value) {
                    ?>
                        <div id="images-user">
                            <img class="img-pequena" src="<?php echo "Img/Images/{$value['nome']}"?>">
                            <a href="userDeleteImg.php?id=<?php echo $value['id']?>"><span id='delete-img-button'>&times;</span></a>
                        </div>
                    <?php
                }
            }else{
                echo "<h1>SUAS IMAGENS APARECERÃO AQUI</h1>";
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
