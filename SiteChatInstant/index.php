<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

    if(isset($_POST['formconnexion']))
    {
        $mailconnect = htmlspecialchars($_POST['mailconnect']);  
        $mdpconnect = sha1($_POST['mdpconnect']);
        if(!empty($mailconnect) AND !empty($mdpconnect))
        {
            $requser = $bdd->prepare('SELECT * FROM membres WHERE mail = ? AND motdepasse = ?');
            $requser->execute(array($mailconnect, $mdpconnect));
            $userexist = $requser->rowCount();
            if($userexist == 1)
            {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['prenom'] = $userinfo['prenom'];
                $_SESSION['mail'] = $userinfo['mail'];
                header("Location: profil.php?id=".$_SESSION['id']);
            }
            else
            {
                $erreur = "Mauvais mail ou mot de passe !";
            }
        }
        else 
        {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }
?>
<html>

    <head>
        <meta charset="utf-8">
        <title> ROAD TO CHAT </title>
    </head>
    <body>
        <div align="center">
            <h2> Connexion </h2>
            <br /><br />
            <form method="POST" action"">
                <input type="email" name="mailconnect" placeholder="Mail" />
                <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                <input type="submit" name="formconnexion" value="Se connecter"/>
            </form>
             <?php 
                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur.'</font>';
                }
            ?>
        </div>
        <div align="center">
            Pas encore de compte ?
            <form method="post" action="inscription.php">
                <input type="submit" value="S'inscrire"/>
            </form>
        </div>
    </body>
</html>