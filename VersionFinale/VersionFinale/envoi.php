<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
    include('header.php');
    
    if(isset($_SESSION['id']) AND !empty($_SESSION['id']))
    {
        if(isset($_POST['envoi_message']))
        {
            if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']))
            {
                $destinataire = htmlspecialchars($_POST['destinataire']);
                $message = htmlspecialchars($_POST['message']);

                $id_destinataire = $bdd->prepare('SELECT id FROM membres WHERE mail = ?');
                $id_destinataire->execute(array($destinataire));
                $dest_exist = $id_destinataire->rowCount();
                if($dest_exist == 1) 
                {
                    $id_destinataire = $id_destinataire->fetch();
                    $id_destinataire = $id_destinataire['id'];
                    $lu = 0;
                    $ins = $bdd->prepare('INSERT INTO messages(id_expediteur, id_destinataire, message, lu) VALUES (?, ?, ?, ?)');
                    $ins->execute(array($_SESSION['id'],$id_destinataire,$message, $lu));
                    

                    $erreur = "Votre message a bien été envoyé !";
                }
                else
                {
                    $erreur = "Cet utilisateur n'existe pas !";
                }
            }
            else 
            {
                $erreur = "Veuillez compléter tous les champs.";   
            }
        }

        $destinataires = $bdd->query('SELECT mail FROM membres ORDER BY mail');

        if(isset($_GET['r']) AND !empty($_GET['r']))
        {
            $r = htmlspecialchars($_GET['r']);
        }

?>

<!-- Contenu principal -->

<div class="container">

    <!-- à enlever -->
    <div class="jumbotron" style="background-color: white;">
        <form method="POST">
            <label> Destinataire :</label>
            <select name="destinataire">
                <?php if(isset($_GET['r']) AND !empty($_GET['r']))
                        {
                            $r = htmlspecialchars($_GET['r']);
                            ?> <option><?= $r ?> </option> <?php
                        }
                        else 
                        {
                        while($d = $destinataires->fetch()) { ?>
                <option><?= $d['mail'] ?></option>
                <?php }
                        }
                ?>
            </select>
            <!---->
            <br /><br />
            <textarea placeholder="Votre message" name="message"></textarea>
            <br /><br />
            <input type="submit" value="Envoyer" name="envoi_message"/>
            <br /><br />
            <?php
                if(isset($erreur)) { echo '<span style="color:red">'.$erreur.'</span>'; }
            ?>
        </form>
        <br />
        <a href="reception.php"> Boîte de réception </a>&nbsp;&nbsp;
        <a href="profil.php?id=<?= $_SESSION['id']?>">Retour au profil</a>
    </body>
    </div>
    <!-- /#à enlever -->

</div>

<!-- Contenu principal -->

<?php
    include('footer.php');
    }
?>