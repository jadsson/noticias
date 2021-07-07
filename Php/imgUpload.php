<?php 
    if(!isset($_SESSION['email'])) {
        header('location: ../index.php');
        exit;
    }

    require_once 'Rules/Images/CreateImage.php';
    require_once 'Rules/Images/RuleImage.php';


    $newImg = new CreateImage;
    $upImg = new RuleImg;


    if(isset($_POST['submit'])){
        $permitidos = ['jpg', 'png', 'jpeg', 'jfif'];
        
        $indice = count($_FILES['arquivo']['name']);
        
        $num = 0;

        $issetImg = false;
        
        while ($num < $indice) {
            $extensao = pathinfo($_FILES['arquivo']['name'][$num], PATHINFO_EXTENSION);
            
            if(in_array($extensao, $permitidos)){
                $destino = "Img/Images/";
                $tmp_name = $_FILES['arquivo']['tmp_name'][$num];
                $new_name = md5(uniqid(time())).".$extensao";

                if(move_uploaded_file($tmp_name, $destino.$new_name)){
                    if(isset($_SESSION['id_master'])) { $newImg->setIdUser($_SESSION['id_master']) ; }
                    if(isset($_SESSION['id_adm'])) { $newImg->setIdUser($_SESSION['id_adm']) ; }
                    if(isset($_SESSION['id'])) { $newImg->setIdUser($_SESSION['id']); }
                    $categoryImg == 'news' ? $newImg->setIdNews($idLastNews[0]) : false;
                    $newImg->setTitle(addslashes($_POST['title-img']));
                    $newImg->setNome($new_name);
                    $newImg->setCategory($categoryImg);

                    $upImg->RegistImg($newImg);
                    echo "<script>alert('IMAGEM ".($num+1)." ADICIONADA COM SUCESSO')</script>";
                    $issetImg = true;
                }
            }else{
                !$extensao ? $extensao = 'VAZIO' : $extensao = strtoupper($extensao);
                echo "<script>alert('FORMATO DE ARQUIVO \"$extensao\" NÃO É SUPORTADO')</script>";
            }
            $num++;
        }
    
    }