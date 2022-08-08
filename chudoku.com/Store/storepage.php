<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
session_start();
require('../RequiredFile/timeout.php');
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
require('../RequiredFile/database.php');
$query=$con->prepare("select * from products where category='Figurines'");
$query->execute();
$query->bind_result($productid,$name,$description, $price, $units, $picture, $supplier, $category);
?>


</head>
<body style= "background-color: white">
<div id="warp">

<!--Top row-->
<?php 
if(isset($_SESSION["logged_in"]))
{
	if($_SESSION['type'] == "customer")
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
<div class="dropdown">
  <button class="dropbtn">Welcome <?php echo $_SESSION["name"]; ?></button>
  <div class="dropdown-content">
    <a href="../Profile/profile.php">Edit User Profile</a>
	<a href="../Profile/checkOrder.php">Check Orders</a>
    <a href="../Logout/logout.php">Logout</a>
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
<a href="../admin/admin.php">
<p>HOME</p></a>
<a href="../Store/storepage.php">
<p>STORE</p></a>
<a href="../Cart/cart.php">
<p>CART</p></a>
<div class="dropdown">
  <button class="dropbtn">Welcome <?php echo $_SESSION["name"]; ?></button>
  <div class="dropdown-content">
    <a href="../admin/addproducts.php">Add Products</a>
	<a href="../admin/editproducts.php">Edit Products</a>
	<a href="../admin/deleteproducts.php">Delete Products</a>
    <a href="../logout/logout.php">Logout</a>
  </div>
</div>
</div>
<?php 
}
}
else {
	?>
<img style=float:left src="Logo.png" width="300" height="75"/>
<a href="../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../store/storepage.php">
<p>STORE</p></a>
<a href="../Cart/cart.php">
<p>CART</p></a>
<a href="../Login/login.php">
<p>JOIN/SIGN IN</p></a>
<?php } ?>



<!--header picture-->
<img src="categories.png" height="300px" width="1300" style=float:center>
<!--categories-->
<ul>
	<li><a href="../store/figurines/figurines.php"><img src="figurine.jpg" height="400px" width="400px" style=margin-right:50px></a></li>
	<li><a href="../store/apparel/apparel.php"><img src="apparel.jpg" height="400px" width="400px" style=margin-right:50px></a></li>
	<li><a href="../store/cards/cards.php"><img src="card.jpg" height="400px" width="400px"></a></li>
</ul>	
</tr>
</table>
</div>
</body>
</html>