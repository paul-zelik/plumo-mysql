<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
if (isset($_POST['email']) AND !empty($_POST['password'])){
	$email = htmlspecialchars($_POST['email']);
	$mdp = sha1($_POST['password']);

	$recupUser = $bdd->prepare('SELECT * FROM espace_membres WHERE email = ? AND mdp = ?');
	$recupUser->execute(array($email,$mdp));

	if ($recupUser->rowCount() > 0){
		$_SESSION['pseudo'] = $email;
		$_SESSION['mdp'] = $mdp;
		$_SESSION['fname'] = $recupUser->fetch()['fname'];
        $_SESSION['sname'] = $recupUser->fetch()['sname'];
        $_SESSION['adress'] = $recupUser->fetch()['adress'];
        $_SESSION['pays'] = $recupUser->fetch()['pays'];
        $_SESSION['city'] = $recupUser->fetch()['city'];
        $_SESSION['postal'] = $recupUser->fetch()['postal'];
        $_SESSION['phone'] = $recupUser->fetch()['phone'];
		header('Location: ../profile/profile.php');
	} else {
        echo "mauvais mots de passe.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Login - Oqoo</title>
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
    <!-- Main Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="css/colors/default.css" rel="stylesheet" id="color-opt">
    </head>
    <body>
            <form method="post">
    <div class="back-to-home rounded d-none d-sm-block">
        <a href="index.html" class="btn btn-icon btn-soft-primary"><i data-feather="home" class="icons"></i></a>
    </div>

    <!-- Hero Start -->
    <section class="bg-home d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="mr-lg-5">
                        <img src="images/user/login.svg" class="img-fluid d-block mx-auto" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="card login-page bg-white shadow rounded border-0">
                        <div class="card-body">
                            <h4 class="card-title text-center">Login</h4>
                                                        <form class="login-form mt-4" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group position-relative">
                                            <label>Your email address<span class="text-danger">*</span></label>
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input type="email" class="form-control pl-5" placeholder="Email" name="email" required="" value="" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group position-relative">
                                            <label>Your password <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control pl-5" placeholder="Password" name="password" required="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="_remember_me" name="_remember_me">
                                                    <label class="custom-control-label" for="_remember_me">Remember me</label>
                                                </div>
                                            </div>
                                            </div>
                                            <p class="forgot-pass mb-0"><a href="auth-re-password.html" class="text-dark font-weight-bold">Forgot your password ?</a></p>
                                        </div>
                                    </div>

                                    <input type="hidden" name="_csrf_token"
                                           value="dc2.QldkzjTOYTPNeSQ5bJeehzp8y0VH4j6D7HNoSXx_mc8.GhJQ-3KnCUO5N05rG9amsEAarygIhVr3rwU-fR4Kw4oOIg34bIArQ6YvfQ"
                                    >

                                    <div class="col-lg-12 mb-0">
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                    <!--<div class="col-lg-12 mt-4 text-center">
                                        <h6>Or Login With</h6>
                                        <ul class="list-unstyled social-icon mb-0 mt-3">
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="github" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="gitlab" class="fea icon-sm fea-social"></i></a></li>
                                        </ul>
                                    </div>-->
                                    <div class="col-12 text-center">
                                        <p class="mb-0 mt-3"><small class="text-dark mr-2">Don't have an account ?</small> <a href="..\register\register.php" class="text-dark font-weight-bold">Sign up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!---->
                </div> <!--end col-->
            </div><!--end row-->
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- javascript -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <!-- Icons -->
    <script src="js/feather.min.js"></script>
    <script src="https://unicons.iconscout.com/release/v2.1.9/script/monochrome/bundle.js"></script>
    <!-- Main Js -->
    <script src="js/app.js"></script>
</form>
            </body>
</html>
