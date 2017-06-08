<!-- ********** CHATBOX : chatbox en bas à droite ********** -->

<div class="container-fluid">
    <div class="col-md-3 pull-right chatbox-panel">

        <!-- Chatbox header -->
        <div class="panel">
            <div class="panel-heading" id="accordion" data-toggle="collapse" href="#chatbox-collapse">
                <span class="glyphicon glyphicon-comment"></span><span class="chatbox-name"> Chat général</span>
                <div class="btn-group pull-right" data-toggle="dropup">
                    <span class="glyphicon glyphicon-chevron-down"></span>
                </div>
            </div>
        </div>
        <!-- /#chatbox-header -->

        <!-- Chatbox window -->
        <div class="panel-collapse collapse" id="chatbox-collapse">

            <!-- Chatbox body : affichage des messages -->
            <div class="panel-body">
                <ul class="chat">
                    <!-- Message 1 -->
                    <li class="left clearfix">
                        <span class="chat-img pull-left"><img src="img/profile_test1.png" alt="user_profile" class="img-circle" /></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Le chat</strong>
                                <span class="label label-info">Chat</span>
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>Il y a 15 min</small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                    </li>

                    <!-- Message 2 -->
                    <li class="right clearfix">
                        <span class="chat-img pull-right"><img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="user_profile" class="img-circle" /></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">[Pseudo]</strong>
                                <span class="label label-danger">Tag</span>
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>[Date]</small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                    </li>

                    <!-- Message 3 -->
                    <li class="left clearfix">
                        <span class="chat-img pull-left"><img src="img/profile_test1.png" alt="user_profile" class="img-circle" /></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Le chat</strong>
                                <span class="label label-info">Chat</span>
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>Il y a 5 min</small>
                            </div>
                            <p>
                                Meow meow meow 
                            </p>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- /#chatbox body -->

            <!-- Chatbox footer : envoyer un message -->
            <div class="panel-footer">
                <div class="input-group">
                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Écrire un message..." />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-sm" id="btn-chat">Envoi</button>
                    </span>
                </div>
            </div>
            <!-- /#chatbox footer -->
            
        </div>
        <!-- /#chatbox-window -->
    </div>
    <!-- /#chatbox -->
</div>
<!-- /#container-fluid -->