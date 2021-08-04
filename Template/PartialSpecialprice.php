 <!-- Special Price -->
 <?php
  $brand = array_map(function ($pro){ return $pro['item_brand']; }, $product_shuffle);
  $unique = array_unique($brand);
  sort($unique);
  shuffle($product_shuffle);

  // request method post
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['special_price_submit'])){
        //$_POST collect 'name' of input field(button)

        // call method addToCart
        // using object cart($cart) we can call addtocart function
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
        //$_POST is the post global variable where we pass name of input field
        // user_id and item_id are the 'name' of the input fields in the form
    }
  }
  $in_cart = $Cart->getCartId($product->getData('cart'));

 ?>
 <section id="special-price">
        <div class="container ">
          <h4 class="font-rubik font-size-20">Special Price</h4>
          <hr>
          <div id="filters" class="button-group text-right font-baloo font-size-16">
            <button class="btn is-checked" data-filter="*">All Brand</button>
            <?php
                array_map(function ($brand){
                    printf('<button class="btn" data-filter=".%s">%s</button>', $brand, $brand);
                }, $unique);
            ?>
            
          </div>

          <div class="grid">
          <?php array_map(function($item) use($in_cart){ 
            ?>
            <div class="grid-item border <?php echo $item['item_brand'] ?? 'Brand'; ?>">              
             <div class="item py-2 " style="width: 170px;">
              <div class="product font-rale ">
                <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? './assests/products/13.png'; ?>" alt="product1" class="img-fluid"></a>
                <div class="text-center">
                  <h6><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                  <div class="rating text-warning font-size-12">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                  </div>
                  <div class="price py-2">
                    <span><?php echo $item['item_price'] ?? "0"; ?></span>
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
                      if (in_array($item['item_id'],$in_cart ??[] )){
                          echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                      }else{
                          echo '<button type="submit" name="special_price_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                      }
                      ?>
                    
                    </form>
                </div>
              </div>
             </div>
            </div>
            <?php },$product_shuffle) ?>
            </div>  
        </div>
      </section>
    <!-- !Special Price -->