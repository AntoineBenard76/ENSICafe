<?php
    include('php/header.php');

    if(isset($_SESSION['id']) AND !empty($_SESSION['id']))
    {
    $msg = $bdd->prepare('SELECT * FROM messages WHERE id_destinataire = ? ORDER BY id DESC');
    $msg->execute(array($_SESSION['id']));
    $msg_nbr = $msg->rowCount();
?>

<!-- Contenu principal -->

<div class="container">

    <!-- à enlever -->
    <div class="jumbotron" style="background-color: white;">
        <a href="profil.php?id=<?= $_SESSION['id'] ?>"> Profil </a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="envoi.php"> Nouveau message</a><br /><br /><br />
        <h3> Votre boîte de réception :</h3>
        <?php 
            if($msg_nbr == 0){ echo "Vous n'avez aucun message ..."; }
            while($m = $msg->fetch()) {
            $p_exp = $bdd->prepare('SELECT mail FROM membres WHERE id = ?');
            $p_exp->execute(array($m['id_expediteur']));
            $p_exp = $p_exp->fetch();
            $p_exp = $p_exp['mail'];
        ?>
        <?php if($m['lu'] == 1){ ?> <i>(Lu)</i> <?php } ?> <b><?= $p_exp ?></b> vous a envoyé <a href="lecture.php?id=<?= $m['id'] ?>">ce message</a> <br />
        --------------------------------------------------------<br/>
        <?php } ?>
    
    
    </div>
    <!-- /#à enlever -->

    <!-- Optionnel : barre d'outils avec une autre classe row ici -->
    <div class="jumbotron panel-reception">
        <legend>Messages</legend>

        <div class="row">
            <!-- PROFILS -->
            <div class="conversation-wrap col-lg-3">
                <!-- Profil 1 -->
                <div class="media conversation" id="menu_1">
                    <a class="pull-left" href="#">
                        <img class="img-circle" src="img/profile_test1.png" alt="profile_test1.png">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">Le super chat</h5>
                        <span class="label label-info">Chat</span>
                    </div>
                </div>
                <!-- /#profil 1 -->

                <!-- Profil 2 -->
                <div class="media conversation" id="menu_2">
                    <a class="pull-left" href="#">
                        <img class="img-circle" src="img/profile_test2.jpg" alt="profile_test2.jpg">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">La super grenouille</h5>
                        <span class="label label-success">Grenouille</span>
                    </div>
                </div>
                <!-- /#profil 2 -->

            </div>
            <!-- /#PROFILS -->

            <!-- MESSAGES -->
            <div class="message-wrap col-lg-8" id="msg-wrap">
                <!-- Personne 1 -->
                <div id="message_1">
                    <!-- Message 1 -->
                    <div class="media msg">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="img/profile_test1.png" alt="profile_test1.png">
                        </a>
                        <div class="media-body">
                            <small class="pull-right time"><i class="glyphicon glyphicon-time"></i>13h45</small>
                            <h5 class="media-heading">Le super chat</h5>
                            <small class="col-lg-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small>
                        </div>
                    </div>
                    <!-- /#message 1 -->

                    <!-- Message 2 -->
                    <div class="media msg">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="img/profile_test1.png" alt="profile_test1.png">
                        </a>
                        <div class="media-body">
                            <small class="pull-right time"><i class="glyphicon glyphicon-time"></i>10h21</small>
                            <h5 class="media-heading">Le super chat</h5>
                            <small class="col-lg-10">Meow meow meow</small>
                        </div>
                    </div>
                    <!-- /#message 2 -->
                </div>
                <!-- /#personne 1 -->

                <!-- Personne 2 -->
                <div id="message_2">
                    <!-- Message 1 -->
                    <div class="media msg">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="img/profile_test2.jpg" alt="profile_test2.jpg">
                        </a>
                        <div class="media-body">
                            <small class="pull-right time"><i class="glyphicon glyphicon-time"></i>48h03</small>
                            <h5 class="media-heading">La super grenouille</h5>
                            <small class="col-lg-10">CROAK CROAK</small>
                        </div>
                    </div>
                    <!-- /#message 1 -->

                    <!-- Message 2 -->
                    <div class="media msg">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="img/profile_test2.jpg" alt="profile_test2.jpg">
                        </a>
                        <div class="media-body">
                            <small class="pull-right time"><i class="glyphicon glyphicon-time"></i>66h66</small>
                            <h5 class="media-heading">La super grenouille</h5>
                            <small class="col-lg-10">Le terme grenouille est un nom vernaculaire attribué à certains amphibiens, principalement dans le genre Rana. À un de ses stades de développement, la larve de la grenouille est appelée un têtard. Les grenouilles sont des quadrupèdes de l'ordre des anoures, tout comme les rainettes, qui sont en général plus vertes et arboricoles, les crapauds dont la peau est plus granuleuse et les xénopes strictement aquatiques. Tous ces termes usuels correspondent à des apparences extérieures plus qu'à des classements strictement taxinomiques.</small>
                        </div>
                    </div>
                    <!-- /#message 2 -->

                    <!-- Message 3 -->
                    <div class="media msg">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="img/profile_test2.jpg" alt="profile_test2.jpg">
                        </a>
                        <div class="media-body">
                            <small class="pull-right time"><i class="glyphicon glyphicon-time"></i>42h87</small>
                            <h5 class="media-heading">La super grenouille</h5>
                            <small class="col-lg-10">En Europe, parmi les espèces de grenouilles les plus connues figurent la Grenouille verte et la Petite grenouille verte, la Grenouille des champs, la Grenouille rousse et, en élevage, la Grenouille rieuse.

    Certaines espèces comme la Grenouille-taureau d'Amérique du Nord, la Grenouille Goliath d'Afrique ou Litoria infrafrenata (grenouille géante) sont remarquables pour leur très grande taille.

    Il existe environ 3 800 espèces de grenouilles et crapauds1 qui subissent depuis le milieu du xxe siècle un déclin brutal, déroutant et alarmant.</small>
                        </div>
                    </div>
                    <!-- /#message 3 -->
                </div>
                <!-- /#personne 2 -->

                <form accept-charset="utf-8" action="" class="conversation-msg" method="post">
                    <textarea class="form-control" name="publier" placeholder="Écrire un message..." rows="3"></textarea>
                    <button class="[ btn btn-info ]" type="submit">Répondre</button>
                    <button class="[ btn btn-default ]" type="reset">Annuler</button>
                </form>

            </div>
            <!-- /#MESSAGES -->
        </div>
    </div>

</div>

<!-- Contenu principal -->

<?php
    include('chatbox.php');
    include('php/footer.php');
    }
?>