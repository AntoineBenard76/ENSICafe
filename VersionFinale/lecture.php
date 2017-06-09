<?php
    include('php/header.php');
    if(isset($_SESSION['id']) AND !empty($_SESSION['id']))
    {
        if(isset($_GET['id']) AND !empty($_GET['id']))
        {
            $id_message = intval($_GET['id']);
            
            $msg = $bdd->prepare('SELECT * FROM messages WHERE id = ? AND id_destinataire = ?');
            $msg->execute(array($_GET['id'],$_SESSION['id']));
            $msg_nbr = $msg->rowCount();
            $m = $msg->fetch();
            
            $p_exp = $bdd->prepare('SELECT mail FROM membres WHERE id = ?');
            $p_exp->execute(array($m['id_expediteur']));
            $p_exp = $p_exp->fetch();
            $p_exp = $p_exp['mail'];
?>

<!-- Contenu principal -->

<div class="container">

    <!-- à enlever -->
    <div class="jumbotron" style="background-color: white;">
        <a href="reception.php"> Boîte de réception </a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="envoi.php?r=<?= urlencode($p_exp) ?>"> Répondre </a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="supprimer.php?id=<?= urlencode($m['id']) ?>"> Supprimer le message </a><br /><br /><br />
        <h3 align="center"> Lecture du message #<?= $id_message ?></h3>
        <div align="center">
            <?php if($msg_nbr == 0){ echo "ERREUR"; } else {?>
            <b><?= $p_exp ?></b> vous a envoyé : <br />
            <?= nl2br($m['message']) ?><br/>
            <?php } ?>
        </div>
    </div>
    <!-- /#à enlever -->

</div>

<!-- Contenu principal -->

<?php
            $lu = $bdd->prepare('UPDATE messages SET lu = 1 WHERE id = ?');
        $lu->execute(array($m['id']));
            
        }
    }
    include('php/footer.php');
?>