<?php

// require_once 'Product.php';
require_once 'Electronic.php';
require_once 'Clothing.php';
require_once 'Category.php';

//$category = new Category(1,'T-shirt',  'A beatiful T-shirt',  new DateTime(), new DateTime());
//$product1 = new Product(1,'T-shirt', ['https://picsum.photos/200/300'], 1000, 'A beatiful T-shirt', 10, new DateTime(), new DateTime(),1 );


$electronic = new Electronic();
$clothing = new Clothing();

// findOneById -------------------------
// $newClothing = $clothing->findOneById(1);
// $newElectronic = $electronic->findOneById(3);

// findAll -------------------------
// $newClothing = $clothing->findAll();
// $newElectronic = $electronic->findAll();

// create -------------------------
// $clothing->create();
// $electronic->create();

// update -------------------------
// $clothing->update();
// $electronic->update();


// var_dump($newClothing);
// var_dump($newElectronic);




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job 06</title>
</head>
<body>
    
</body>
</html>