<?php
    //to avoid the error of header which already sent in cart.php on line70
    ob_start();
    // include header.php file
    include('./header.php');

?>
     
<?php
    // include partial banner area file
    include('Template/PartialBannerarea.php');

    // include partial Topsale file
    include('Template/PartialTopsale.php');

    // include partial Special price file
    include('Template/PartialSpecialprice.php');

    // include partial banner ads file
    include('Template/PartialBannerads.php');

    // include partial new phones file
    include('Template/Partialnewphones.php');

    // include partial latest blogs file
    include('Template/PartialLatestblogs.php');

?>     

<?php
    // include footer.php file
  include('./footer.php');

?>

