
<section id="corpo">
            <?php if($imgsNews) { ?>
                <div class="corpo--imagens">
                <?php
                    foreach ($imgsNews as $key => $value) {
                        ?>
                            <div class="img">
                                <img class="img-pequena" src="Img/Images/<?php echo $value['nome']?>" alt="">
                                
                                <?php 
                                    if(isset($_SESSION['id_adm']) || isset($_SESSION['id_master'])) {
                                        echo "<span id='delete-img-button'>&times;</span>";
                                    }
                                ?>

                            </div>
                        <?php
                    }
                }             
            ?>
        </div>

        <div id="texto">
            <?php echo $newsSelectec['content']?>
        </div>

        <div id="simpleModal" class="modal">
            <span class="close">&times;</span>
            <div class="modal-content">
                <img id="img_modal" alt="">
            </div>
        </div>

</section>