        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
    <footer class="footer">
        <p>Ensicafé 2017</p>
    </footer>

    <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous">
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <!--<script>
        // GENERAL: gère l'ouverture et la fermeture du menu gauche
        function toggleMenu(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            $("#menu-toggle").find('span').toggleClass('glyphicon-forward').toggleClass('glyphicon-backward');
        }

        // accueil.php : fait disparaître la publication lorsqu'on clique sur la croix
        $(".close").click(function () {
            $(this).closest('.panel-custom').fadeOut();
        });

        // accueil.php : déroule automatiquement les news ('interval' en ms)
        $(document).ready(function() {
            $('#carousel-news').carousel({
                pause: true,
                interval: 10000,
            });
        });

        // accueil.php : fait apparaître la fenêtre pour commenter (publication)
        $(function () {
             $('.panel-custom > .panel-body > .pull-left > .input-placeholder, .panel-custom > .panel-comment > .panel-custom-textarea > button[type="reset"]').on('click', function(event) {
                var $panel = $(this).closest('.panel-custom');
                $comment = $panel.find('.panel-comment');
                
                $comment.find('.btn:first-child').addClass('disabled');
                $comment.find('textarea').val('');

                $panel.toggleClass('panel-custom-show-comment');

                if ($panel.hasClass('panel-custom-show-comment')) {
                    $comment.find('textarea').focus();
                }
            });

             $('.panel-comment > .panel-custom-textarea > textarea').on('keyup', function(event) {
                var $comment = $(this).closest('.panel-comment');

                $comment.find('button[type="submit"]').addClass('disabled');
                if ($(this).val().length >= 1) {
                    $comment.find('button[type="submit"]').removeClass('disabled');
                }
            });

        });

        // accueil.php + settings.php : upload de fichier
        $(function() {
        // "Annuler"
        $('.preview-clear').click(function(){
        $('.preview-filename').val("");
        $('.preview-clear').hide();
        $('.preview-input input:file').val("");
        $(".preview-input-title").text("Browse"); 
        }); 

        // Montre le nom du fichier à upload
        $(".preview-input input:file").change(function (){     
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".preview-input-title").text("Change");
                $(".preview-clear").show();
                $(".preview-filename").val(file.name);
            }  
            reader.readAsDataURL(file);
            });  
        });

        // reception.php : cache et affiche les messages en fonction de la personne sélectionnée
        $(document).ready(function() {
            $('#msg-wrap').hide();
            $('.conversation').click(function() {
                var id = this.id.substring(5); // Récupère les 5 premiers caractères de l'id qui sont menu_ et numero de l'id (menu_1,...)
                $(this).siblings('.conversation').removeClass('active');
                $(this).addClass('active');
                $('[id^=message_]').hide();
                $('#message_'+id).show();
                $('#msg-wrap').show();
            });  
        });
 </script>-->
<script type="text/javascript" src="js/footer.js"></script>
</body>

</html>
