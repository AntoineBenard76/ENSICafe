<?php
    try{ // essaie
        $bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root',''); 
    }
    catch(Exception $e){ 
        die('Erreur : '.$e->getMessage()); 
    }

if(!isset($_GET['id']))
  $req=$bdd->prepare("SELECT id,contenu,date,fichier,typefichier,stockage FROM `actu` ORDER BY date DESC LIMIT 3");
else
 $req=$bdd->prepare("SELECT id,contenu,date,fichier,typefichier,stockage FROM `actu` WHERE id>'".addslashes($_GET['id'])."' ORDER BY date LIMIT 1");

$req->execute();
$first = true;
while($res = $req->fetch()){
    if($first){
        print '<script>setId('.$res['id'].');</script>';
        $first = false;
    }
	echo "<h3>".$_SESSION['auteur']."</h3>";
	echo "<p>".date($res['date'])."</p>";
	if(!empty($res['fichier'])){
		if($res['typefichier']=="image"){
			if($res['stockage']=="disque"){
				echo '<a href="'.$_SESSION['dossier'].$res['fichier'].'"" ><img src="'.$_SESSION['dossier'].$res['fichier'].'" alt="une image" width="400" height="400"/></a>';
			}
		}
		if($res['typefichier']=="video"){
			if($res['stockage']=="disque"){
				echo '<video controls="controls" src="'.$_SESSION['dossier2'].$res['fichier'].'" width="400" height="400"/>une video</video>';
			}
		}
	}
    print '<li>'.$res['contenu'].'</li>';
}
?>
