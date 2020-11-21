<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TrendyBucket - Shop Cart</title>

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
</head>
<body>

<?php
session_start();
//unset($_SESSION["cart_item"]);
if(!empty($_GET["action"])) {
 $conn=mysqli_connect('localhost','root','','trendybucket') or die(mysqli_error());   
 $_SESSION['code_value'] = 0;
switch($_GET["action"]) {     
	case "add":                
        $str = $_GET["code"].'_quantity';
		if(!empty($_POST[$str])) {            
            //you get quantity (Select quantity) and compare, if $post[str]  > retrieved, throw err and send to men.php                                                    
			$res =mysqli_query($conn,"SELECT * FROM product WHERE code='" . $_GET["code"] . "'");            
            $productByCode = mysqli_fetch_assoc($res);    
            $revised_quantity = $productByCode["quantity"] - $_POST[$str];
            $res_temp = mysqli_query($conn,"UPDATE product set quantity=".$revised_quantity." WHERE code='" . $_GET["code"] . "'");    
			$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST[$str], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
            }
             else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	   break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {        
                
					if($_GET["code"] == $v["code"]) {                       
						unset($_SESSION["cart_item"][$k]);				
                    }
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	   break;
	case "empty":
		unset($_SESSION["cart_item"]);
	   break;	
    case "promo":
        $res =mysqli_query($conn,"SELECT * FROM coupon_code WHERE coupon_name='" . $_GET["promo"] . "'");
        $row = mysqli_fetch_assoc($res);
        if(!$row) {
            ?>
                <script>alert('Invalid code');</script>
            <?php
        }
        else {
            ?>
                <script>alert('Applied successfully')</script>
            <?php
            $_SESSION['code_value'] = $row["coupon_amt"];
        }
        break;
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
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo1.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
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
                            <li><a href="women.php">Women’s</a></li>
                            <li><a href="men.php">Men’s</a></li>
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
                            <a href="login.html">Login</a>
                            <a href="register.php">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            if(isset($_SESSION["cart_item"]))
                            {
                                $cart_price = 0;
                            foreach ($_SESSION["cart_item"] as $item){
                                $item_price = $item["quantity"]*$item["price"];
                                $total_quantity = 0;
                                $total_quantity += $item["quantity"];
                                $_SESSION["total_quantity"]=$total_quantity;
                                $total_price = 0;
                                $total_price += ($item["price"]*$item["quantity"]);
                                $cart_price += $total_price;
                                $_SESSION["total_price"]=$total_price;
                                        session_write_close();
                                ?>
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="<?php echo $item["image"];?>" style="max-width: 100px; max-height: 100px;" alt="">
                                        <div class="cart__product__item__title">
                                            <h6><?php echo $item["name"];?></h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price"><?php echo $item["price"];?></td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="<?php echo $item["quantity"];?>">
                                        </div>
                                    </td>
                                    <td class="cart__total"><?php echo $total_price;?></td>
                                    <td class="cart__close" onclick="window.location.href = 'shop-cart.php?action=remove&code=<?php echo $item['code']?>'"><span class="icon_close" ></span></td>
                                
                                    </tr>  <?php }} ?>                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="men.php">Continue Shopping</a>
                    </div>
                </div>              
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="shop-cart.php?action=promo">
                            <input type="hidden" name="action" value="promo"/>
                            <input type="text" name="promo" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span><?php echo $cart_price; ?></span></li>
                             <?php if($_SESSION['code_value'] > 0) { ?>                            
                                <li>Discount <span>-<?php echo $_SESSION['code_value']; ?></span></li> 
                                <?php
                                $cart_price -= $_SESSION['code_value'];
                            }
                            ?>
                            <li>Total <span><?php echo $cart_price; ?></span></li>
                        </ul>
                        <a href="checkout.php?cart_price=<?php echo $cart_price?>" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.html"><img src="img/logo1.png" alt=""></a>
                        </div>
                        <p>Your ultimate destination for fashion and lifestyle, being host to a wide array of merchandise.</p>
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
            </div>
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
    <!-- Discount -->
    <script>
    $("#apply").click(function(){
        if($('#promo_code').val()!=''){
            $.ajax({
                        type: "POST",
                        url: "checkout.php",
                        data:{
                            coupon_code: $('#coupon_code').val()
                        },
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                var after_apply=$('#total_price').val()-dataResult.value;
                                $('#total_price').val(after_apply);
                                $('#apply').hide();
                                $('#edit').show();
                                $('#message').html("Promocode applied successfully !");
                                
                            }
                            else if(dataResult.statusCode==201){
                                $('#message').html("Invalid promocode !");
                            }
                        }
            });
        }
        else{
            $('#message').html("Promocode can not be blank .Enter a Valid Promocode !");
        }
    });
    $("#edit").click(function(){
        $('#coupon_code').val("");
        $('#apply').show();
        $('#edit').hide();
        location.reload();
    });
</script>
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