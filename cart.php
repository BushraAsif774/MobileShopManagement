<?php
    ob_start(); //to avoid header already already send when we reload
    // include header.php file
    include('header.php')

?>

<?php
    /*  include cart items if it is not empty */
    count($product->getData('cart')) ? include ('Template/PartialShoppingcart.php') :  include ('Template/notfound/cart_notfound.php');
    /*  include cart items if it is not empty */

     /*  include top sale section */
     count($product->getData('wishlist')) ? include ('Template/wishlist_temp.php') :  include ('Template/notfound/wishlist-notfound.php');
     /*  include top sale section */


    
    

    // include partial new phones file
    include('Template/Partialnewphones.php');

    

?>  

<?php
    // include header.php file
   include('footer.php')

?>