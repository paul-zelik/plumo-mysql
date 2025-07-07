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
if(isset($_POST['cree'])){
    $messages = $_POST['message'];
    $email = $_SESSION['pseudo'];
    $insertMessage = $bdd->prepare('INSERT INTO support(email, texet, datee, statu) VALUES(?, ?, NOW(), 0)');
    $insertMessage->execute(array($email, $messages));
    $recupID = $bdd->prepare('SELECT * FROM support WHERE email = ? ORDER BY ID DESC LIMIT 1');
    $recupID->execute(array($email));
    $user = $recupID->fetch();
    $insertMessages = $bdd->prepare('INSERT INTO message_ticket(id, email, message, date, personne) VALUES(?, ?, ?, NOW(), 0)');
    $insertMessages->execute(array($user['id'], $email, $messages));
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Tickets - Oqoo</title>
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
                    <li><a href="C:\Users\polux\OneDrive\Bureau\projet\index.html">Home</a></li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Service</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="C:\Users\polux\OneDrive\Bureau\projet\redis.html">Redis</a> <a href="C:\Users\polux\OneDrive\Bureau\projet\mysql.html">Mysql</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-submenu">
                        <a href="javascript:void(0)">About</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="C:\Users\polux\OneDrive\Bureau\projet\index.html">CGU</a></li>
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
                                            <h3 class="title mb-0">You</h3>
                                            <small class="text-muted h6 mr-2"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="384857544d404040404009785f55595154165b5755">[email&#160;protected]</a> - </small>
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
                                <div class="col-6 mt-4 pt-2">
                                    <a href="C:\Users\polux\OneDrive\Bureau\projet\profile\profile.html" class="accounts rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-dashboard"></i></span>
                                        <h6 class="title text-dark h6 my-0">Profil</h6>
                                    </a>
                                </div><!--end col-->

                                <div class="col-6 mt-4 pt-2">
                                    <a href="C:\Users\polux\OneDrive\Bureau\projet\profile\tickets\tickets.html" class="accounts active rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-envelope-star"></i></span>
                                        <h6 class="title text-dark h6 my-0">Tickets</h6>
                                    </a>
                                </div><!--end col-->

                                <div class="col-6 mt-4 pt-2">
                                    <a href="/projet/profile/tickets/service.php" class="accounts rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-setting"></i></span>
                                        <h6 class="title text-dark h6 my-0">Services</h6>
                                    </a>
                                </div><!--end col-->

                                <form method="post" class="col-6 mt-4 pt-2">
                                    <button name="deco" type="submit" style="border-color: #ffffff00;background-color: #ffffff;"class="accounts rounded d-block shadow text-center py-3">
                                        <span class="pro-icons h3 text-muted"><i class="uil uil-sign-out-alt"></i></span>
                                        <h6 class="title text-dark h6 my-0">Disconnect</h6>
                                    </button>
                                </form>
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-lg-8 col-12">
                    <div class="border-bottom pb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tickets:</h5>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#createticket" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus fea icon-sm"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Create</a>
                        
                        </div>
                        <?php
                            $bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
                            $recupMessage = $bdd->prepare('SELECT * FROM support WHERE email = :email');
                            $recupMessage->execute(array('email' => $_SESSION['pseudo']));
                            while($ticket = $recupMessage->fetch()){
                                ?>
                                <div class="media align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail fea icon-ex-md text-muted mr-3"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    <div class="media-body">
                                        <a href="http://localhost/projet/profile/tickets/ticketts.php?id=<?=$ticket['id']?>"><h6 class="text-danger mb-0">Ticket #<?= $ticket['id'];?></h6></a>
                                        <p class="text-muted"><?php if($ticket['statu']==0){echo"Ouvert le";}else{echo "Fermé le";}?> <?= $ticket['datee'];?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="createticket" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded shadow border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">New ticket</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group position-relative">
                                                        <label>You</label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user fea icon-sm icons"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                        <input name="name" id="name" type="text" class="form-control pl-5 disabled" value="<?=$_SESSION['pseudo'];?>">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-md-12">
                                                    <div class="form-group position-relative">
                                                        <label for="message">Ticket subject</label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book fea icon-sm icons"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                                        <input name="message" id="message" type="text" class="form-control pl-5" placeholder="Your subject">
                                                    </div>
                                                </div><!--end col-->
                                        </div><!--end row-->
                                        <div class="border-top p-4">
                                        <button type="submit" class="btn btn-primary" name="cree" id="ticket-button">Create</button>
                                    </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                                                    </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
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
    </body>
</html>
