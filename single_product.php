<?php 


include('server/connection.php');


if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);
    
    $stmt->execute();

    $product = $stmt->get_result();


}else{
    header('location: index.php');
}




?>




<?php include('layouts/header.php'); ?>


    <!--Single Product-->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
        
        <?php while($row = $product->fetch_assoc()){ ?>
           
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="/assets/imgs/<?php echo $row['product_image']; ?>" alt="" id="mainImg">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="/assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <h6>Men/Shoes</h6>
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2>$<?php echo $row['product_price']; ?></h2>
                <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                <input type="number" name="product_quantity" value="1">
                
                <button class="buy-btn" name="add_to_cart" type="submit">ADD TO CART</button></form> 
                <h4 class="my-5 ">Product details</h4>
                <span><?php echo $row['product_description']; ?>
                </span>
            </div>
            

            


        <?php } ?>
        </div>
    </section>


    <!--Related Products-->
    <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/featured1.png" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class ="p-name">Sports Shoes</h5>
                <h4 class ="p-price">$199.9</h4>
                <button class="buy-btn">BUY NOW</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/featured2.png" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class ="p-name">Sports Shoes</h5>
                <h4 class ="p-price">$199.9</h4>
                <button class="buy-btn">BUY NOW</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/featured3.png" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class ="p-name">Sports Shoes</h5>
                <h4 class ="p-price">$199.9</h4>
                <button class="buy-btn">BUY NOW</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/featured4.png" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class ="p-name">Sports Shoes</h5>
                <h4 class ="p-price">$199.9</h4>
                <button class="buy-btn">BUY NOW</button>
            </div>
        </div>
    </section>





    <script>
        var mainImg = document.getElementById('mainImg');
        var smallImg = document.getElementsByClassName('small-img');

        for(let i=0; i<smallImg.length; i++){
            smallImg[i].onclick = function(){
                mainImg.src = smallImg[i].src;
            }
        }

    </script>

<?php include('layouts/header.php'); ?>
