<?php require 'head.php'; ?>

<form action="" method="POST">
    <h1>Login</h1>
    <div>
        <img src="Img/Icons/email.svg" alt="">
        <input name="email" type="email" maxlength="50" autocomplete="off" placeholder="email">
    </div>
    <div>
        <img src="Img/Icons/lock.svg" alt="">
        <input name="password" type="password" maxlength="255" placeholder="senha">
    </div>
    <input name="submit" class="confirm" type="submit" value="Confirmar">
</form>


<?php 
    require_once 'Php/signin.php'; 
    require 'footer.php';
?>