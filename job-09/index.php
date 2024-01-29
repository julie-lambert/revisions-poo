<?php

require_once 'Product.php';
require_once 'Category.php';

//$category = new Category(1,'T-shirt',  'A beatiful T-shirt',  new DateTime(), new DateTime());
//$product1 = new Product(1,'T-shirt', ['https://picsum.photos/200/300'], 1000, 'A beatiful T-shirt', 10, new DateTime(), new DateTime(),1 );


$db = "mysql:host=localhost;dbname=draft-shop;";

$host = "root";

$password = "";

try {
        $db = new PDO($db, $host, $password);
        echo "connexion réussie";
    } catch (PDOException $e) {
            die('Erreur:' . $e->getMessage());
        }
        
$product = new Product(null,'Sarouel', ['https://picsum.photos/200/300'], 1000, 'A beatiful sarouel', 10, new DateTime(), new DateTime(),1);


$product -> setDb($db);


$product -> create();

var_dump($product);





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