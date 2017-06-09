<?php
    include('php/header.php');
    
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
                    
                    $_SESSION['erreur'] = "Votre message a bien été envoyé !";
                }
                else
                {
                    $_SESSION['erreur'] = "Cet utilisateur n'existe pas !";
                }
            }
            else 
            {
                $_SESSION['erreur'] = "Veuillez compléter tous les champs.";   
            }
        }
    
        if(isset($_GET['r']) AND !empty($_GET['r']))
        {
            $r = htmlspecialchars($_GET['r']);
        }
    header('Location:envoi.php');
    }
?>