<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
include('php/header-login.php');
if(isset($_GET['section'])){
    $_SESSION['section'] = htmlspecialchars($_GET['section']);
}else{
    $_SESSION['section']="";
}
if(isset($_POST['envoyer'])){
    $_SESSION['email']=htmlspecialchars($_POST['email']);
}
if($_SESSION['section']=='code'){ ?>
Un code de vérification vous a été envoyé 
<form method="post" action="traitementmdp.php">
    <label>Votre code de vérification : </label>
    <input type="text" name="code" placeholder="Code de vérification" />
    <input type="submit" name="envoyer_code" value="Envoyer" />
</form>
<?php } elseif($_SESSION['section']=="changemdp"){ ?>
Nouveau mot de passe
<form method="post" action="traitementmdp.php">
    <input type="password" name="mdp1" placeholder="Nouveau mot de passe" /><br />
    <input type="password" name="mdp2" placeholder="Confirmation mot de passe" />
    <input type="submit" name="enregistrer" value="Enregistrer" />
    
</form>   
<?php }else {?>
<form method="post" action="traitementmdp.php">
    <label>Votre e-mail : </label>
    <input type="mail" name="email" placeholder="prenom.nom@uha.fr" />
    <input type="submit" name="envoyer" value="Envoyer" />
</form>
<?php } ?>
<?php if (isset($_SESSION['erreur'])){ echo $_SESSION['erreur']; } ?>
<?php
    include('php/footer.php');
?>
