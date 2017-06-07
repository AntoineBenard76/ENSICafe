<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
    include('header.php');

    if(isset($_SESSION['id']))
    {
        $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();
        
        if(isset($_POST['newmail']) AND !empty($_POST['newmail']))
        {
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        }
        
        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
        {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);
            if($mdp1 == $mdp2)
            {
                $insertmdp = $bdd->prepare('UPDATE membres SET motdepasse = ? WHERE id = ?');
                $insertmdp->execute(array($mdp1, $_SESSION['id']));
                header('Location: profil.php?id='.$_SESSION['id']);
            }
            else 
            {
                $msg = "Vos deux mots de passe ne correspondent pas.";   
            }
        }
        
        if(isset($_POST['newspecialite']) AND !empty($_POST['newspecialite']))
        {
            $newspecialite = htmlspecialchars($_POST['newspecialite']);
            $insertmail = $bdd->prepare("UPDATE membres SET specialite = ? WHERE id = ?");
            $insertmail->execute(array($newspecialite, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        }

        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
        {
            $taillemax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['avatar']['size'] <= $taillemax)
            {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionsValides))
                {
                    $chemin = "img/avatars/".$_SESSION['id'].".".$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                    if($resultat)
                    {
                        $updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id'); 
                        $updateavatar->execute(array(
                            'avatar' => $_SESSION['id'].".".$extensionUpload,
                            'id' => $_SESSION['id']
                        ));
                        header('Location: profil.php?id='.$_SESSION['id']);
                    }
                    else
                    {
                        $msg = "Erreur durant l'importation de votre photo de profil";   
                    }
                }
                else
                {
                    $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png.";  
                }
            }
            else
            {
                $msg = "Votre photo de profil ne doit pas dépasser 2 Mo.";
            }
        }
        
     
?>

<!-- Contenu principal -->

<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-settings">

			<div class="panel-body">
			<legend>Paramètres</legend>
				
                <!-- Avatar -->
				<div class="media settings-avatar">
                    <div class="media-left">
                        <img class="media-object img-circle" src="img/avatars/<?php echo $user['avatar']?>" height="150px" width="150px">
                    </div>
                    
                    <div class="media-body">
                        <h4><br>Changer d'image de profil</h4>
                        <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Send image -->
                        <div class="input-group preview">
                            <input type="text" class="form-control preview-filename" disabled="disabled">
                            <span class="input-group-btn">
                            <!-- preview-clear button -->
                            <button type="button" class="btn btn-default preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Annuler
                            </button>
                            <!-- preview-input -->
                            <div class="btn btn-default preview-input">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <span class="preview-input-title">Image</span>
                                <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar" placeholder="image .png, .jpeg, .gif" />
                            </div>
                            </span>
                        </div>
                        <!-- /#send-image -->
                    </div>
				</div>
                <!-- /#avatar -->
                <br>
                <div class="form-group">
					<label class="col-md-4 control-label" for="newmail">Adresse mail</label>
					<div class="col-md-4">
						<input type="email" name="newmail" placeholder="Mail" class="form-control input-md" value="<?= $user['mail']?>"/>
					</div>
				</div>
                <!-- Password -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="newmdp1">Nouveau mot de passe</label>
					<div class="col-md-4">
						<input type="password" name="newmdp1" placeholder="Nouveau mot de passe" class="form-control input-md">
					</div><br><br>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="newmdp2">Confirmer le nouveau mot de passe</label>
					<div class="col-md-4">
						<input type="password" name="newmdp2" placeholder="Confirmer le mot de passe" class="form-control input-md">
					</div>
				</div>
                    
                <div class="form-group">
					<label class="col-md-4 control-label" for="newspecialite">Rentrez votre spécialité :</label>
					<div class="col-md-4">
						<select class="form-control" name="newspecialite">
                            <option>Informatique &amp; Réseaux</option>
                            <option>Automatiques et Systèmes embarqués</option>
                            <option>Mécanique</option>
                            <option>Textile &amp; Fibres</option>
                            <option>FIP</option>
                            <option>Autre</option>
                        </select>
					</div>
				</div>
                <!-- /#password -->
                <br><br><br>
                <button class="[ btn btn-info ] settings-apply" type="submit">Mettre à jour le profil</button>
                </form>
                <?php if(isset($msg)) { echo $msg; } ?>
                <a href="profil.php?id=<?= $_SESSION['id'] ?>"> Retour au profil </a>
			</div>
		</div>
	</div>
</div>

<!-- Contenu principal -->

<?php
    } else {
        header("Location : index.php");
    }
	include('chatbox.php');
    include('footer.php');
?>