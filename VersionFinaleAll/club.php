<?php
    include('php/header.php');
?>

<div class="container">
    
    <div class="row">
    	<!-- Navigation club -->
        <div class="navbar navbar-default navbar-club">
            <div class="navbar-header">
            	<a class="navbar-brand" href="#">Liste des clubs</a>
            </div>

            <div class="collapse navbar-collapse">
            	<form class="navbar-form navbar-left">
            		<div class="form-group">
            			<input type="text" name="recherche" class="form-control" placeholder="Chercher un club...">
            		</div>
            		<button type="submit" class="btn btn-info">Chercher</button>
            	</form>

            	<ul class="nav navbar-nav navbar-right">
            		<li><a href="#"><button type="button" class="btn btn-info">Créer un club</button></a></li>
            	</ul>
            </div>
        </div>
        <!-- /#navigation-club -->
    </div>
    
	<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<!-- CLUB 1 -->
				<div class="club-panel">
					<div class="club-title">
						<div class="club-caption">
							<span class="caption-name text-uppercase">XiD</span>
						</div>
						<div class="club-actions pull-right">
							<a href="#">
                                <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span>Voir</button>
							</a>
						</div>
					</div>
					<div class="club-body"><br>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="img/profile_test1.png" alt="photo_club" />
                            </div>
                            <div class="media-body">
                                <p>En géomorphologie, une grotte est une cavité souterraine naturelle comportant au moins une partie horizontale accessible ; ce qui la distingue d'un aven, d'un gouffre, d'un abîme, etc. La première édition du Dictionnaire de l'Académie française (1694) précise qu'elle peut être « naturelle ou faite par artifice ».</p>
                            </div>
                        </div>
					</div>
				</div>
				<!-- /#CLUB 1 -->
                
                <!-- CLUB 1 -->
				<div class="club-panel">
					<div class="club-title">
						<div class="club-caption">
							<span class="caption-name text-uppercase">Club musique</span>
						</div>
						<div class="club-actions pull-right">
							<a href="#">
                                <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span>Voir</button>
							</a>
                            <!--<input class="btn btn-info" type="button" value="Voir" onclick="" /> <span class="glyphicon glyphicon-log-in"></span>-->
						</div>
					</div>
					<div class="club-body"><br>
						<div class="media">
                            <div class="media-body">
                                <p>La dépression (également appelée dépression caractérisée, dépression clinique ou dépression majeure) est un trouble mental caractérisé par des épisodes de baisse d'humeur (tristesse) accompagnée d'une faible estime de soi et d'une perte de plaisir ou d'intérêt dans des activités habituellement ressenties comme agréables par l'individu. Cet ensemble de symptômes (syndrome) individualisé et anciennement classifié dans le groupe des troubles de l'humeur par le manuel diagnostique de l'association américaine de psychiatrie, figure depuis la sortie du DSM-5 en mai 2013 dans la catégorie appelée "Troubles dépressifs". Le terme de « dépression » est cependant ambigu ; il est en effet parfois utilisé dans le langage courant pour décrire d'autres troubles de l'humeur ou d'autres types de baisse d'humeur moins significatifs qui ne sont pas des dépressions proprement dites.</p>
                            </div>
                            <div class="media-right">
                                <img class="media-object" src="img/profile_test2.jpg" alt="photo_club" />
                            </div>
                        </div>
					</div>
				</div>
				<!-- /#CLUB 1 -->
			</div>
	</div>
</div>

<?php
	include('chatbox.php');
    include('php/footer.php');
?>