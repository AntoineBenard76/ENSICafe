<?php
    include('pages/header-login.php');
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);
}else{
    $section="";
}
if(isset($_POST['envoyer'])){
    $erreur="";
    if(!empty($_POST['email'])){
        $email=htmlspecialchars($_POST['email']);
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $emailexist=$bdd->prepare('SELECT id FROM membres WHERE mail=?');
            $emailexist->execute(array($email));
            $emailexist=$emailexist->rowcount();
            if($emailexist==1){
                $_SESSION['mail']=$email;
                $code="";
                //Création du code qui sera envoyé à l'utilisateur
                for($i=0;$i<8;$i++){
                    $code.=mt_rand(0,9);
                }
                
                //Vérification de l'existence du mail dans la table récupération
                $mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail=?');
                $mail_recup_exist ->execute(array($email));
                $mail_recup_exist=$mail_recup_exist->rowcount();
                if($mail_recup_exist==1){
                    //Mise à jour du code
                    $insert = $bdd->prepare('UPDATE recuperation SET code=? WHERE mail=?');
                    $insert->execute(array($code,$email));
                }else{
                    $confirme=0;
                    $insert = $bdd->prepare('INSERT INTO recuperation(mail,code,confirme) VALUES(?,?,?)');
                    $insert->execute(array($email,$code,$confirme));
                }
                
                //Envoi du mail de modification
                require 'PHPMailer-master/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                      // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'ensicafe2017@gmail.com';           // SMTP username
                $mail->Password = 'ensisa2017';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
            
                $mail->setFrom('ensicafe2017@gmail.com', utf8_decode('ENSICafé'));
                $mail->addAddress($email);     // Add a recipient

                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = utf8_decode('Mot de passe oublié');
                //Penser à corriger le chemin de l'URL du mail
                $mail->Body    = utf8_decode('Voici votre code de récupération : <b>'.$code.'</b>');
                $mail->AltBody = utf8_decode('Voici votre code de récupération : <b>'.$code.'</b>');

                if(!$mail->send()) {
                    echo 'Le message n\'a pas pu être envoyé.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                   //echo 'message envoyé';
                   header("Location:http://127.0.0.1/ENSICafe-SiteDesign-Connexion/SiteDesign/mdp.php?section=code");
                }
            }else{
                $erreur= 'Cette adresse n\'est pas enregistrer';
            }
        }else{
            $erreur= 'Adresse mail incorrecte';
        }
    }else{
            $erreur= 'Veuillez indiquer votre addresse e-mail';
        }
}

//Traitement du code de récupération
if(isset($_POST['envoyer_code'],$_POST['code'])){
    if(!empty($_POST['code'])){
        $verif_code=htmlspecialchars($_POST['code']);
        $verif_req=$bdd->prepare('SELECT id FROM recuperation WHERE mail=? AND code=?');
        $verif_req->execute(array($_SESSION['mail'],$verif_code));
        $verif_req= $verif_req->rowCount();
        if( $verif_req==1){
            //Update de confirme
            $up_req=$bdd->prepare('UPDATE recuperation SET confirme=1 WHERE mail=?');
            $up_req->execute(array($_SESSION['mail']));
            $del_req=$bdd->prepare('DELETE FROM recuperation WHERE mail=?');
            $del_req->execute(array($_SESSION['mail']));
            //Redirection vers un formulaire pour modifer le mdp
            header("Location:http://127.0.0.1/ENSICafe-SiteDesign-Connexion/SiteDesign/mdp.php?section=changemdp");
        }else{
           $erreur="Code invalide"; 
        }
    }else{
        $erreur="Veuillez indiquer votre code de récupération";
    }
}

//Traitement du changement de mdp
if(isset($_POST['enregistrer'])){
    if(isset($_POST['mdp1'],$_POST['mdp2'])){
        $verif_confirme=$bdd->prepare('SELECT confirme FROM recuperation WHERE mail=?');
        $verif_confirme->execute(array($_SESSION['mail']));
        $verif_confirme=$verif_confirme->fetch();
        $verif_confirme=$verif_confirme['confirme'];
        if($verif_confirme==1){
            $mdp1=htmlspecialchars($_POST['mdp1']);
            $mdp2=htmlspecialchars($_POST['mdp2']);
            if(!empty($mdp1) AND !empty($mdp2)){
                if($mdp1==$mdp2){
                    $mdp1=sha1($mdp1);
                    //Changement du mdp
                    $insert_mdp = $bdd->prepare('UPDATE membres SET motdepasse=? WHERE mail=?');
                    $insert_mdp->execute(array($mdp1,$_SESSION['mail']));
                    //Redirection vers la page de connexion
                    header("Location:http://127.0.0.1/ENSICafe-SiteDesign-Connexion/SiteDesign/index.php");
                }else{
                    $erreur="Vos mots de passes ne correspondent pas";
                }
            }else{
                $erreur="Veuillez remplir tous les champs";
            }
        }else{
            $erreur="Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
        }
    }else{
        $erreur="Veuillez remplir tous les champs";
}
}

?>

<?php if($section=='code'){ ?>
Un code de vérification vous a été envoyé à l'adresse : <?php echo $_SESSION['mail']; ?>
<form method="post">
    <label>Votre code de vérification : </label>
    <input type="text" name="code" placeholder="Code de vérification" />
    <input type="submit" name="envoyer_code" value="Envoyer" />
</form>
<?php } elseif($section=="changemdp"){ ?>
Nouveau mot de passe pour <?php echo $_SESSION['mail']; ?>
<form method="post">
    <input type="password" name="mdp1" placeholder="Nouveau mot de passe" /><br />
    <input type="password" name="mdp2" placeholder="Confirmation mot de passe" />
    <input type="submit" name="enregistrer" value="Enregistrer" />
    
</form>   
<?php }else { ?>
<form method="post">
    <label>Votre e-mail : </label>
    <input type="mail" name="email" placeholder="prenom.nom@uha.fr" />
    <input type="submit" name="envoyer" value="Envoyer" />
</form>
<?php } ?>
<?php if (isset($erreur)){ echo $erreur; } ?>
<?php
    include('pages/footer.php');
?>