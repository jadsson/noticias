<?php require 'head.php'; ?>

<form action="" method="POST">
    <h1>Cadastre-se</h1>
    <div>
        <img src="Img/Icons/person.svg" alt="">
        <input name="username" type="text" placeholder="nome de usuário" maxlength="20" autocomplete="off">
    </div>
    <div>
        <img src="Img/Icons/email.svg" alt="">
        <input name="email" type="email" maxlength="50" autocomplete="off" placeholder="email">
    </div>
    <div>
        <img src="Img/Icons/lock_open.svg" alt="">
        <input name="password" type="password" maxlength="255" placeholder="senha">
    </div>
    <div>
        <img src="Img/Icons/lock.svg" alt="">
        <input name="confpass" type="password" maxlength="255" placeholder="confirmar senha">
    </div>
    <input name="submit" class="confirm" type="submit" value="Confirmar">
</form>

<?php 
    require_once 'Php/signup.php'; 
    require 'footer.php';
?>