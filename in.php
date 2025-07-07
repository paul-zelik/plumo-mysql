<?php
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
$test = $bdd->prepare('CREATE TABLE services
(
    id INT PRIMARY KEY NOT NULL,
    email TEXT,
    type INT,
    create_date DATETIME,
    statu INT,
);')
?>