<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['id_adm']) && !isset($_SESSION['id_master'])) {
        header('location: index.php');
        exit;
    }

    if(isset($_SESSION['id_adm']) && ($_SESSION['id_adm'] != $newsSelectec['id_adm'])) {
        header('location: index.php');
        exit;
    }

    if(isset($_POST['send-confirm-pass'])) {
        $user->setEmail($_POST['email-confirm-pass']);
        $user->setPassword($_POST['confirm-pass']);
        
        if($u->ConfirmPass($user)) {
            /**
             * EXCLUIR A NOTÍCIA CASO A SENHA DO ADM ESTEJA CORRETA
             */
            if($n->DeleteNews($newsSelectec['id'])){

                /**
                 * EXCLUIR TODAS AS IMAGENS DO DIRETÓRIO
                 */
                if($imgsNews){
                    foreach ($imgsNews as $key => $value) {
                        $caminho = "Img/Images/".$value['nome'];
                        unlink($caminho);
                    }
                }
            }
        }
    }
