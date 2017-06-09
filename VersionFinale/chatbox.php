<?php  
    if(!empty($_POST['contenuMes'])){
        $avatarMes = htmlspecialchars($_SESSION['avatar']);
        $attributExp = htmlspecialchars($_SESSION['attribut']);
        $nomExp = htmlspecialchars($_SESSION['nom']);
        $prenomExp = htmlspecialchars($_SESSION['prenom']);
		$contenuMes = htmlspecialchars($_POST['contenuMes']);
        $insertion = $bdd->prepare('INSERT INTO chat(id, nomExp, prenomExp, contenuMes, dateMes, avatarMes, attributExp) VALUES(NULL,"'.$nomExp.'","'.$prenomExp.'","'.$contenuMes.'",NOW(),"'.$avatarMes.'","'.$attributExp.'")');
		$insertion->execute();            
	}
?>
<!-- ********** CHATBOX : chatbox en bas à droite ********** -->

<div class="container-fluid">
    <div class="col-md-3 pull-right chatbox-panel">

        <!-- Chatbox header -->
        <div class="panel">
            <div class="panel-heading" id="accordion" data-toggle="collapse" href="#chatbox-collapse">
                <span class="glyphicon glyphicon-comment"></span><span class="chatbox-name"> Chat général</span>
                <div class="btn-group pull-right" data-toggle="dropup">
                    <span class="glyphicon glyphicon-chevron-down"></span>
                </div>
            </div>
        </div>
        <!-- /#chatbox-header -->

        <!-- Chatbox window -->
        <div class="panel-collapse collapse" id="chatbox-collapse">

            <!-- Chatbox body : affichage des messages -->
            <div class="panel-body" id="messages">
                <ul class="chat">
                    <?php
                $allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC LIMIT 0,10');
                while($msg = $allmsg->fetch())
                    {
            ?>
                    
                    <!-- Message 1 -->
                    <li class="left clearfix">
                        <span class="chat-img pull-left"><img src="img/<?php echo $msg['avatarMes'];?>" alt="user_profile" class="img-circle" /></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font"><?php echo utf8_decode($msg['nomExp']); echo utf8_decode($msg['prenomExp']);?></strong>
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
            </div>
            <!-- /#chatbox body -->

            <!-- Chatbox footer : envoyer un message -->
            <div class="panel-footer">
                <div class="input-group">
                <form method="post" action="">
                    <textarea type="text" width="250px" name="contenuMes" placeholder="Votre message"></textarea><br />
                    <input type="submit" value="Envoyer"/>
                </form>
                </div>
            </div>
            <!-- /#chatbox footer -->
            
        </div>
        <!-- /#chatbox-window -->
    </div>
    <!-- /#chatbox -->
</div>
<!-- /#container-fluid -->
    <script>
        setInterval('load_messages()', 2000);
        function load_messages() {
            $('#messages').load('load_messages.php');
        }
    </script>