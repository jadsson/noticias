<?php 
    if(!isset($_SESSION)) session_start();
    ob_start();

    require_once 'Rules/Images/RuleImage.php';
    require_once 'Rules/News/RuleNews.php';
    require_once 'Rules/Comments/RuleComment.php';
    require_once 'Rules/Users/RuleUser.php';
    require_once 'Rules/Users/CreateUser.php';

    $n = new RuleNews;
    $i = new RuleImg;
    $c = new RuleComment;
    $u = new RuleUser;
    $user = new CreateUser;

    $idNews = $_GET['id'];

    $newsSelectec = $n->ReadOneNews($idNews);
    $imgsNews = $i->ReadAllImgOfOneNews($idNews);
    $commentsFromThisNews = $c->ReadAllCommentFromOneNews($idNews);

    /**
     * DADOS DO USUÁRIO LOGADO
     */
    if(isset($_SESSION['id'])) $idUser = $_SESSION['id'];
    elseif(isset($_SESSION['id_adm'])) $idUser = $_SESSION['id_adm'];
    elseif(isset($_SESSION['id_master'])) $idUser = $_SESSION['id_master'];
    if(isset($_SESSION['email'])) {
        $userData = $u->ReadOneUser($idUser);
        $username = $userData['user_name'];
    }

    /**
     * DADOS DO ADM
     */
    $admSendNewsData = $u->ReadOneUser($newsSelectec['id_adm']);
    $admSendNews = $admSendNewsData['user_name'];
    $admAttNewsData = $u->ReadOneUser($newsSelectec['id_adm_upd']);
    if($admAttNewsData) {
        $admAttNews = $admAttNewsData['user_name'];
    }

    require 'head.php'; 

    if(!$newsSelectec) {
        header('location: index.php');
        exit;
    }
