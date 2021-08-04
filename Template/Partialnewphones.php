 <!-- New phones -->
 <?php
 
 shuffle($product_shuffle);

 // request method post
 if($_SERVER['REQUEST_METHOD'] == "POST"){
  if (isset($_POST['newphones_submit'])){
      //$_POST collect 'name' of input field(button)

      // call method addToCart
      // using object cart($cart) we can call addtocart function
      $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
      //$_POST is the post global variable where we pass name of input field
      // user_id and item_id are the 'name' of the input fields in the form
  }
}
 ?>
 <section id="new-phones">
      <div class="container">
        <h4 class="font-rubik font-size-20">New Phones</h4>
        <hr>

              <!-- owl carousel -->
              <div class="owl-carousel owl-theme">
              <?php
              foreach($product_shuffle as $item){
              ?>
              <div class="item py-2 bg-light">
                <div class="product font-rale">
                  <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? '../assests/products/1.png '; ?>" alt="product1" class="img-fluid"></a>
                  <div class="text-center">
                    <h6><?php echo $item['item_name'] ?? "Unknown"; ?> </h6>
                    <div class="rating text-warning font-size-12">
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="far fa-star"></i></span>
                    </div>
                    <div class="price py-2">
                      <span><?php echo $item['item_price'] ?? "0"; ?> </span>
                    </div>
                    <!-- <button type="submit" class="btn btn-warning font-size-12">Add to Cart</button> -->
                    <!-- we want to store user_id and item_id when click on this button
                     so we add form to this  -->
                    
                     <form  method="post">
                      <input type="hidden" name="user_id" value="<?php echo 1;?>">
                      <!-- value='1' is what we set in user table  -->
                      <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1';?>">
                      <!-- here value of item_id is come from database -->
                      
                      <!-- we dont want to display these input in UI therefore we choose type hidden
                    we just want to get data -->
                    <?php
                    //inarray function search that if we have 1st argument(itemid) in the 2nd arg(array) or alreay in the shopping cart
                      if (in_array($item['item_id'], $Cart->getCartId($product->getData('cart')) ?? [])){
                          echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                      }else{
                          echo '<button type="submit" name="newphones_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                      }
                      ?>
                    
                    </form>
                  </div>
                </div>

              </div>
              <?php } //closing foreach function ?>

              </div>
            <!-- !owl carousel -->

      </div>
</section>

    <!-- New phones -->