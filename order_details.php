<?php

include 'server/connection.php';

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

}else{
    header('location: account.php');
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>The North Face</title>
    <link rel="icon" href="/assets/imgs/logo2.png" type="image/x-icon">
</head>
<body>
    

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <img class="logo" src="assets/imgs/logo1.png">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
            <li class="nav-item "> 
                <a href="cart.html"><i class="fa fa-shopping-cart"></i></a>            
                <a href="account.html"><i class="fa fa-user"></i></a>
            </li>
            </ul>
        </div>
        </div>
    </nav>





    <!--Orders Details-->
    <section id="orders" class="orders container my-5 py-5" class="">
        <div class="container text-center mt-5">
            <h2 class="font-weight-bold">Order Details</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>


            <?php while($row = $order_details->fetch_assoc()){?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="/assets/imgs/<?php echo $row['product_image'];?>" alt="">
                        <div>
                            <p class="mt-3"><?php echo $row['product_name'];?></p>
                        </div>
                    </div>
                </td>

                <td>$<span><?php echo $row['product_price'];?></span></td>
                <td><span class="product-quantity"><?php echo $row['product_quantity'];?></span></td>

            </tr>

            <?php }?>

        </table>

    </section>





    <!--Footer-->
    <footer class="mt-5 pt-5">
            <div class="row container mx-auto pt-5">
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <img src="assets/imgs/logo2.png" class="logo2" alt="">
                    <p class="pt-3">We provide the best products the  most affordable prices</p>
                    <img class="logo3" src="/assets/imgs/logo3.png">
                <img class="logo3" src="/assets/imgs/logo4.png">
                </div>
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Featured</h5>
                    <ul>
                        <li><a href="#">men</a></li>
                        <li><a href="#">women</a></li>
                        <li><a href="#">boys</a></li>
                        <li><a href="#">girls</a></li>
                        <li><a href="#">new arrivals</a></li>
                        <li><a href="#">clothes</a></li>
                    </ul>
                </div>
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Contact Us</h5>
                    <div>
                        <h6>Address</h6>
                        <p>1234 Street Name, City</p>
                    </div>
                    <div>
                        <h6>Phone</h6>
                        <p>12 345 678</p>
                    </div>
                    <div>
                        <h6>Email</h6>
                        <p>contact@gmail.com</p>
                    </div>
                </div>
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Products</h5>
                    <div class="row">
                        <ul>
                            <li><a href="#">shoes</a></li>
                            <li><a href="#">watches</a></li>
                            <li><a href="#">coats</a></li>
                            <li><a href="#">dresses</a></li>
                            <li><a href="#">bags</a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
    
    
            <div class="copyright mt-5">
                <div class="row container mx-auto text-center">
                        <p>eCommerce @ 2025 All Rights Reserves</p>
                </div>
            </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>
</html>