<?php
    include('header-login.php');
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
?>

<br>
<div class="container">
    <div class="row">
        <h2 id="welcome-msg">Bienvenue à l'ensicafé !</h2>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- Formulaire -->
            <div class="form-body">

                <!-- Tabs -->
                <ul class="nav nav-tabs final-login">
                    <li class="active"><a data-toggle="tab" href="#sectionA">Connexion</a></li>
                    <li><a data-toggle="tab" href="#sectionB">Inscription</a></li>
                </ul>

                <div class="tab-content">

                    <!-- Login -->
                    <div id="sectionA" class="tab-pane fade in active">
                        <?php 
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
                    $_SESSION['pseudo'] = $userinfo['pseudo'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    header("Location: accueil.php");
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
                        <div class="innter-form">
                            <form class="sa-innate-form" method="post">

                                <label for="mail">Adresse mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" class="form-control" name="mailconnect" placeholder="prenom.nom@uha.fr">
                                </div>
                                <br>

                                <label for="mdp">Mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" name="mdpconnect" placeholder="mot de passe">
                                </div>
                                <br>

                                <button type="submit" name="formconnexion">Se connecter</button>
                                <p><a href="">Mot de passe oublié?</a></p>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /#login -->

                    <!-- Register -->
                    <div id="sectionB" class="tab-pane fade">
                        <?php 
if(isset($_POST['forminscription'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $date = htmlspecialchars($_POST['date']);
        $genre = htmlspecialchars($_POST['genre']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
        
            if(!empty($_POST['date']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['genre'])) {
            $prenomlength = strlen($prenom);
            $nomlength = strlen($nom);
            if($nomlength <= 255 AND $prenomlength <= 255) {
                if($mail == $mail2) {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $reqmail = $bdd->prepare('SELECT * FROM membres WHERE mail= ?');
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0) {
                            if($mdp == $mdp2) {
                                $insertmbr = $bdd->prepare('INSERT INTO membres(mail, motdepasse, nom, prenom, date, genre) VALUES (?,?,?,?,?,?)');
                                $insertmbr->execute(array($mail, $mdp, $nom, $prenom, $date, $genre));
                                $erreur = "Votre compte a bien été créé. <a href=\"index.php\"> Me connecter</a>" ;
                                //mettre $_SESSION au dessus
                                //header('Location : index.php')
                            } else {
                                $erreur = "Vos mots de passe ne correspondent pas !";
                            }
                        } else {
                            $erreur = "Adresse mail est déjà utilisée.";
                        }
                    } else {
                        $erreur = "Votre adresse mail n'est pas valide !";
                    }
                } else {
                    $erreur = "Vos adresses mails ne correspondent pas !";
                }
            } else {
                    $erreur = "Votre nom/prénom ne doit pas dépasser 255 caractères !";
            }
        } else {
            $erreur = "Tous les champs doivent être complétés.";
        }

    }
?>
                        <div class="innter-form">
                            <form class="sa-innate-form" method="post">

                                <label for="nom">Nom</label>
                                <input name="nom" required="required" type="text" placeholder="nom" />

                                <label for="prenom">Prénom</label>
                                <input name="prenom" required="required" type="text" placeholder="prénom" />

                                <label for="mail">Adresse mail</label>
                                <input name="mail" required="required" type="email" placeholder="prenom.nom@uha.fr"/>
                                
                                <label for="mail2">Confirmer l'adresse mail</label>
                                <input name="mail2" required="required" type="email" placeholder="prenom.nom@uha.fr"/>

                                <label for="mdp">Mot de passe</label>
                                <input type="password" name="mdp" placeholder="mot de passe"/>
                                
                                <label for="mdp">Confirmer le mot de passe</label>
                                <input type="password" name="mdp2" placeholder="mot de passe"/>

                                <label for="date">Votre date de naissance</label>
                                <input type="date" name="date" placeholder="AAAAMMJJ"/>

                                <label for="genre" class="u_genre">Votre genre </label>
                                <select name="genre">
                                    <option value="homme">Homme</option>
                                    <option value="femme">Femme</option>
                                </select>

                                <button type="submit" name="forminscription">S'inscrire</button>
                                <p>Blablabla mentions légales, lorem ipsum blablablablabla</p>
                            </form>
                        </div>
                    </div>
                    <!-- /#register -->

                </div>
            </div>
            <!-- /#formulaire -->
        </div>
    </div>
    <!-- mettre ça en joli (alert) -->
    <div align="center">
                            <?php 
                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur.'</font>';
                }
            ?>
    </div>
</div>

<?php
    include('footer.php');
?>