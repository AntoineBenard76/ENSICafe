<nav>
    <section id="navigation">
         <div class="recherche">

        <form action="/search" id="searchthis" method="get">
            <input id="search" name="q" type="text" placeholder="Cherchez une personne" />
            <input id="search-btn" type="submit" value="Rechercher" />
        </form>
    </div>
    <div class="menu">
        <ul id="menu-deroulant">
            <li><a href="profil.php"><img src="img/profil.jpg" width="20px" height="20px" title="profil" alt="profil"/></a>
            </li>
            <li><a href="profil.php">Profil</a>
                <ul>
                    <li><a href="parametres.php">Paramètres</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </li>
            <li><a href="club.php">Clubs</a>
            </li>
            <li><a href="message.php">Messages</a>
            </li>
            <li><a href="annonce.php">Petites annonces</a>
            </li>
        </ul>
    </div>
   
</section>
</nav>
