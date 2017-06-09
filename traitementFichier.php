<?php
session_start();
try{ // essaie
        $bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root',''); 
    }
    catch(Exception $e){ 
        die('Erreur : '.$e->getMessage()); 
    }
	// création du dossier img
	$dossier = 'img/';
if(is_dir($dossier)){
} 
else{
   mkdir($dossier);
}
	// création du dossier video
	$dossier2 = 'video/';
if(is_dir($dossier2)){
} 
else{
   mkdir($dossier2);
}
   // traitement du fichier
if(isset($_POST['poster'])){
	$fichier = basename($_FILES['file-preview']['name']);
	$taille_maxi = 100000000;
	$taille = filesize($_FILES['file-preview']['tmp_name']);
	$extensionsimg = array('.png', '.gif', '.jpg', '.jpeg');
	$extensionsvid = array('.mp4', '.ogv', '.webm');
	$extension = strrchr($_FILES['file-preview']['name'], '.'); 
	echo $extension;
	//Début des vérifications de sécurité...
	if(in_array($extension, $extensionsimg)/* && empty($_POST['url'])*/) //Si l'extension est pas dans le tableau
	{
		$status="image";
		echo "c'est une image";
	}
	if(in_array($extension, $extensionsvid)/* && empty($_POST['url'])*/) //Si l'extension est pas dans le tableau
	{
		$status="video";
		echo "c'est une video";
	}
	if(!in_array($extension, $extensionsvid) && !in_array($extension, $extensionsimg)){
		$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, mp4, ogv ou webm.';
	}
	if($taille>$taille_maxi /*&& empty($_POST['url'])*/)
	{
		 $erreur = 'Le fichier est trop gros...';
	}
	if(!isset($erreur) /*&& empty($_POST['url']) */&& $status=="image") //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 if(move_uploaded_file($_FILES['file-preview']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		 {
			  echo 'Upload effectué avec succès !';
		 }
		 else //Sinon (la fonction renvoie FALSE).
		 {
			  echo 'Echec de l\'upload !';
		 }
	}
	if(!isset($erreur) && /*empty($_POST['url']) &&*/ $status=="video") //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 if(move_uploaded_file($_FILES['file-preview']['tmp_name'], $dossier2 . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		 {
			  echo 'Upload effectué avec succès !';
		 }
		 else //Sinon (la fonction renvoie FALSE).
		 {
			  echo 'Echec de l\'upload !';
		 }
	}
	if(!empty($erreur))
	{
		 echo $erreur;
	}
	if(!empty($fichier) && $status=="image"){
		$fichier2 = htmlspecialchars($fichier);
		$stockage="disque";
		/* pour tester la requete sql
		if(!empty($insertion)){
			print_r($bdd->errorInfo());
		}*/
	}
	if(!empty($fichier) && $status=="video"){
		$fichier2 = htmlspecialchars($fichier);
		$stockage="disque";
		/* pour tester la requete sql
		if(!empty($insertion)){
			print_r($bdd->errorInfo());
		}*/
	}
	/* pour l'url
	if(!empty($_POST['image'])){
		$image2 = htmlspecialchars($_POST['image']);
		$stockage="url";
		$insertion2 = $bdd->prepare('INSERT INTO image(url,stockage) VALUES(?,?)');
		$insertion2->execute(array($image2,$stockage));
		/* pour tester la requete sql
		if(!empty($insertion2)){
			print_r($bdd->errorInfo());
		}
	}*/
}
$_SESSION['dossier']=$dossier;
$_SESSION['dossier2']=$dossier2;
// fin traitement du fichier
if(!empty($_POST['publier'])){
	$publier = htmlspecialchars($_POST['publier']);
	$type="actualite";
    $insertion = $bdd->prepare('INSERT INTO actu(id,auteur,contenu,date,type,fichier,typefichier,stockage,nbLike,nbDislike) VALUES(NULL,?,?,NOW(),?,?,?,?,NULL,NULL)'); 
    $insertion->execute(array($_SESSION['auteur'],$_POST['publier'],$type,$fichier2,$status,$stockage));
}
header("Location: accueil.php");
?>