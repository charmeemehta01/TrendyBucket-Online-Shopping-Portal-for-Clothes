<?php
session_start();
?>
<HTML>
<HEAD>
<TITLE>SAM</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="style.css" type="text/css" rel="stylesheet" /> 
<style type="text/css">
		.logo-img{
    float: left;
    position: relative;
    margin: 0px 15px 0px 20px;
}
      .navbar{
        width: 100%;
        height: 70px;
        top:0;
                position: fixed;

        background:#6699cc;
      }
            ul{
        text-align: left;
        display: inline;
        margin: 0;
        padding: 0;
        list-style:none;
        padding: relative;
      }
      ul li
      {
        font:bold 12px/18px sans-serif;
        display:inline-block;
        position: relative;
        padding: 25px 20px;
        background: #6699cc; 
      }
      ul li a{
        text-decoration: none;
        padding: 25px 20px;
        color: white;
        font-size: 18px;
      }
        ul li:hover{
        background: #4dd0e1;
        color: white;
      }

      form.example input[type=text] {
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 200px;
  height:30px;
  margin-left: 40%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 40px;
  height:30px;
  background: #6699cc;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;


}

form.example button:hover {
  background: #4dd0e1;
  

}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</HEAD>
<BODY>
		<!-- search -->   
		<form class="example"  action="men.php" method="GET" style="margin-top:100px; " >
  			<input type="text" placeholder="Search" name="searchh">
  			<button type="submit" name="searchbtn"> <i class="fa fa-search"></i></button>
		</form>
<?php
	if(isset($_GET["searchbtn"]))
		{
			?>
		<div id="product-grid">
	<div class="txt-heading"></div>
	<?php
				$conn=mysqli_connect('localhost','root','','trendybucket') or die(mysqli_error());  
				$searchh=mysqli_real_escape_string($conn, $_GET['searchh']);
	$product_array = $db_handle->runQuery("SELECT * FROM menproduct WHERE name LIKE '%$searchh%' OR tags LIKE '%$searchh%' ORDER BY id ASC");
	if (!empty($product_array)) { 

		foreach($product_array as $key=>$value){

	?>
		<div class="product-item" align="center">
			<form method="post" action="shop-cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><a href="<?php echo $product_array[$key]["ref"]?>"><img class="imgcatalog" src ="<?php echo $product_array[$key]["image"]; ?>"></div></a>
			<div class="product-tile-footer">
			<div class="product-title"><a style="text-decoration:none;color: black" href="<?php echo $product_array[$key]["ref"]?>"><?php echo $product_array[$key]["name"]; ?></div></a>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
	
		}
		
	}

	?>
</div>
	<?php
}else{
	?>
<div id="product-grid">
	<div class="txt-heading"></div>
	<?php
	$product_array = "SELECT * FROM menproduct ORDER BY id ASC";
	if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){

                	


	?>
		<div class="product-item">
			<form method="post" action="shop-cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><a href="<?php echo $product_array[$key]["ref"]?>"><img class="imgcatalog" src ="<?php echo $product_array[$key]["image"]; ?>"></div></a>
			<div class="product-tile-footer">
			<div class="product-title"><a style="text-decoration:none;color: black" href="<?php echo $product_array[$key]["ref"]?>"><?php echo $product_array[$key]["name"]; ?></div></a>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
}
	?>
</div>
</BODY>
</HTML>



<?php
	// session_start();

	
	if(isset($_SESSION["email"]))
	{
		?>
			<script type="text/javascript">
				
				document.getElementsByClassName('out')[0].style.display="inline-block";
				document.getElementsByClassName('out')[1].style.display="inline-block";
				document.getElementsByClassName('in')[0].style.display="none";
				document.getElementsByClassName('in')[1].style.display="none";
			
			</script>
		<?php
	}
	else
	{
		?>
			<script type="text/javascript">
				document.getElementsByClassName('in')[0].style.display="inline-block";
				document.getElementsByClassName('in')[1].style.display="inline-block";
				document.getElementsByClassName('out')[0].style.display="none";
				document.getElementsByClassName('out')[1].style.display="none";
			</script>
		<?php
	}
?>

