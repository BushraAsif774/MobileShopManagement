<?php

// require MySQL Connection
require ('database/dbcontrolller.php');

// require Product Class
require ('database/product.php');

// require Cart Class
 require ('database/Cart.php');



// DBController object
$db = new DBController();

// Product object    (class 'product' has made in product.php)
$product = new Product($db);
 $product_shuffle = $product->getData();
//print_r($product->getData()); //it gives all data of product in index.php file

// Cart object (class 'cart' made in cart.php)
$Cart = new Cart($db );
//        $arr= array(
//            "user_id" =>1, //user_id and item_id are the name of columns
//            "item_id"=> 4,
//            //these user_id and item_id are inserted in database in 'cart' table
//        );
//        $Cart->insertIntoCart($arr); //pass array which have userid and itemid
//        //insertintocard function made in card.php class
//get rid of all ofthese because we want user to inter values for 'cart' table

//print_r($Cart->getCartId($product->getData('cart')));
//it display array of the itemids of product we included in whislist
//and this statement used as the inarray argument in topsalesection inside form
