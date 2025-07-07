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
$id = $_GET['id'];
$recupService = $bdd->prepare('SELECT * FROM services WHERE id = ?');
$recupService->execute(array($id));
$servcie = $recupService->fetch();
$type = $servcie['type'];
if($_SESSION['pseudo'] != $servcie['email']){
    header('Location: service.php');
}
$recupPrice = $bdd->prepare('SELECT * FROM product WHERE type = ? AND niveau_type = ?');
$recupPrice->execute(array($type, $servcie['type_type']));
$valprice = $recupPrice->fetch();
$price = $valprice['price']/100
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?=$type?> # <?=$id?> - SpeedHeberg</title>
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

        .bordered-section .mt-3 .service-details {
            -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    --blue: #3891F2;
    --indigo: #6610f2;
    --purple: #7C69CD;
    --pink: #e83e8c;
    --red: #D9252E;
    --orange: #fd7e14;
    --yellow: #F6BB42;
    --green: #2DC76B;
    --teal: #20c997;
    --cyan: #17a2b8;
    --white: #fff;
    --gray: #6c757d;
    --gray-dark: #343a40;
    --primary: #5f27cd;
    --secondary: #8395a7;
    --success: #1dd1a1;
    --info: #5f27cd;
    --warning: #feca57;
    --danger: #ff6b6b;
    --light: #f8f9fa;
    --dark: #343a40;
    --default: #ced4da;
    --breakpoint-xs: 0;
    --breakpoint-sm: 544px;
    --breakpoint-md: 768px;
    --breakpoint-lg: 992px;
    --breakpoint-xl: 1200px;
    --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    --fa-style-family-brands: "Font Awesome 6 Brands";
    --fa-font-brands: normal 400 1em/1 "Font Awesome 6 Brands";
    --fa-style-family-duotone: "Font Awesome 6 Duotone";
    --fa-font-duotone: normal 900 1em/1 "Font Awesome 6 Duotone";
    --fa-font-light: normal 300 1em/1 "Font Awesome 6 Pro";
    --fa-font-regular: normal 400 1em/1 "Font Awesome 6 Pro";
    --fa-font-solid: normal 900 1em/1 "Font Awesome 6 Pro";
    --fa-style-family-classic: "Font Awesome 6 Pro";
    --fa-font-thin: normal 100 1em/1 "Font Awesome 6 Pro";
    --fa-font-sharp-solid: normal 900 1em/1 "Font Awesome 6 Sharp";
    --fa-font-sharp-regular: normal 400 1em/1 "Font Awesome 6 Sharp";
    --fa-style-family-sharp: "Font Awesome 6 Sharp";
    --fa-font-sharp-light: normal 300 1em/1 "Font Awesome 6 Sharp";
    font-family: "Inter", Arial, sans-serif !important;
    line-height: 1.45;
    color: #373a3c;
    text-align: left;
    font-size: 1rem;
    font-weight: 500;
    word-wrap: break-word;
    box-sizing: border-box;
    margin-top: 1rem !important;
    border: 0.07rem solid #EBECF0;
    border-radius: 6px;
    display: flex;
    flex-wrap: wrap;
    overflow: hidden;

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
                                        
                                        <h6 class="title text-dark h6 my-0"><?=$type?> #<?=$servcie['id']?></h6>
                                        </p><p class="text-muted">Fin le <?=$servcie['fin_date']?></p>
                                        <a href="/projet/profile/tickets/ticketts.php?id=" type="button" name="close" class="btn btn-danger" id="ticket-button">
                                            <i class="uil uil-comment-alt-slash"></i> Prolonger
                                        </a>
                                        <?php
                                        if ($type == 'Mysql') {
                                            ?>
                                            <a href="/phpmyadmin" type="button" name="close" class="btn btn-danger" id="ticket-button">
                                            <i class="uil uil-comment-alt-slash"></i> PhpMyAdmin
                                            </a>
                                            <?php
                                        } elseif ($type == 'Bot') {
                                            ?>
                                            <a href="/phpmyadmin" type="button" name="close" class="btn btn-danger" id="ticket-button">
                                            <i class="uil uil-comment-alt-slash"></i> Panel
                                            </a>
                                            <?php
                                        } elseif ($type == 'Web') {
                                            ?>
                                            <a href="/phpmyadmin" type="button" name="close" class="btn btn-danger" id="ticket-button">
                                            <i class="uil uil-comment-alt-slash"></i> CPanel
                                            </a>
                                            <?php
                                        } else {
                                            
                                        }
                                        ?>
                                        
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

                <!-- //////////////////////////////////////////////// -->

                <div class="col-lg-8 col-12 chat" style="overflow: hidden; outline: none;" tabindex="5001" id="chat">
                    <div class="col-inside-lg decor-default shadow">

                        <div class="rounded d-block shadow text-center py-3" style="background-color: #2f55d4;background-image: '/images/account/bd.png';">
                        <br>
                        <h2 class="title text-light h6 my-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="20" height="20"><circle cx="100" cy="100" r="80" fill="
                        <?php
                        if($servcie['statu'] == 1) {
                            ?>
                            green
                            <?php
                        } else {
                            ?>
                            red
                            <?php
                        }
                        ?>" /></svg> <?=$type?> #<?=$servcie['id']?></h2>
                        <br>
                        </div>
                        <br>
                        <div class="rounded d-block shadow text-center py-3">
                            <h2 class="title text-dark h6 my-0" style="text-align: left;padding-left: 25px;">Détails du service :</h2>
                            <section class="bordered-section mt-3 service-details" style="display: flex;align-items: center;">     
                                <div class="service-details-line p-4">
                                    <small class="d-block font-weight-bold mb-2">Domaine</small>
                                    <a href="http://arcazia.fr" target="_blank">
                                        <span class="text-small break-word" data-title="arcazia.fr"><?=$type?></span>

                                    </a>
                                </div>
                                <div class="service-details-line p-4">
                                        <small class="d-block font-weight-bold mb-2">Date d'enregistrement</small>
                                        <span class="text-small break-word"><?=$servcie['create_date']?></span>
                                </div>
                                <div class="service-details-line p-4">
                                        <small class="d-block font-weight-bold mb-2">Cycle de facturation</small>
                                        <span class="text-small break-word"><?=$price?> $</span>
                                </div>
                                <div class="service-details-line p-4">
                                        <small class="d-block font-weight-bold mb-2">Fin le</small>
                                        <span class="text-small break-word"><?=$servcie['fin_date']?></span>
                                </div>
                            </section>
                            <br>
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
