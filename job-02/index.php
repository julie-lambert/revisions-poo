<?php

require_once 'Product.php';
require_once 'Category.php';



$category = new Category(1,'T-shirt',  'A beatiful T-shirt',  new DateTime(), new DateTime());
$product = new Product(1,'T-shirt', ['https://picsum.photos/200/300'], 1000, 'A beatiful T-shirt', 10, new DateTime(), new DateTime(),1 );

var_dump($product,$category);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job 02</title>
</head>
<body>
    
</body>
</html>