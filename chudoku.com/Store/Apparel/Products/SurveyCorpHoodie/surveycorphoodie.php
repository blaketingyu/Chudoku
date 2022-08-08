<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body style= "background-color: white">
<div id="warp">

<!--Top row-->
<?php
session_start();
require('../../../../RequiredFile/timeout.php');
if(isset($_SESSION['time']))
{
	if((time() - $_SESSION['time']) > $SessionTimingBySecond)
	{
		session_unset();
	}
	else
	{
		$_SESSION['time'] = time();
	}
}
require('../../../../RequiredFile/database.php');
$query=$con->prepare("select * from products where productName='Survey Corp Hoodie (Attack on Titan)'");
$query->execute();
$query->bind_result($productid,$name,$description, $price, $units, $picture, $supplier, $category);
?>

<?php 
if(isset($_SESSION["logged_in"]))
{
	if($_SESSION['type'] == "customer")
{
?>
<div class="smaller">
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../../../../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../../../../Store/storepage.php">
<p>STORE</p></a>
<a href="../../../../Cart/cart.php">
<p>CART</p></a>
<div class="dropdown">
  <button class="dropbtn">Welcome <?php echo $_SESSION["name"]; ?></button>
  <div class="dropdown-content">
    <a href="../../../../Profile/profile.php">Edit User Profile</a>
	<a href="../../../../Profile/checkOrder.php">Check Orders</a>
    <a href="../../../../Logout/logout.php">Logout</a>
  </div>
</div>
</div>
<?php
}
else if($_SESSION['type'] == "admin")
{
	?>
<div class="smaller">
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../../../../admin/admin.php">
<p>HOME</p></a>
<a href="../../../../Store/storepage.php">
<p>STORE</p></a>
<a href="../../../../Cart/cart.php">
<p>CART</p></a>
<div class="dropdown">
  <button class="dropbtn">Welcome <?php echo $_SESSION["name"]; ?></button>
  <div class="dropdown-content">
    <a href="../../../../admin/addproducts.php">Add Products</a>
	<a href="../../../../admin/editproducts.php">Edit Products</a>
	<a href="../../../../admin/deleteproducts.php">Delete Products</a>
    <a href="../../../../logout/logout.php">Logout</a>
  </div>
</div>
</div>
<?php 
}
}
else {
	?>
<img style=float:left src="Logo.png" width="300" height="75"/>
<a href="../../../../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../../../../store/storepage.php">
<p>STORE</p></a>
<a href="../../../../Cart/cart.php">
<p>CART</p></a>
<a href="../../../../Login/login.php">
<p>JOIN/SIGN IN</p></a>
<?php } ?>

<!--header picture-->
<img src="header.jpg" height="300px" width="1300" style=float:center>

<!--Current Directory-->
<div id="">
<a href="../../../../Homepage/Homepage.php">
<h2>Home</h2></a><h2>></h2>
<a href="../../../../store/storepage.php">
<h2>Store</h2></a><h2>></h2>
<a href="../../apparel.php">
<h2>Apparels</h2></a><h2>></h2>
</div>
<?php 
while($query->fetch()){
$text = $name;
$text = preg_replace("/\([^)]+\)/","",$text);
$text = str_replace(array(' '), '', $text);
echo "<a href=\"/chudoku.com/store/apparel/products/".$text."/".$text.".php\">";
echo "<h2>".$name."</h2></a>";
?>
</div>
<div id="container">
<div class="center">
	<?php
echo "<a href=\"/chudoku.com/store/apparel/products/".$text."/".$text.".jpg\"><img src=\"/chudoku.com/store/apparel/products/".$text."/".$text.".jpg\" width=\"400px\" height=\"600px\"></a>";
}
?>
</div>
</div>
	<div class="right">
		<h1 style="font-family: Raleway"><?php echo "$name" ?></h1>
		<p style="font-family: Raleway;color:#805454;font-size:30px"><strong>$<?php echo "$price" ?><strong> </p>
		<a href="../../../../Cart/cart.php"><button type="button" style="font-family: Raleway;font-size:18px"><strong>ADD TO CART</strong></button></a>
		<img src="wishlist.png" width="65px" height="65px" hspace="50"/>
		<div class="description">
		<p style="font-family:Raleway;font-size:12px"><?php echo "$description" ?>
		</p>
		</div>
	</div> 
	
	


</div>
</body>
</html>