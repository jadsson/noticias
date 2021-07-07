<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }

    require_once 'Rules/Comments/RuleComment.php';
    require_once 'Rules/News/RuleNews.php';

    $c = new RuleComment;
    $n = new RuleNews;

    if(isset($_SESSION['id']))  $id = $_SESSION['id'];
    if(isset($_SESSION['id_adm']))  $id = $_SESSION['id_adm'];
    if(isset($_SESSION['id_master']))  $id = $_SESSION['id_master'];

?>

<style>
    #body-comments {
        padding: 10px 0;
    }
    .comment-uni {
        padding: 5px 0 15px 0;
    }
    .data-user {
        display: flex;
        align-items: baseline;
        flex-wrap: wrap;
        font-weight: 600;
    }
    .data-user .comment-name {
        color: rgb(0,136,255);
        margin-right: 10px;
    }
    .data-user .comment-hour {
        font-size: 14px;
        margin-right: 10px;
    }
    .data-user .comment-news a{
        color: #520700;
    }
    .data-user .comment-news a:hover {
        color: red;
    }
    .comment-content {
        padding: 10px 0 10px 0px;
    }
    #icon-search-users {
        position: fixed;
        right: 40px;
        top: 150px;
        padding: 5px 20px;
        font-size: 40px;
        color: #fff;
        background: rgba(0,0,0,.2);
        border-radius: 50%;
        cursor: pointer;
        transform: scale(.8);
        transition: all ease .5s;
    }
    #icon-search-users:hover {
        background: rgba(0,0,0,.7);
        transform: scale(1);
        transform: rotate(-45deg);
    }

</style>

<?php
    
    $comments = $c->ReadAllCommentFromOneUser($id, '');

?>
    <div id="body-comments">
    <?php
    if($comments) {
        foreach ($comments as $key => $value) {
        ?>
            <div class="comment-uni">
                <div class="data-user">
                    <div class="comment-name"><?php echo $value['user_name']?></div>
                    <div class="comment-hour">
                        <?php 
                            $d = new DateTime($value['dia']);
                            echo $d->format('d-M-Y | H:i');
                        ?>
                    </div>
                    <div class="comment-news"><a href="newsOpen.php?id=<?php echo $value['id_news']?>"><?php echo $value['title']?></a></div>
                </div>
                <div class="comment-content"><?php echo $value['content']?></div>
            </div><hr>
        <?php
        }
    }else {
        echo "<h1>SEUS COMENTÁRIOS APARECERÃO AQUI</h1>";
    }

    ?>
    </div>
