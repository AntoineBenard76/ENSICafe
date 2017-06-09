<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

    if(isset($_POST['forminscription'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $specialite = htmlspecialchars($_POST['specialite']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $date = htmlspecialchars($_POST['date']);
        $genre = htmlspecialchars($_POST['genre']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
        $attribut="Etudiant";
        $parcours = "";
        
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
                                $insertmbr = $bdd->prepare('INSERT INTO membres(mail, motdepasse, nom, prenom, date, genre, avatar, specialite, attribut, parcours) VALUES (?,?,?,?,?,?,?,?,?,?)');
                                $insertmbr->execute(array($mail, $mdp, $nom, $prenom, $date, $genre, "default.jpg", $specialite, $attribut, $parcours));
                                $_SESSION['erreur'] = "Votre compte a bien été créé." ;
                            } else {
                                $_SESSION['erreur'] = "Vos mots de passe ne correspondent pas !";
                            }
                        } else {
                            $_SESSION['erreur'] = "Adresse mail est déjà utilisée.";
                        }
                    } else {
                        $_SESSION['erreur'] = "Votre adresse mail n'est pas valide !";
                    }
                } else {
                    $_SESSION['erreur'] = "Vos adresses mails ne correspondent pas !";
                }
            } else {
                $_SESSION['erreur'] = "Votre nom/prénom ne doit pas dépasser 255 caractères !";
            }
        } else {
            $_SESSION['erreur'] = "Tous les champs doivent être complétés.";
        }
header('Location:index.php');
}