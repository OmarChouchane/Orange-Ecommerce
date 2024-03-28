<?php


session_start();


include 'server/connection.php';



//if user is already logged in
if(isset($_SESSION['logged_in'])){

    header('location: account.php');
    exit();

}



// if user is not logged in
if(isset($_POST['login_btn'])){


    $email = $_POST['email'];
    $password = md5($_POST['password']);


    // retrieve user info from the database
    $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1"); 
    $stmt->bind_param('ss', $email,$password);    


    // If the query is successful
    if($stmt->execute()){ 

        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();


        // if account exists
        if($stmt->num_rows() == 1){

            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login=You logged in successfully');


        
        // if account does not exist
        }else{

            header('location: login.php?error=invalid email or password');

        }


    // If the query is not successful
    }else{

        header('location: login.php?error=something went wrong, try again later');

    }



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
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.html">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <i class="fa fa-shopping-cart"></i>                
                    <i class="fa fa-user"></i>
                </li>
                </ul>
            </div>
            </div>
    </nav>



    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weihggt-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" action="login.php" method="POST">
                <?php if(isset($_GET['error'])){?>
                    <p style="color: red;"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" value="Login" name="login_btn">
                </div>
                <div class="form-group">
                    <a id="register-url" class="btn" href="register.php">Don't have an account ? Register</a>
                </div>
            </form>
        </div>
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