<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
    include('php/header-login.php');
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
                    $_SESSION['prenom'] = $userinfo['prenom'];
                    $_SESSION['nom'] = $userinfo['nom'];
                    $_SESSION['avatar'] = $userinfo['avatar'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    $_SESSION['attribut'] = $userinfo['attribut'];
                    $_SESSION['parcours'] = $userinfo['parcours'];
                    header("Location: accueil.php");
                }
                else
                {
                    ?><div class="alert alert-danger" role="alert" align="center">
                        <span class="msg-alert">Mauvais mail ou mot de passe !</span>
                      </div><?php ;
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

                                <label>Adresse mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" class="form-control" name="mailconnect" placeholder="prenom.nom@uha.fr">
                                </div>
                                <br>

                                <label>Mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" name="mdpconnect" placeholder="mot de passe">
                                </div>
                                <br>

                                <button type="submit" name="formconnexion">Se connecter</button>
                                <p><a href="mdp.php">Mot de passe oublié?</a></p>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /#login -->

                    <!-- Register -->
                    <div id="sectionB" class="tab-pane fade">
                        <div class="innter-form">
                            <form class="sa-innate-form" method="post" action="traitementInscription.php">

                                <label>Nom :</label>
                                <input name="nom" required="required" type="text" placeholder="Votre nom" />

                                <label>Prénom :</label>
                                <input name="prenom" required="required" type="text" placeholder="Votre prénom" />
                                <label>Spécialité :</label>
                                <select class="form-control" name="specialite">
                                    <option>Informatique &amp; Réseaux</option>
                                    <option>Automatiques et Systèmes embarqués</option>
                                    <option>Mécanique</option>
                                    <option>Textile &amp; Fibres</option>
                                    <option>FIP</option>
                                    <option>Autre</option>
                                </select>

                                <label>Adresse mail :</label>
                                <input name="mail" required="required" type="email" placeholder="prenom.nom@uha.fr"/>
                                
                                <label>Confirmer l'adresse mail :</label>
                                <input name="mail2" required="required" type="email" placeholder="prenom.nom@uha.fr"/>

                                <label>Votre date de naissance :</label>
                                <input type="date" name="date" />

                                <label class="u_genre">Votre genre :</label>
                                <select name="genre">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                                
                                <label>Mot de passe :</label>
                                <input type="password" name="mdp" placeholder="mot de passe"/>
                                
                                <label>Confirmer le mot de passe :</label>
                                <input type="password" name="mdp2" placeholder="mot de passe"/>

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
                if(isset($_SESSION['erreur']))
                {
                    echo '<font color="red">'.$_SESSION['erreur'].'</font>';
                }
            ?>
    </div>
</div>

<?php
    include('php/footer.php');
?>
