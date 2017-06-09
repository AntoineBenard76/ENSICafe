<?php
    include('php/header.php');
?>

<!-- Contenu principal -->

<div class="container">

    <!-- à enlever -->
    <div class="jumbotron" style="background-color: white;">
        <form method="POST" action="traitementEnvoi.php">
            <label> Destinataire :</label>
            <select name="destinataire">
                <?php
                    $destinataires=$bdd->query('SELECT mail FROM membres ORDER BY mail');
                    while($d = $destinataires->fetch()) { 
                ?>
                <option><?= $d['mail'] ?></option>
                <?php } ?>
            </select>
            <!---->
            <br /><br />
            <textarea placeholder="Votre message" name="message"></textarea>
            <br /><br />
            <input type="submit" value="Envoyer" name="envoi_message"/>
            <br /><br />
            <?php
                if(isset($_SESSION['erreur'])) { echo '<span style="color:red">'.$_SESSION['erreur'].'</span>'; }
            ?>
        </form>
        <br />
        <a href="reception.php"> Boîte de réception </a>&nbsp;&nbsp;
        <a href="profil.php?id=<?= $_SESSION['id']?>">Retour au profil</a>

    </div>
    <!-- /#à enlever -->

</div>

<!-- Contenu principal -->

<?php
    include('php/footer.php');
    //}
?>