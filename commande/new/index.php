<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=devheberg;charset=utf8', 'root', ' ');
$id_product = $_GET['type'];
$niveau_type = $_GET['ntype'];
$recupProduct = $bdd->prepare('SELECT * FROM product WHERE type = ? AND niveau_type = ?');
$recupProduct->execute(array($id_product, $niveau_type));
$product = $recupProduct->fetch();
$price = $product['price']/100;
$type = $product['type'];
$niveau_type = $product['niveau_type'];
$discount = 0;
$total =  ($price * (12/10));
$tva = $total - $price;
if(isset($_POST['check'])){
  $code = $_POST['code'];
  $recupCode = $bdd->prepare('SELECT * FROM code WHERE code = ?');
  $recupCode->execute(array($code));
  if($codee = $recupCode->fetch()){
    $discount = $codee['promo'];
    $total = $total * (100-$discount)/100;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./style.css" rel="stylesheet">
    
</head>
<body>
    <div id="app">

        <!-- Header -->
        <header class="container">
          <h1>Shopping Cart</h1>
          <ul class="breadcrumb">
            <li>Home</li>
            <li>Shopping Cart</li>
          </ul>
          <span class="count">1 items in the bag</span>
        </header>
        <!-- End Header -->
      
        <!-- Product List -->
        <section class="container">
          <div v-if="products.length > 0">
            <ul class="products">
            <li class="row" v-for="(product, index) in products">
              <div class="col left">
                <div class="thumbnail">
                  <a href="#">
                  </a>
                </div>
                <div class="detail">
                  <div class="name"><a href="#">Base <?=$type?></a></div>
                  <div class="price"><?=$price?> $</div>
                </div>
              </div>
      
              <div class="col right">

                <div class="remove">
                  <a href="../../index.php"><svg version="1.1" class="close" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polygon points="38.936,23.561 36.814,21.439 30.562,27.691 24.311,21.439 22.189,23.561 28.441,29.812 22.189,36.064 24.311,38.186 30.562,31.934 36.814,38.186 38.936,36.064 32.684,29.812"></polygon></svg></a>
                </div>
              </div>
            </li>
          </ul>
          </div>
          <div v-else class="empty-product">
            <h3>There are no products in your cart.</h3>
            <button>Shopping now</button>
          </div>
        </section>
        <!-- End Product List -->
        
        <!-- Summary -->
        <section class="container" v-if="products.length > 0">
        <form method="post">  
        <div class="promotion">
            
            <label for="promo-code">Have A Promo Code?</label>
            <input type="text" id="promo-code" name="code" v-model="promoCode" /> <button type="submit" name="check"></button>
          
          </div>
          </form>
      
          <div class="summary">
            <ul>
              <li>Subtotal <span><?=$price?> $</span></li>
              <li v-if="discount > 0">Discount <span><?=$discount?> %</span></li>
              <li>Tax <span><?=$tva?> $</span></li>
              <li class="total">Total <span><?= $total?> $</span></li>
            </ul>
          </div>
      
          <div class="checkout"id="paypal-payment-button">
          </div>
          <script src="https://www.paypal.com/sdk/js?client-id=ATd4KU4_p5THB7nuHq-fKZ8qzCGFEFVfIjkTTa4gSDlu1F_F6Wd2IdyLLwdxFalzT6D05ZvE2E8QMNe5&currency=EUR"></script>
          <script>
      paypal.Buttons({
    style: {
        color: 'blue'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '0.01'
                }
            }]
        });
    },
    onApprove: function(data, actions) {

        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            console.log(details);
            
            $.ajax({
                url: 'code.php',
                data: {
                    id: <?=$type?>,
                    ntype: <?=$niveau_type?>,
                    uuid: <?=$_GET['uuid']?>
                },
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    window.location.replace("../../profile/profile.php");
                },
                error: function() {
                    console.log('Erreur lors de la requête. Statut ');
                }
            });
        });
    }
}).render('#paypal-payment-button');

    </script>
        </section>
        <!-- End Summary -->
      </div>
</body>
</html>


