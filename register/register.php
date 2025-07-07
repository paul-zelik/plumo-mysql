<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
if (isset($_POST['envoi'])){
	$mail = htmlspecialchars($_POST['email']);
	$mdp = sha1($_POST['plainPassword']);
	$fname = htmlspecialchars($_POST['firstName']);
	$adress = htmlspecialchars($_POST['address']);
	$pays = htmlspecialchars($_POST['country']);
	$city = htmlspecialchars($_POST['town']);
	$postal = htmlspecialchars($_POST['postalCode']);
	$sname = htmlspecialchars($_POST['lastName']);
	$phone = htmlspecialchars($_POST['phoneNumber']);
	$insertUser = $bdd->prepare('INSERT INTO espace_membres(email, mdp, fname, sname, adress, pays, city, postal, phone, create_time)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
	$insertUser->execute(array($mail, $mdp, $fname, $sname, $adress, $pays, $city, $postal, $phone));

	$recupUser = $bdd->prepare('SELECT * FROM espace_membres WHERE email = ? AND mdp = ? AND fname = ? AND sname = ? AND adress = ? AND pays = ? AND city = ? AND postal = ? AND phone = ?');
	$recupUser->execute(array($mail, $mdp, $fname, $sname, $adress, $pays, $city, $postal, $phone));
	if($recupUser->rowCount() > 0){
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
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Register - Oqoo</title>
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
    <!-- Main css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="css/colors/default.css" rel="stylesheet" id="color-opt">
    </head>
    <body>
                <!-- Loader -->
    <!-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div> -->
    <!-- Loader -->
    <div class="back-to-home rounded d-none d-sm-block">
        <a href="index.html" class="btn btn-icon btn-soft-primary"><i data-feather="home" class="icons"></i></a>
    </div>

    <!-- Hero Start -->
    <section class="bg-home d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="mr-lg-5">
                        <img src="images/user/signup.svg" class="img-fluid d-block mx-auto" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="card login_page shadow rounded border-0">
                        <div class="card-body">
                            <h4 class="card-title text-center mt-5">Register</h4>
                                <form class="login-form mt-4" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Your first name <span class="text-danger">*</span></label>
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="First name" name="firstName" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Your last name <span class="text-danger">*</span></label>
                                            <i data-feather="user-check" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="Last name" name="lastName" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Your email address<span class="text-danger">*</span></label>
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input type="email" class="form-control pl-5" placeholder="Email" name="email" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Your password <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control pl-5" placeholder="Password" name="plainPassword" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Confirm password <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control pl-5" placeholder="Confirm password" name="plainPassword" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Phone number <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="Phone number" name="phoneNumber" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Address <span class="text-danger">*</span></label>
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="Address" name="address" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Postal code <span class="text-danger">*</span></label>
                                            <i data-feather="user-check" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="Postal code" name="postalCode" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>City <span class="text-danger">*</span></label>
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="City" name="town" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Country <span class="text-danger">*</span></label>
                                            <i data-feather="user-check" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="Country" name="country" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="agreeTerms">
                                                <label class="custom-control-label" for="customCheck1">I agree to the <a href="#" class="text-primary">terms and conditions</a></label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="registration_form__token" name="registration_form[_token]" value="68.IbGc_ZJMui-cLqVbeES3JRiLWUnpkywlnoeaBsdZ-A8.Yv_muNkW0FzLWf8PLn3UFXC8A2SR5H1rzPDQPvQtsjpQhsTM-n_QVdMXwg" />

                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block" type="submit" name="envoi">Register</button>
                                    </div>
                                    <!--
                                    <div class="col-lg-12 mt-4 text-center">
                                        <h6>Or Signup With</h6>
                                        <ul class="list-unstyled social-icon mb-0 mt-3">
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="github" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="gitlab" class="fea icon-sm fea-social"></i></a></li>
                                        </ul>
                                    </div>-->
                                    <div class="mx-auto">
                                        <p class="mb-0 mt-3"><small class="text-dark mr-2">Vous avez déja un compte ?</small> <a href="C:\espace_membres\polux\OneDrive\Bureau\projet\login" class="text-dark font-weight-bold">Login</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
            </body>
</html>
