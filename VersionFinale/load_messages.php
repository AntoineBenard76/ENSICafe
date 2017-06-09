<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root','');
?>
    <ul class="chat">
                    <?php
                $allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC LIMIT 0,10');
                while($msg = $allmsg->fetch())
                    {
            ?>
                    
                    <!-- Message 1 -->
                    <li class="left clearfix">
                        <span class="chat-img pull-left"><img src="img/avatars/<?php echo $msg['avatarMes']?>" alt="user_profile" class="img-circle" /></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font"><?php echo utf8_decode($msg['nomExp']); echo " "; echo utf8_decode($msg['prenomExp']);?></strong>
                                <span class="label label-info"><?php echo utf8_decode($msg['attributExp']);?></span>
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span><?php echo utf8_decode($msg['dateMes']);?></small>
                            </div>
                            <p>
                                <?php echo $msg['contenuMes'];?>
                            </p>
                        </div>
                    </li>
                    <?php 
                    }
                    ?>
                </ul>