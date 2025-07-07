<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
$recupMessage = $bdd->prepare('SELECT * FROM support WHERE id = ?');
$recupMessage->execute(array($_GET['id']));
$mm = $recupMessage->fetch();
$recupMessages = $bdd->prepare('SELECT * FROM message_ticket WHERE id = ?');
$recupMessages->execute(array($_GET['id']));
$ms = $recupMessages->fetch();
?>

<?php
while($ms = $recupMessages->fetch()){
    if($ms['personne'] = 0){
        ?>
        <div class="answer left " >
        <div class="avatar">
            <img src="https://secure.gravatar.com/avatar/1d0fb275d8621552f58387779401d0a9" alt="User name">
        </div>
        <div class="name">
            <?=$_SESSION['sname']?>
            <?=$_SESSION['fname']?>
        </div>
        <div class="text"><?=$ms['message']?></div>
        <div class="time"><?=$ms['date']?></div>
    </div>
        <?php
    } else {
        ?>
        <div class="answer right " >
        <div class="avatar">
            <img src="https://secure.gravatar.com/avatar/1d0fb275d8621552f58387779401d0a9" alt="User name">
        </div>
        <div class="name">
            Support
        </div>
        <div class="text"><?=$ms['message']?></div>
        <div class="time"><?=$ms['date']?></div>
    </div>
        <?php
    }
}
?>