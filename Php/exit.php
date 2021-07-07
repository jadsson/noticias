<?php 
    if(!isset($_SESSION)) session_start();
    unset($_SESSION['id_master'], $_SESSION['id'], $_SESSION['id_adm'], $_SESSION['username'], $_SESSION['type'], $_SESSION['email']);
    header('location: ../index.php');
    exit;