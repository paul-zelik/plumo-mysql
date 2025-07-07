<?php
 
$userDB      = 'root';
$passDB      = ' ';
$host        = 'localhost';
$nameDB      = 'devheberg';
 
//Recup de la variable postée vaudras faire d'autre verif hein
$name = $_POST["name"];
$message = $_POST["message"];
 
 
 
 
$bdd = new mysqli($host, $userDB, $passDB, $nameDB);

$req_pre = mysqli_prepare($bdd, 'INSERT INTO support(email, texet, datee, statu) VALUES(?, ?, NOW(), 0)');
           mysqli_stmt_bind_param($req_pre, "s", $name, $message);
 
           mysqli_stmt_execute($req_pre);
?>

<!-- $bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
if(isset($_POST['cree'])){
    $messages = htmlspecialchars($_POST['message']);
    $email = 'sqdqsd';
    $inssertMessage = $bdd->prepare('INSERT INTO support(email, texet, datee, statu) VALUES(?, ?, NOW(), 0)');
    $inssertMessage->execute(array($email, $message));
} -->