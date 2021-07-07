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

    if((isset($_SESSION['id']) && $_SESSION['id'] != $user['id']) || 
    (isset($_SESSION['id_master']) && $_SESSION['id_master'] != $user['id']) || 
    (isset($_SESSION['id_adm']) && $_SESSION['id_adm'] != $user['id'])) {
        header('location: index.php');
        exit;
    }
    
    require 'head.php';


?>

<style>
    .container-user{
        display: flex;
        justify-content: space-around;
        align-items: center;
        min-height: calc(100vh - 150px - 120px);
    }
    .editar-conta {
        width: 350px;
        text-align: center;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        transition: all ease .5s;
    }
    .editar-conta:hover {
        transform: translateY(-5px);
    }
    .editar-conta h1 {
        background: #520700;
        color: #fff;
        padding: 10px;
    }
    .editar-conta a {
        display: block;
        line-height: 50px;
        color: #520700;
    }
</style>

<div class="container-user">
    <div class="editar-conta">
        <h1>EDITAR SEUS DADOS</h1>
        <a href="userEdit.php?id=<?php echo $id?>">CLIQUE PARA EDITAR</a>
    </div>
    <div class="editar-conta">
        <h1>EXCLUIR SUA CONTA</h1>
        <a href="userDelete.php?id=<?php echo $id?>">CLIQUE PARA EXCLUIR</a>
    </div>
</div>






<?php require 'footer.php'; ?>