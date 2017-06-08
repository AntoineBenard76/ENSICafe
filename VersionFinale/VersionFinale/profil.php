<?php
    include('header.php');

    if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
    {
        $getid = intval($_SESSION['id']);
        $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();
?>

<!-- Contenu principal -->

<div class="container">

	<div class="col-md-10 col-md-offset-1">
		<!-- Main panel -->
		<div class="profile-main">
			<div class="profile-background">
				<img class="card-bkimg" alt="" src="img/cafe2.jpg">
			</div>
			<div class="profile-avatar">
				<img class="img-circle" 
                     src="img/avatars/<?php echo $userinfo['avatar']?>" alt="img/avatars/<?php echo $userinfo['avatar']?>"/>
			</div>
			<div class="profile-title">
				<span class="profile-name"><?php echo $userinfo['nom'];?>&nbsp;<?php echo $userinfo['prenom']; ?> </span><br>
				<span class="label label-info"><?= $userinfo['attribut'];?></span>
				<!--<span class="label label-danger">Griffeur</span>-->
			</div>
		</div>

		<div class="panel-group panel-profile" id="accordion" role="tablist" aria-multiselectable="true">
			<!-- Bio -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle btn-block" data-toggle="collapse" href="#collapseOne"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Actions</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body">
						<a href="envoi.php"><button class="btn btn-primary" type="button"> Envoyer un message </button></a>&nbsp;
                        <a href="settings.php"><button class="btn btn-primary" type="button"> Editer le profil </button></a>&nbsp;
                        <?php
                            $prep = $bdd->prepare('SELECT * FROM messages WHERE id_destinataire = ? AND lu = 0');
                            $prep->execute(array($_SESSION['id']));
                            $notif = $prep->rowCount();
                            if($notif >= 1)
                            {
                                ?><a href="reception.php"><button class="btn btn-primary" type="button">
                                  Boîte de réception <span class="badge"><?php echo $notif ;?></span>
                                </button>
                                </a>
                                <?php
                            }
                            else
                            {
                                ?><a href="reception.php"><button class="btn btn-primary" type="button"> Boîte de réception </button></a>                                 <?php
                            }
                        ?>
					</div>
				</div>
			</div>
			<!-- /#bio -->

			<!-- Parcours -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle btn-block" data-toggle="collapse" href="#collapseOne"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Bio</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body">
						<table class="table">
							<tr>
								<td>Spécialité :</td>
								<td><?php echo $userinfo['specialite'];?></td>
							</tr>
							<tr>
								<td>Genre :</td>
								<td><?php echo $userinfo['genre']; ?></td>
							</tr>
							<tr>
								<td>Date de naissance :</td>
								<td><?php echo $userinfo['date'];?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!-- /#parcours -->

			<!-- Parcours -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle btn-block" data-toggle="collapse" href="#collapseTwo"><span class="glyphicon glyphicon-road" aria-hidden="true"></span>Parcours</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
			</div>
			<!-- /#parcours -->

		</div>

	</div>

</div>

<!-- /#contenu principal -->

<?php
    }
	include('chatbox.php');
    include('footer.php');
?>