?>
    <!-- Show Title and Date -->
    <div class="title">
        <h1><?php echo $newsSelectec['title']?></h1>
        <em><?php 
                $dia = new DateTime($newsSelectec['dia']); 
                $upd = new DateTime($newsSelectec['upd']);
                echo " enviado por $admSendNews em ";
                echo $dia->format('d-m-Y à\s H:i');
                if($newsSelectec['id_adm_upd'] != 0) {
                    echo " | atualizado por $admAttNews em ";
                    echo $upd->format('d-m-Y à\s H:i');
                }
        ?></em>
    </div>

    <!-- Show Images -->
    <?php require_once 'Php/showImgs.php' ?>
    


    <!-- Comments -->
    <section id="comentarios">
            <!-- Link all News -->
    <div class="link-all-news">
        <div id="background-link-all-news">
            <div class="background-img-unique">
                <img src="Img/background/35df3be7572b68dab96acb3a18ac51e3.jpg" alt="">
            </div>
            <div class="background-img-unique">
                <img src="Img/background/4b70f8c31c656791c7d2eb94c6db0923.jpg" alt="">
            </div>
            <div class="background-img-unique">
                <img src="Img/background/4c56c8385cdbfe140f6b6bff96fe607f.jpg" alt="">
            </div>
            <div class="background-img-unique">
                <img src="Img/background/de8b27f8a80270d8b3b261e15e7d8317.jpg" alt="">
            </div>
        </div>
        <a href="news.php?c=<?php echo $newsSelectec['category']?>">MAIS NOTÍCIAS SOBRE <?php echo strtoupper($newsSelectec['category'])?></a>
    </div>
    <?php 
        if(isset($_SESSION['email'])) {
            ?>
            
                <form action="" method="POST" class="form-comment">
                    <textarea id="comment" name="comment" type="text" placeholder="comentar como @<?php echo $username ?>" maxlength="255"></textarea>
                    <input type="submit" class="button-comments"  name="enviarComentario" value="Comentar"></input>
                </form>
            
            <?php

            if(isset($_POST['enviarComentario'])) {
                require_once 'Php/comment.php';
                header("location: newsOpen.php?id={$_GET['id']}");
            }
        } else {
            echo "<h1>Faça <a href='signin.php' style='color: red'>Login</a> para comentar</h1>";
            echo "<hr><br>";
        }

        foreach ($commentsFromThisNews as $key => $value) {
            ?>
            <div class="comentario--unico">
                <div class="comentario--img"></div>
                <div class="comentario--conteudo">
                    <div class="comentario--nome-dia">
                        <div class="comentario--nome">
                            <?php 
                                if($value['type_user'] == 'adm') echo "<div class='comentario--nome--adm'>".$value['user_name']." @ADM@</div>";
                                elseif($value['type_user'] == 'master') echo "<div class='comentario--nome--master'>".$value['user_name']." @BOSS@</div>";
                                else echo "<div>".$value['user_name']."</div>";
                            ?>
                        </div>
                        <div class="comentario--dia">
                            <?php   
                                $dia = new DateTime($value['dia']); 
                                echo $dia->format('d-m-Y | H:i');
                            ?>
                        </div>
                        <?php 
                            // ---- LINK DE EXCLUIR COMENTÁRIO
                            if((isset($_SESSION['id_adm']) && $value['type_user'] != 'master') || isset($_SESSION['id_master']) || (isset($_SESSION['id']) && $_SESSION['id'] == $value['id_user'])) {
                                ?>
                                    <a href="deleteComment.php?id=<?php echo $value['id_user']?>&c=<?php echo $value['id']?>&n=<?php echo $_GET['id']?>" class="comentario--excluir">Excluir</a>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="comentario--texto"><?php echo $value['content']?></div>
                </div>
            </div>
            <?php
        }
    ?>
    </section>

    <?php
    if(isset($_SESSION['id_adm']) || isset($_SESSION['id_master'])) {
        ?>
        <!-- MODAL EXCLUIR IMAGEM -->
        <div id="modal-delete-img">
            <div id="content">
                <h1>EXCLUIR ESTA IMAGEM?</h1>
                <img alt="" id="img-modal-delete-img">
                <form action="" method="POST">
                    <input type="submit" name="excluir-img" class="confirm" value="EXCLUIR">

                    <!-- ESSES DOIS INPUTS RECEBEM SEUS VALUES COM JAVASCRIPT E REPASSAM PARA AS 
                    VARIÁVEIS $caminho e $nomeImg NO MOMENTO DE EXCLUIR A IMAGEM -->
                    <input type="text" name="nome-da-imagem" id="nome-da-imagem" style="display: none;">
                    <input type="text" name="link-img-diretorio" id="link-img-diretorio" style="display: none;">

                    <div id="close-modal-delete-img">CANCELAR</div>
                </form>
            </div>
        </div>

        <?php 
    }

        /**
         * RECEBENDO OS VALORES DOS INPUTS E EXCLUINDO A IMAGEM
         */
        if(isset($_POST['excluir-img'])) {
            $caminho = $_POST['link-img-diretorio'];
            $nomeImg = $_POST['nome-da-imagem'];
            $i->DeleteImg($nomeImg);
            unlink($caminho);
            header("location: newsOpen.php?id=$idNews");
        }

        if(isset($_SESSION['id_adm']) || isset($_SESSION['id_master'])) {
            ?>
                <!-- ÍCONE DE EDITAR NOTÍCIA -->
                <abbr title="EDITAR NOTÍCIA">
                    <a href="newsAdd.php?id=<?php echo $newsSelectec['id']?>" class="button-edit-news-page-news-open">!</a>
                </abbr>
            <?php
        }
        /**
         * SÓ MOSTRAR O BOTÃO DE EXCLUIR NOTÍCIA PARA O ADMINISTRADOR QUE POSTOU A NOTÍCIA
         * E PARA O MASTER
         */
        if((isset($_SESSION['id_adm']) && $_SESSION['id_adm'] == $newsSelectec['id_adm']) || isset($_SESSION['id_master'])) {
            ?>
            <!-- ÍCONE DE EXCLUIR NOTÍCIA -->
                <abbr title="EXCLUIR NOTÍCIA">
                    <div class="icon-delete-news">
                        <img src="Img/Icons/delete.svg" alt=""></img>
                    </div>
                </abbr>

            <!-- MODAL DE EXCLUIR NOTÍCIA -->
                <div id="modal-delete-news">
                    <div id="modal-delete-news-content">
                        <h1>TEM CERTEZA QUE DESEJA EXCLUIR A NOTÍCIA "<?php echo $newsSelectec['title']?>"</h1>
                        <p>Todas as imagens, comentários e conteúdo da notícia serão excluídos!</p>
                        <form method="POST">
                            <input type="submit" name="delete-news" class="cancel" value="SIM QUERO EXCLUIR">
                        </form>
                    </div>
                </div>


            <?php
            if(isset($_POST['delete-news'])) {
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
            require_once 'Php/newsDelete.php';
        }
    ?>

<?php require 'footer.php'; 
    ob_end_flush();
?>