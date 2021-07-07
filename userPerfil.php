<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])){
        header('location: index.php');
        die;
    }

    require_once 'Rules/Users/RuleUser.php';
    $u = new RuleUser;
    
    $id = $_GET['user'];
    $user = $u->ReadOneUser($id);

    /**
     * IMPEDINDO O ACESSO À ESTA PÁGINA POR QUALQUER PESSOA QUE NÃO SEJA O PRÓPRIO USUÁRIO
     */
    if((isset($_SESSION['id']) && $_SESSION['id'] != $user['id']) || 
    (isset($_SESSION['id_master']) && $_SESSION['id_master'] != $user['id']) || 
    (isset($_SESSION['id_adm']) && ($_SESSION['id_adm'] != $user['id']))) {
        header('location: index.php');
        exit;
    }
    
    require 'head.php';

    if(isset($_SESSION['id_master']))   $id = $_SESSION['id_master'];
    elseif(isset($_SESSION['id_adm']))  $id = $_SESSION['id_adm'];
    elseif(isset($_SESSION['id']))      $id = $_SESSION['id'];
?>

<div id="div-pai">

    <form action="" method="POST">
        <input type="text" name="url" value="Php/Perfil/images.php" style="display: none;">
        <input type="submit" name="submit" value="SUAS IMAGENS">
    </form>
    <form action="" method="POST">
        <input type="text" name="url" value="Php/Perfil/comments.php" style="display: none;">
        <input type="submit" name="submit" value="SEUS COMENTÁRIOS">
    </form>

</div>

<div id="div-conteudo">
    <?php 
        if(isset($_POST['submit'])) {
            require_once "{$_POST['url']}";
        }else{
            echo "<h1>selecione suas imagens ou comentários</h1>";
        }
    
    ?>
</div>


<?php require 'footer.php'; ?>