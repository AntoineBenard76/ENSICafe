<!-- Sidebar : barre de navigation gauche -->
<div class="row">
    <div class="col-sm-6">
        <button id="menu-toggle" onclick="toggleMenu(event)" type="button" class="btn btn-menu btn-lg">
            <span class="glyphicon glyphicon-forward"></span>
            </button>
        </div>
        <div class="col-sm-6">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="profil.php?id=<?= $_SESSION['id']?>">
                            <img    class="img-circle" 
                                    src="img/avatars/<?= $_SESSION['avatar']?>"
                                    style="width: 30px; height: 30px;"/>
                            <?= $_SESSION['nom'] ;?>
                            <?= $_SESSION['prenom'];?>
                        </a>
                    </li>
                    <li><a href="club.php">Clubs</a></li>
                    <li><a href="#">Blabla</a></li>
                    <li><a href="#">Marshmallow</a></li>
                    <li><a href="#">Café</a></li>
                    <li><a href="#">Toast</a></li>
                    <li><a href="#">Meringue</a></li>
                </ul>
            </div>
        </div>
    </div>
<!-- /#sidebar-wrapper -->