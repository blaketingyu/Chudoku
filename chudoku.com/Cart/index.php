<?php
	session_start();
	require("connection.php");
	if(isset($_GET['page'])) {
		$pages=array("products","cart");
		if(in_array($_GET['page'],$pages)) {
			$_page=$_GET['page'];
		}else{
			$_pages="products";
		}
	}else{
		$_page="products";
	}
?>

<html>
<head> 
<link type="text/css", rel="stylesheet", href="cart.css"/> 
<div id="warp">
<!-- Top Row -->

<?php
if(isset($_SESSION["logged_in"]))
{
?>
<div class="smaller">
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../Store/storepage.php">
<p>STORE</p></a>
<a href="../Cart/cart.php">
<p>CART</p></a>
<p><?php echo " Welcome " . $_SESSION["name"]; ?> </p>
<a href="logout.php">logout</a>
</div>
<?php
}
else
{
?>
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../store/storepage.php">
<p>STORE</p></a>
<a href="../Cart/cart.php">
<p>CART</p></a>
<a href="../Login/login.php">
<p>JOIN/SIGN IN</p></a>
<?php
}
?>
<br></br>  
<title>Shopping Cart</title>  
  
</head> 
  
<body> 
      
    <div id="container"> 
  
        <div id="main"> 
              
            <?php require($_page.".php"); ?> 
  
        </div><!--end of main--> 
          
        <div id="sidebar"> 
              
        </div><!--end of sidebar--> 
  
    </div><!--end container--> 
  
</body> 
<h1>Cart</h1> 
<?php 
  
    if(isset($_SESSION['cart'])){ 
          
        $sql="SELECT * FROM products WHERE productID IN ( "; 
          
        foreach($_SESSION['cart'] as $id => $value) { 
            $sql.=$id.","; 
        } 
          
        $sql=substr($sql, 0, -1).")";
			echo $sql;
        $query=mysqli_query($connect,$sql); 
			//echo $query;
        while($row=mysqli_fetch_array($query)){ 
              
        ?> 
            <p style=font-size:20px;><?php echo $row['productName'] ?> x <?php echo $_SESSION['cart'][$row['productID']]['quantity'] ?></p> 
        <?php 
              
        } 
    ?> 
        <hr />	
        <a href="index.php?page=cart">Go to cart</a> 
    <?php 
          
    }else{ 
          
        echo "<p>Your Cart is empty. Please add some products.</p>"; 
          
    } 
  
?>
</html>