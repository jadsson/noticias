<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    require_once 'Rules/Images/RuleImage.php';
    $i = new RuleImg;

    $img = $i->ReadOneImg($_GET['id']);

    if(isset($_SESSION['id']) && $img['id_user'] != $_SESSION['id']) {
        header('location: index.php');
        exit;
    }
    if(isset($_SESSION['id_adm']) && $img['id_user'] != $_SESSION['id_adm']) {
        header('location: index.php');
        exit;
    }
    if(isset($_SESSION['id_master']) && $img['id_user'] != $_SESSION['id_master']) {
        header('location: index.php');
        exit;
    }

    if(isset($_SESSION['id'])) $id = $_SESSION['id'];
    if(isset($_SESSION['id_adm'])) $id = $_SESSION['id_adm'];
    if(isset($_SESSION['id_master'])) $id = $_SESSION['id_master'];

    require 'head.php';

?>
  

    <!-- MODAL EXCLUIR IMAGEM -->
    <div id="modal-delete-img" style="display: block;">
        <div id="content" style="margin: 200px auto 0 auto;">
            <h1>EXCLUIR ESTA IMAGEM?</h1>
            <img src="Img/Images/<?php echo $img['nome']?>" alt="" id="img-modal-delete-img" >
            <form action="" method="POST">
                
                <input type="text" name="nome-da-imagem" id="nome-da-imagem" value="<?php echo $img['nome']?>" style="display: none;">
                <input type="text" name="link-img-diretorio" id="link-img-diretorio" value="<?php echo "Img/Images/".$img['nome'] ?>" style="display: none;">
                
                <input type="submit" name="excluir-img" class="confirm" value="EXCLUIR">
                <a href="userPerfil.php?user=<?php echo $id?>" id="close-modal-delete-img">CANCELAR</a>
            </form>
        </div>
    </div>

    <?php

    /**
     * RECEBENDO OS VALORES DOS INPUTS E EXCLUINDO A IMAGEM
     */
    if(isset($_POST['excluir-img'])) {
        $caminho = $_POST['link-img-diretorio'];
        $nomeImg = $_POST['nome-da-imagem'];
        $i->DeleteImg($nomeImg);
        unlink($caminho);
        header("location: userPerfil.php?user=".$id);
        echo "<h1>$caminho</h1>";
        echo "<h1>$nomeImg</h1>";
    }



