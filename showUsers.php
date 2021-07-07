<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['id_master']) && !isset($_SESSION['id_adm'])) {
        header('location: index.php');
        exit;
    }
    require 'head.php'; 


    require_once 'Rules/Users/RuleUser.php';
    $u = new RuleUser;

?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 5px 0;
    }
    .tr {
        text-align: center;
        font-weight: 700;
        padding: 5px 0;
        background: linear-gradient(315deg, #922016, #520700);
        border: 1px solid rgba(200,200,200,.6);
        color: white;
    }
    tbody {
        line-height: 40px;
    }
    tbody td{
        border: 1px solid #999999;
        padding: 0 0 0 10px;
        font-weight: 600;
    }
    tr:nth-child(even) {
        background-color: rgba(200,200,200);
    }
    tr:nth-child(odd) {
        background-color: white;
    }
    .boss {
        background:  #922016;
        color: white;
    }
    .edit, .delet {
        width: 30px;
    }
    .edit-user-button, .delete-user-button {
        width: 25px;
        height: 25px;
        background: orangered;
        border-radius: 50%;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 1px 2px 5px rgba(0,0,0,.7);
    }
    .delete-user-button {
        background: red;
    }
    #icon-show-users {
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
    #icon-show-users:hover {
        background: rgba(0,0,0,.7);
        transform: scale(1);
        transform: rotate(-45deg);
    }
    /* MODAL PESQUISAR USUÁRIOS */
    #modal-search-comment {
        display: none;
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0,0,0,.95);
    }
    #modal-search-comment form {
        display: block;
        margin: 280px auto 0 auto;
    }
    #modal-search-comment form div {
        display: flex;
    }
    #confirm-search-comment {
        width: 100px;
    }
    #search-comment {
        color: #fff;
    }
    #icon-close-modal-comment {
        font-size: 40px;
        color: #fff;
        position: fixed;
        right: 40px;
        top: 150px;
        padding: 5px 20px;
        font-size: 40px;
        cursor: pointer;
        z-index: 1;
    }
    #icon-close-modal-comment:hover {
        color: red;
    }

    #reload-table {
        font-size: 30px;
        position: fixed;
        top: 155px;
        right: 150px;
        padding: 4px 15px 7px 15px;
        background: rgba(0,0,0,.2);
        border-radius: 50%;
        color: #fff;
        transition: all ease 1s;
    }
    #reload-table:hover {
        background: rgba(0,0,0,.7);
        transform: rotate(360deg);
    }
</style>
<!-- ÍCONE ABRIR MODAL DE PESQUISA -->
<span id="icon-show-users">&#9906</span>

<a href="showUsers.php" id="reload-table">&#8635</a>

    <!-- MODAL PESQUISA DE COMENTÁRIOS -->
    <div id="modal-search-comment">
        <span id="icon-close-modal-comment">&times;</span>
        <form action="" method="POST">
            <h1 style="color: #fff;">buscar por usuário</h1>
            <div>
                <input type="text" name="search" id="search-comment">
                <input type="submit" class="confirm" value="Buscar" id="confirm-search-comment">
            </div>
        </form>
    </div>


<table>
    <tr>
        <th class="tr">ID</th>
        <th class="tr">TIPO</th>
        <th class="tr">USUÁRIO</th>
        <th class="tr">EMAIL</th>
        <th class="tr" colspan="2">AÇÃO</th>
    </tr>
    <?php 

    if(isset($_POST['search'])) {
        $search = addslashes(htmlentities($_POST['search']));
    }else{
        $search = '';
    }

    $showUsers = $u->ReadUser($search);

        if($showUsers) {
            foreach ($showUsers as $key => $value) {
                echo '<tr>';
                if($value['type_user'] == 'comum') {
                    ?>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php echo $value['type_user'] ?></td>
                        <td><?php echo $value['user_name'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td class="edit">
                            <a href="userEdit.php?id=<?php echo $value['id'] ?>">
                                <div class="edit-user-button">!</div>
                            </a>
                        </td>
                        <td class="delet">
                            <a href="userDelete.php?id=<?php echo $value['id'] ?>">
                                <div class="delete-user-button">X</div>
                            </a>
                        </td>

                    <?php
                } else {
                    ?>
                        <td class="boss"><?php echo $value['id'] ?></td>
                        <td class="boss"><?php echo $value['type_user'] ?></td>
                        <td class="boss"><?php echo $value['user_name'] ?></td>
                        <td class="boss"><?php echo $value['email'] ?></td>
                        <td class="edit">
                            <a href="userEdit.php?id=<?php echo $value['id'] ?>">
                                <div class="edit-user-button">!</div>
                            </a>
                        </td>
                        <td class="delet">
                            <a href="userDelete.php?id=<?php echo $value['id'] ?>">
                                <div class="delete-user-button">X</div>
                            </a>
                        </td>
                    <?php
                }
                echo '</tr>';
            }
        }else{
            echo "<tr><td colspan='5'><h1>NENHUM USUÁRIO ENCONTRADO</h1></td></tr>";
        }
        ?>
</table>

<script>
    const buttonOpenSearch = document.querySelector('#icon-show-users');
    const modalSearchUser = document.querySelector('#modal-search-comment');
    const closeModalSearch = document.querySelector('#icon-close-modal-comment');
    buttonOpenSearch.addEventListener('click', ()=>{
        modalSearchUser.style.display = 'block';
    })
    closeModalSearch.addEventListener('click', ()=>{
        modalSearchUser.style.display = 'none';
    })
    
    const buttonReload = document.querySelector('#reload-table');
    const confirmSearch = document.querySelector('#confirm-search-comment');
    confirmSearch.addEventListener('click', ()=>{
        buttonReload.style.display = 'block';
    })

</script>

<?php require 'footer.php'; ?>