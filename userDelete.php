<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    require_once 'Rules/Users/RuleUser.php';
    require_once 'Rules/Users/CreateUser.php';
    $confUser = new CreateUser;
    $user = new RuleUser;

    $idUser = $_GET['id'];
    
    $usuario = $user->ReadOneUser($idUser);

    if(!$usuario) {
        header('location: showUsers.php');
        exit;
    }

    /**
     * VERIFICANDO SE O USUÁRIO É O MESMO QUE ESTÁ SENDO DELETADO
     * SOMENTE EM CASO DE NÃO-MODERADORES
     */
    if(isset($_SESSION['id']) && $_SESSION['id'] != $idUser) {
        header('location: index.php');
        exit;
    }

    /**
     * O BOSS NÃO PODE SER EXCLUÍDO
     */
    if($usuario['type_user'] == 'master') {
        echo "<h1>NÃO É POSSÍVEL EXECUTAR ESTA AÇÃO</h1>";
        echo "<a href='showUsers.php'>VOLTAR</a>";
        die;
    }

    /**
     * IMPEDINDO QUE UM ADM EXCLUA OUTRO ADM OU ELE MESMO
     */
    if(!isset($_SESSION['id_master']) && $usuario['type_user'] == 'adm') {
        echo "<h1>NÃO É POSSÍVEL EXECUTAR ESTA AÇÃO</h1>";
        echo "<a href='showUsers.php'>VOLTAR</a>";
        die;
    }

    require 'head.php';
?>

<form action="" method="POST" style="margin-top: 10%;">
    <?php 
        if($_SESSION['email'] == $usuario['email']) {
            echo "<h1>QUER EXCLUIR SUA CONTA?</h1>";
        }else{
            echo "<h1>EXCLUIR ESTE USUÁRIO?</h1>";
        }
    ?>
    <input type="text" name="username" placeholder="<?php echo $usuario['user_name']?>">
    <input type="text" name="email" placeholder="<?php echo $usuario['email']?>">
    <input type="submit" name="excluir" class="cancel" value="EXCLUIR USUÁRIO">
</form>

<?php 

    if(isset($_POST['excluir'])) {
        ?>
        <!-- MODAL CONFIRMAR SENHA -->
        <div id="modal-confirm-pass">
            <form action="" method="POST">
                <h1>CONFIRME SUA SENHA</h1>
                <input type="text" name="email-confirm-pass" value="<?php echo $_SESSION['email']?>" style="display:none">
                <input type="password" name="confirm-pass" placeholder="INSIRA SUA SENHA">
                <input type="submit" class="confirm" name="send-confirm-pass" value="CONFIRMAR">
                <div class="close-modal-confirm-pass">CANCELAR</div>
            </form>
        </div>

        <?php
    }
    if(isset($_POST['send-confirm-pass'])) {
        $email = addslashes(htmlentities($_POST['email-confirm-pass']));
        $senha = addslashes(htmlentities($_POST['confirm-pass']));
        $confUser->setEmail($email);
        $confUser->setPassword($senha);

        if($user->ConfirmPass($confUser)) {
            if(isset($_SESSION['id_master'])) {
                $user->DeleteUser($usuario['id']);
            }elseif(isset($_SESSION['id_adm']) && $usuario['type_user'] == 'comum') {
                $user->DeleteUser($usuario['id']);
            }elseif(isset($_SESSION['id']) && $usuario['id'] == $_SESSION['id']) {
                $user->UserDeleteSelf($usuario['id']);
            }
        }
    }
?>


<?php require 'footer.php'; ?>