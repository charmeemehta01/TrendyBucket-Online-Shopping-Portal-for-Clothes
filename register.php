<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TrendyBucket - Sign Up</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style type="text/css">
        .contact__content {
            text-align: center;
            margin-left: 390px;
            width: 70%;
        }
    </style>
</head>

<body>
    <script type="text/javascript" language="javascript">
        function validate() {
            var string1 = document.getElementById("pwd").value;
            var string2 = document.getElementById("rpwd").value;

            if (string1 == string2) {
                return true;
            }
            else {
                alert("Passwords do not match");
                return false;
            }
        }
    </script>

    <?php
        $unameErr='';
        $emailErr='';
        $mobErr='';
        $addErr='';
        $flag=0;
        $uname='';
        $mobno='';
        $address='';
        $email='';
        if(isset($_POST['submit'])){
            if(empty($_POST['name'])){
                $unameErr="Username required";
            }
            else{
                if(preg_match("/^[a-zA-Z0-9]/",$_POST['name']))
                {
             
                $flag+=1;
                }
                else
                {
                    $unameErr="Only alphabets and numbers";
                }
            }
            if(empty($_POST['mobno'])){
                $mobErr="Mobile required";
            }
            else{
                if(preg_match("/^[0-9]/",$_POST['mobno']))
                {
       
                $flag+=1;
                }
                else
                {
                    $mobErr="Only numbers";
                }
            }
            if(empty($_POST['address'])){
                $addErr="Address required";
            }
            else{
                if(preg_match("/^[a-zA-Z0-9]/",$_POST['address']))
                {

                $flag+=1;
                }
                else
                {
                    $addErr="Only alphabets and numbers";
                }
            }
            if(empty($_POST['email'])){
                $emailErr="Email is required";
            }
            else{
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $flag+=1;
            }
            else{
                $emailErr="Proper email is required";
            }
        }
        if($flag==4)
            {      		
                $acc_bal="10000";
                $cvv=rand(1000,9999);
                $mysqli=new mysqli('localhost','root','','trendybucket');
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                } 
                $uname=mysqli_real_escape_string($mysqli, $_POST['name']); 
                $email=mysqli_real_escape_string($mysqli, $_POST['email']);
                $password=mysqli_real_escape_string($mysqli, $_POST['pwd']);
                $address=mysqli_real_escape_string($mysqli, $_POST['address']);
                $stmt = $mysqli->prepare("SELECT Email FROM user_details WHERE Email = ? LIMIT 1");
                $stmt->bind_param('s',$email);
                $stmt->execute();
                $stmt->bind_result($email);
                $stmt->store_result();
                if($stmt->num_rows == 1)
                
                {
                    $addErr="User already exists ";
                }
                else{
                $balance=10000;
                $sql = $mysqli->prepare("INSERT INTO user_details (Name,Email,Account_Bal,Password,CVV,Address) VALUES (?,?,?,?,?,?)");
                $sql->bind_param("ssisis",$uname,$email,$balance,$password,$cvv,$address);
                if ($sql->execute()) {
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["acc_bal"] = $acc_bal;
                        $_SESSION["name"] = $uname;
                ?>
                    <script type="text/javascript">
                        alert("Your cvv is : <?php echo $cvv?>");
                        window.location.assign('index.php');
                    </script>
                <?php
                }
                else
                {
                    $addErr="Signup failed...
                    Click  <a href='Signup.html'>here</a> to go back to signup page";
                }
            }
        }  
        else
        {
            echo "connection failed ";
        }
        }
    ?>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo1.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo1.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="#">Women’s</a></li>
                            <li><a href="#">Men’s</a></li>
                            <li><a href="./shop.html">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./product-details.html">Product Details</a></li>
                                    <li><a href="./shop-cart.html">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <a href="login.php">Login</a>
                            <a href="register.php">Register</a>
                        </div>
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                            <li><a href="#"><span class="icon_bag_alt"></span>
                                    <div class="tip">2</div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__form">
                            <form name="myform" onsubmit="return validate()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                                enctype="multipart/form-data">
                                <h5>REGISTER</h5>
                                <table style="padding: 20px 10px;width: 400px; ">
                                    <tr>
                                        <td>
                                            Username:<br>
                                            <input type="text" name="name" placeholder="Atleast 3 characters" autofocus
                                                required><br> <span class="error"><?php echo $unameErr;?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email:<br>
                                            <input type="text" name="email" placeholder="Enter Email-ID"><br>
                                            <span class="error"><?php echo $emailErr;?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Password:<br>
                                            <input type="password" id="pwd" name="pwd" name="tracking-code"
                                                id="tracking-code" autocomplete="off" placeholder="Enter Password"
                                                required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Re-Enter Password:<br>
                                            <input type="password" id="rpwd" name="rpwd" name="tracking-code"
                                                id="tracking-code1" autocomplete="off" placeholder="Re-Enter Password"
                                                required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Mobile Number:<br>
                                            <input type="text" name="mobno" placeholder="Enter Phone Number"><br>
                                            <span class="error"><?php echo $mobErr;?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Address:<br>
                                            <textarea id='address' name='address' rows='2' cols='20' placeholder="Enter Address"></textarea>
                                            <span class="error"><?php echo $addErr;?></span>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>By creating an account you agree to our <a href="#"
                                                    style="color:dodgerblue;">Terms &
                                                    Privacy</a>.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="Submit" name="submit" class="site-btn">REGISTER</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Already have an account?
                                                <a href="login.php" style="color: #ff3385;">Login!</a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.html"><img src="img/logo1.png" alt=""></a>
                        </div>
                        <p>Your ultimate destination for fashion and lifestyle, being host to a wide array of
                            merchandise.</p>
                        <div class="footer__payment">
                            <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Account</h6>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Orders Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <!--<div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>-->
            </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>