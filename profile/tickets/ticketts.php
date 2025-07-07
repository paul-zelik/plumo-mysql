<?php
session_start();
if(isset($_POST['deco'])){
    $_SESSION = array();
    session_destroy();
    header('Location: ../../index.php');
}
?>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
$recupMessage = $bdd->prepare('SELECT * FROM support WHERE id = ?');
$recupMessage->execute(array($_GET['id']));
$mm = $recupMessage->fetch();

?>

<?php
if(isset($_POST['submit'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
    $insertnewmessage = $bdd->prepare('INSERT INTO message_ticket(id,email,date,message,personne) VALUES(?,?,NOW(), ?, 0);');
    $insertnewmessage->execute(array($_GET['id'], $_SESSION['pseudo'], $_POST['submit_message']));
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ticket n°<?=$mm['id']?> - SpeedHeberg</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vous avez un projet ? Nous allons le réaliser pour vous !" />
    <meta name="keywords" content="Oqoo, Agency, Management, Talent" />
    <meta name="author" content="Oqoo Agency" />
    <meta name="email" content="contact@oqoo.agency" />
    <meta name="website" content="https://www.oqoo.agency" />
    <meta name="Version" content="v1.0" />
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <!-- Slider -->
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
    <!-- Main Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="css/colors/default.css" rel="stylesheet" id="color-opt">
    <style>
        .row.row-broken {
            padding-bottom: 0;
        }
        .col-inside-lg {
            padding: 20px;
        }
        .chat {
            height: calc(100vh - 180px);
        }
        .decor-default {
            background-color: #ffffff;
        }
        .chat-users h6 {
            font-size: 20px;
            margin: 0 0 20px;
        }
        .chat-users .user {
            position: relative;
            padding: 0 0 0 50px;
            display: block;
            cursor: pointer;
            margin: 0 0 20px;
        }
        .chat-users .user .avatar {
            top: 0;
            left: 0;
        }
        .chat .avatar {
            width: 40px;
            height: 40px;
            position: absolute;
        }
        .chat .avatar img {
            display: block;
            border-radius: 20px;
            height: 100%;
        }
        .chat .avatar .status.off {
            border: 1px solid #5a5a5a;
            background: #ffffff;
        }
        .chat .avatar .status.online {
            background: #4caf50;
        }
        .chat .avatar .status.busy {
            background: #ffc107;
        }
        .chat .avatar .status.offline {
            background: #ed4e6e;
        }
        .chat-users .user .status {
            bottom: 0;
            left: 28px;
        }
        .chat .avatar .status {
            width: 10px;
            height: 10px;
            border-radius: 5px;
            position: absolute;
        }
        .chat-users .user .name {
            font-size: 14px;
            font-weight: bold;
            line-height: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .chat-users .user .mood {
            font: 200 14px/20px "Raleway", sans-serif;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /*****************CHAT BODY *******************/
        .chat-body h6 {
            font-size: 20px;
            margin: 0 0 20px;
        }
        .chat-body .answer.left {
            padding: 0 0 0 58px;
            text-align: left;
            float: left;
        }
        .chat-body .answer {
            position: relative;
            max-width: 600px;
            overflow: hidden;
            clear: both;
        }
        .chat-body .answer.left .avatar {
            left: 0;
        }
        .chat-body .answer .avatar {
            bottom: 36px;
        }
        .chat .avatar {
            width: 40px;
            height: 40px;
            position: absolute;
        }
        .chat .avatar img {
            display: block;
            border-radius: 20px;
            height: 100%;
        }
        .chat-body .answer .name {
            font-size: 14px;
            line-height: 36px;
        }
        .chat-body .answer.left .avatar .status {
            right: 4px;
        }
        .chat-body .answer .avatar .status {
            bottom: 0;
        }
        .chat-body .answer.left .text {
            background: #ebebeb;
            color: #333333;
            border-radius: 8px 8px 8px 0;
        }
        .chat-body .answer .text {
            padding: 12px;
            font-size: 16px;
            line-height: 26px;
            position: relative;
        }
        .chat-body .answer.left .text:before {
            left: -30px;
            border-right-color: #ebebeb;
            border-right-width: 12px;
        }
        .chat-body .answer .text:before {
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            border: 18px solid transparent;
            border-bottom-width: 0;
        }
        .chat-body .answer.left .time {
            padding-left: 12px;
            color: #333333;
        }
        .chat-body .answer .time {
            font-size: 16px;
            line-height: 36px;
            position: relative;
            padding-bottom: 1px;
        }
        /*RIGHT*/
        .chat-body .answer.right {
            padding: 0 58px 0 0;
            text-align: right;
            float: right;
        }

        .chat-body .answer.right .avatar {
            right: 0;
        }
        .chat-body .answer.right .avatar .status {
            left: 4px;
        }
        .chat-body .answer.right .text {
            background: #2F55D4;
            color: #ffffff;
            border-radius: 8px 8px 0 8px;
        }
        .chat-body .answer.right .text:before {
            right: -30px;
            border-left-color: #2F55D4;
            border-left-width: 12px;
        }
        .chat-body .answer.right .time {
            padding-right: 12px;
            color: #333333;
        }

        /**************ADD FORM ***************/
        .chat-body .answer-add {
            clear: both;
            position: relative;
            padding: 20px;
            background: #84A0C5;
        }
        .chat-body .answer-add input {
            border: none;
            background: none;
            display: block;
            width: 100%;
            font-size: 16px;
            line-height: 20px;
            padding: 0;
            color: #ffffff;
        }
        .chat input {
            -webkit-appearance: none;
            border-radius: 0;
        }
        .chat-body .answer-add .answer-btn-1 {
            /*background: url("http://91.234.35.26/iwiki-admin/v1.0.0/admin/img/icon-40.png") 50% 50% no-repeat;*/
            right: 20px;
        }
        .chat-body .answer-add .answer-btn {
            display: block;
            cursor: pointer;
            width: 26px;
            height: 26px;
            position: absolute;
            top: 50%;
            margin-top: -12px;
        }

        .chat input::-webkit-input-placeholder {
            color: #fff;
        }

        .chat input:-moz-placeholder { /* Firefox 18- */
            color: #fff;
        }

        .chat input::-moz-placeholder {  /* Firefox 19+ */
            color: #fff;
        }

        .chat input:-ms-input-placeholder {
            color: #fff;
        }
        .chat input {
            -webkit-appearance: none;
            border-radius: 0;
            outline: none;
        }

        #last {
            outline: none;
        }
    </style>
    </head>
    <body>
        <!-- Navbar STart -->
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <div>
                <a class="logo" href="/">
                    <img src="images/logo-dark.png" class="l-dark" height="60" alt="">
                    <img src="images/logo-light.png" class="l-light" height="60" alt="">
                </a>
            </div>
            <div class="buy-button">
                <form method="post">
                    <button class="btn btn-primary" name="deco"  type="submit">Disconnect</button>
                </form>
            </div><!--end login button-->
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu nav-light">
                    <li><a href=".\projet\index.php">Home</a></li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Service</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="redis.php">Redis</a> <a href="mysql.php">Mysql</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-submenu">
                        <a href="javascript:void(0)">About</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="index.php">CGU</a></li>
                        </ul>
                    </li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
    </header><!--end header-->
    <!-- Navbar End -->

    <!-- Hero Start -->
    <section class="bg-profile d-table w-100 bg-primary" style="background: url('images/account/bg.png') center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card public-profile border-0 rounded shadow" style="z-index: 1;">
                        <div class="card-body">
                                                        <div class="row align-items-center">
                                <div class="col-lg-2 col-md-3 text-md-left text-center">
                                    <img src="https://secure.gravatar.com/avatar/1d0fb275d8621552f58387779401d0a9" class="avatar avatar-large rounded-circle shadow d-block mx-auto" alt="">
                                </div><!--end col-->

                                <div class="col-lg-10 col-md-9">
                                    <div class="row align-items-end">
                                        <div class="col-md-7 text-md-left text-center mt-4 mt-sm-0">
                                            <h3 class="title mb-0"><?=$_SESSION['fname']?> <?=$_SESSION['sname']?></h3>
                                            <small class="text-muted h6 mr-2"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5d2d32312825252525256c1d3a303c3431733e3230"><?=$_SESSION['pseudo']?></a> - </small>
                                            <!--<ul class="list-inline mb-0 mt-3">
                                                <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-muted" title="Instagram"><i data-feather="instagram" class="fea icon-sm mr-2"></i>krista_joseph</a></li>
                                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted" title="Linkedin"><i data-feather="linkedin" class="fea icon-sm mr-2"></i>Krista Joseph</a></li>
                                            </ul>-->
                                        </div><!--end col-->
                                        <!--<div class="col-md-5 text-md-right text-center">
                                            <ul class="list-unstyled social-icon social mb-0 mt-4">
                                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Add Friend"><i data-feather="user-plus" class="fea icon-sm fea-social"></i></a></li>
                                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Messages"><i data-feather="message-circle" class="fea icon-sm fea-social"></i></a></li>
                                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Notifications"><i data-feather="bell" class="fea icon-sm fea-social"></i></a></li>
                                                <li class="list-inline-item"><a href="account-setting.html" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Settings"><i data-feather="tool" class="fea icon-sm fea-social"></i></a></li>
                                            </ul>
                                        </div>--><!--end col-->
                                    </div><!--end row-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--ed container-->
    </section><!--end section-->
    <!-- Hero End -->
                <!-- Profile Start -->
    <section class="section mt-60">
        <div class="container mt-lg-3">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 d-lg-block d-none">
                    <div class="sidebar sticky-bar p-4 rounded shadow">
                        <div class="widget">
                            <div class="row">
                                <div class="col-12 mt-4 pt-2">
                                    <div class="rounded d-block shadow text-center py-3">
                                        <form method="post">
                                        <span class="pro-icons h3 text-muted"><i data-feather="mail" class="fea icon-ex-md text-muted mr-3"></i></span>
                                        <h6 class="title text-dark h6 my-0">Ticket #<?=$mm['id']?></h6>
                                        <p class="text-muted">
                                            <?php if($mm['statu'] == 1){
                                                ?>Closed on <?php
                                                } else {
                                                    ?>Open on
                                                <?php
                                            }?>
                                            </p><p class="text-muted"><?=$mm['datee']?></p>
                                        <a href="/projet/profile/tickets/ticketts.php?id=<?=$mm['id']?>"
                                           type="button" name="close" class="btn btn-danger 
                                           <?php
                                            if($mm['statu'] == 1){
                                                ?>disabled<?php
                                            }?>
                                            <?php
                                            if(isset($_POST['close'])){
                                                ?>
                                                disabled
                                                <?php 
                                                $setMess = $bdd->prepare('UPDATE support SET statu = 1 WHERE id = ?');
                                                $setMess->execute(array($mm['id']));
                                            }?>
                                            "
                                           id="ticket-button">
                                            <i class="uil uil-comment-alt-slash"></i> Close
                                        </a>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6 mt-4 pt-2">
                                    <a href="../profile.php" class="accounts rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-dashboard"></i></span>
                                        <h6 class="title text-dark h6 my-0">Profil</h6>
                                    </a>
                                </div>

                                <div class="col-6 mt-4 pt-2">
                                    <a href="/tickets" class="accounts active rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-envelope-star"></i></span>
                                        <h6 class="title text-dark h6 my-0">Tickets</h6>
                                    </a>
                                </div><!--end col-->

                                <div class="col-6 mt-4 pt-2">
                                    <a href="service.php" class="accounts rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-setting"></i></span>
                                        <h6 class="title text-dark h6 my-0">Service</h6>
                                    </a>
                                </div><!--end col-->

                                
                                <div class="col-6 mt-4 pt-2">
                                    <a href="/logout" class="accounts rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-sign-out-alt"></i></span>
                                        <h6 class="title text-dark h6 my-0">Disconnect</h6>
                                    </a>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-lg-8 col-12 chat" style="overflow: hidden; outline: none;" tabindex="5001" id="chat">
                    <div class="col-inside-lg decor-default shadow">
                        <div class="chat-body">
                        <?php
$recupMessages = $bdd->prepare('SELECT * FROM message_ticket WHERE id = ?');
$recupMessages->execute(array($_GET['id']));
while($message = $recupMessages->fetch()){
    if($message['personne'] == 0){
        ?>
        <div class="answer right " >
        <div class="avatar">
            <img src="https://secure.gravatar.com/avatar/1d0fb275d8621552f58387779401d0a9" alt="User name">
        </div>
        <div class="name">
            <?=$_SESSION['sname']?>
            <?=$_SESSION['fname']?>
        </div>
        <div class="text"><?=$message['message']?></div>
        <div class="time"><?=$message['date']?></div>
    </div>
        <?php
    } elseif($message['personne'] == 1) {
        ?>
        <div class="answer left " >
        <div class="avatar">
            <img src="https://secure.gravatar.com/avatar/1d0fb275d8621552f58387779401d0a9" alt="User name">
        </div>
        <div class="name">
            Support
        </div>
        <div class="text"><?=$message['message']?></div>
        <div class="time"><?=$message['date']?></div>
    </div>
        <?php
    }
}
?>
                            <form method="post">
                                <div class="answer-add rounded">
                                <input placeholder="Ticket <?php 
                                            if($mm['statu'] == 1){
                                                ?>closed  <?php
                                                } else {
                                                    ?>opened
                                                <?php
                                            }?>" id="submitdata" name="submit_message" type="test">
                                <button class="answer-btn answer-btn-1" style="background: blue;border-color:blue;" id="submit" type="submit" name="submit"><svg style="fill: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M444.52 3.52L28.74 195.42c-47.97 22.39-31.98 92.75 19.19 92.75h175.91v175.91c0 51.17 70.36 67.17 92.75 19.19l191.9-415.78c15.99-38.39-25.59-79.97-63.97-63.97z"/></svg></button>
                                </div>
                            </form>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->

        <footer class="footer footer-bar">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="text-sm-left">
                        <p class="mb-0">© 2022 Oqoo - All rights reserved. Developed by <a href="https://matthieul.dev" target="_blank" class="text-reset">Matthieu Leboeuf</a>.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </footer><!--end footer-->
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="#" class="btn btn-icon btn-soft-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
    <!-- Back to top -->
    <!-- javascript -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <!-- SLIDER -->
    <script src="js/owl.carousel.min.js "></script>
    <script src="js/owl.init.js "></script>
    <!-- Icons -->
    <script src="js/feather.min.js"></script>
    <script src="https://unicons.iconscout.com/release/v2.1.9/script/monochrome/bundle.js"></script>
    <!-- Main Js -->
    <script src="js/app.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

    </body>
</html>
