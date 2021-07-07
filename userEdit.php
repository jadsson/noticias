<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    
    require_once 'Rules/Users/CreateUser.php';
    require_once 'Rules/Users/RuleUser.php';
    
    $newUser = new CreateUser;
    $user = new RuleUser;
    
    $idUser = $_GET['id'];
    
    $usuario = $user->ReadOneUser($idUser);

    if(!$usuario) {
        header('location: showUsers.php');
        exit;
    }

    /**
     * IMPEDINDO QUE USUÁRIOS ENTREM NA PÁGINA COM ID DE OUTRO USUÁRIO
     */
    if(isset($_SESSION['id']) && $_SESSION['id'] != $idUser) {
        header('location: index.php');
        die;
    }

    /**
     * IMPEDINDO QUE ADM TENHAM ACESSO AO MASTER
     */
    if(isset($_SESSION['id_adm']) && $usuario['type_user'] == 'master'){
        echo "<h1>NÃO É POSSÍVEL EXECUTAR ESTA AÇÃO</h1>";
        echo "<a href='showUsers.php'>VOLTAR</a>";
        die;
    }

    /**
     * IMPEDINDO QUE UM ADM ALTERE OS DADOS DE OUTRO ADM
     */
    if((isset($_SESSION['id_adm']) && ($usuario['type_user'] == 'adm')) && (($_SESSION['id_adm']) != $usuario['id'])) {
        echo "<h1>NÃO É POSSÍVEL EXECUTAR ESTA AÇÃO</h1>";
        echo "<a href='showUsers.php'>VOLTAR</a>";
        die;
    }

    require 'head.php';
?>


<form action="" method="POST" style="margin-top: 10%;">
    <h1>ATUALIZAR DADOS</h1>

    <?php 
    
    if(isset($_SESSION['id_master']) && $idUser != $_SESSION['id_master']) {
        /**
         * MOSTRAR OPÇÃO DE TORNAR USUÁRIO UM ADMINISTRADOR CASO O BOSS ESTEJA LOGADO
         */
        ?>
            <label for="type-user">Tipo de Usuário</label>
            <select name="type-user">
                <option value="comum">COMUM</option>
                <option value="adm">ADM</option>
            </select>
            <br><br><hr><br>
        <?php
    }

    ?>

    <label for="username">Nome de Usuário</label>
    <input type="text" name="username" placeholder="<?php echo $usuario['user_name']?>" maxlength="20">

    <label for="password">Senha</label>
    <input type="password" name="password" placeholder="<?php   if(isset($_SESSION['id_master']) || isset($_SESSION['id_adm'])) {
                                                                echo 'Insira a nova senha do usuário';
                                                        }else {
                                                                echo 'Insira sua senha atual ou uma nova';
                                                        } ?>">
    <label for="conf-pass">Confirmar Senha</label>
    <input type="password" name="conf-pass" placeholder="<?php   if(isset($_SESSION['id_master']) || isset($_SESSION['id_adm'])) {
                                                                echo 'Confirmar nova senha do usuário';
                                                        }else {
                                                                echo 'Confirmar senha';
                                                        } ?>">

    <input type="submit" class="cancel" name="atualizar" value="ATUALIZAR">
</form>


<?php 

    if(isset($_POST['atualizar'])) {
        $newUser->setId($idUser);
        $newUser->setUserName(addslashes(htmlentities($_POST['username'])));
        $newUser->setPassword(addslashes(htmlentities($_POST['conf-pass'])));

        if(isset($_SESSION['id_adm']) && $usuario['type_user'] == 'comum') {
            $newUser->setType('comum');
        }elseif(isset($_SESSION['id_adm']) && $usuario['type_user'] == 'adm') {
            $newUser->setType('adm');
        }

        if(isset($_SESSION['id'])) {
            $newUser->setType('comum');
        }

        if(isset($_SESSION['id_master']) && $usuario['type_user'] == 'master') {
            $newUser->setType('master'); 
        }
        elseif(isset($_SESSION['id_master']) && $usuario['type_user'] != 'master') {
            $newUser->setType($_POST['type-user']);
        }

        
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['conf-pass'])) {
            if($_POST['password'] === $_POST['conf-pass']) {

                $user->UpdateUser($newUser);

            }else{

                echo "<h1>SENHAS DIVERGENTES</h1>";

            }
        }else{
            echo "<h1>PREENCHA TODOS OS CAMPOS</h1>";
        }
        
    }

?>


<?php require 'footer.php'; ?>