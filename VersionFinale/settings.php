<?php
    include('php/header.php');

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
            header('Location:profil.php?id='.$_SESSION['id']);
        }
        
        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
        {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);
            if($mdp1 == $mdp2)
            {
                $insertmdp = $bdd->prepare('UPDATE membres SET motdepasse = ? WHERE id = ?');
                $insertmdp->execute(array($mdp1, $_SESSION['id']));
                header('Location:profil.php?id='.$_SESSION['id']);
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
            header('Location:profil.php?id='.$_SESSION['id']);
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
                        header('Location:profil.php?id='.$_SESSION['id']);
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
        if(isset($_POST['newparcours']) AND !empty($_POST['newparcours']))
        {
            $newparcours = htmlspecialchars($_POST['newparcours']);
            $insertparcours = $bdd->prepare("UPDATE membres SET parcours = ? WHERE id = ?");
            $insertparcours->execute(array($newparcours, $_SESSION['id']));
            header('Location:profil.php?id='.$_SESSION['id']);
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
                        <img class="media-object img-circle" src="img/avatars/<?php echo $user['avatar']?>" height="150px" width="150px" alt="avatar">
                    </div>
                    
                    <div class="media-body">
                        <h4><br>Changer d'image de profil</h4>
                        <!-- Send image -->
                        <form method="POST" action="" enctype="multipart/form-data">
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
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar" />
                                </div>
                                </span>
                            </div>
                            <button class="[ btn btn-success ] settings-apply pull-right" type="submit">Mettre à jour l'image de profil</button>
                        </form>
                        <!-- /#send-image -->
                    </div>
				</div>
                <!-- /#avatar -->

                <br>

                <!-- Mail -->
                <form method="POST">
                    <div class="form-group">
    					<label class="col-md-4 control-label">Adresse mail</label>
    					<div class="col-md-4">
    						<input type="email" name="newmail" placeholder="Mail" class="form-control input-md" value="<?= $user['mail']?>"/>
    					</div>
    				</div>
                    <br><br><br>
                    <!-- /#mail -->

                    <!-- Password -->
    				<div class="form-group">
    					<label class="col-md-4 control-label">Nouveau mot de passe</label>
    					<div class="col-md-4">
    						<input type="password" name="newmdp1" placeholder="Nouveau mot de passe" class="form-control input-md"/>
    				    </div>
                    </div>
                    <br><br>
    				<div class="form-group">
    					<label class="col-md-4 control-label">Confirmer le nouveau mot de passe</label>
    					<div class="col-md-4">
    						<input type="password" name="newmdp2" placeholder="Confirmer le mot de passe" class="form-control input-md"/>
    					</div>
    				</div>
                    <br><br>
                    <!-- /#password -->

                    <!-- Spécialité -->
                    <div class="form-group">
    					<label class="col-md-4 control-label">Spécialité</label>
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
                    <br><br>
                    <!-- /#spécialité -->
                    
                    <!-- Parcours -->
                    <label class="col-md-4 control-label">Parcours</label>
                    <div class="form-group">
                        <textarea class="form-control" name="newparcours" placeholder="Entrez votre parcours..." rows="5"></textarea>
                    </div>
                    <!-- /#parcours -->

                    <div class="settings-buttons">
                       <!-- <button class="[ btn btn-info ]">
                            <a href="profil.php?id=<?php /* $_SESSION['id']*/ ?>">Retour</a>
                        </button>-->
                        <input class="btn btn-info" type="button" value="Retour" onclick="javascript:location.href='profil.php?id=<?= $_SESSION['id'] ?>'"/>
                    </div>
                    <button class="[ btn btn-success ] settings-apply pull-right" type="submit">Mettre à jour le profil</button>
                </form>
                <?php if(isset($msg)) { echo $msg; } ?>
			</div>
		</div>
	</div>
</div>

<!-- Contenu principal -->

<?php
    } else {
        header("Location:index.php");
    }
	include('chatbox.php');
    include('php/footer.php');
?>