<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
$type = $_GET['type'];
$niveau_type = $_GET['ntype'];
if(isset($id_machine)){
    $id_machine = $_GET['uuid'];
    $giveaddService = $bdd->prepare('UPDATE services SET fin_date = DATE_ADD(fin_date, INTERVAL 1 MONTH) WHERE id = ?');
    $giveaddService->execute(array($id_machine));
    echo "A jour";
} else {
    $giveService = $bdd->prepare('INSERT INTO services(email,type,create_date,fin_date,statu,type_type) VALUES(?,?,NOW(),DATE_ADD(NOW(), INTERVAL 1 MONTH),1,?)');
    $giveService->execute(array($_SESSION['pseudo'], $type, $niveau_type));
    $serviceGive = $bdd->prepare('CREATE DATABASE ?');
    $recupID = $bdd->prepare('SELECT * FROM servicies WHERE email = ? ORDER BY ID DESC LIMIT 1');
    $recupID->execute(array($email));
    $iiid = $recupID->rowCount();
    $name = 'Mysql' + $iiid;
    $serviceGive->execute(array($name));
    echo "ADD";
}
?>