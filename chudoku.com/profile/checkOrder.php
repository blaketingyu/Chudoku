<?php
session_start();
?>
<html>
<link type="text/css", rel="stylesheet", href="stylesheet.css">
<?php
require('../RequiredFile/database.php');
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
	if($_SESSION['type'] == "admin")
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
    <a href="../Logout/logout.php">Logout</a>
  </div>
</div>
</div>
<?php 
}
?>
	
<!--Account Details-->
	<body>
		<div class="detailsheader">		
		<p align="center"><strong>Order Details<strong></p><hr>
		</div>
		
		<?php
		$user=$_SESSION["name"];
		$query=$con->prepare("select p.productID, p.Picture, o.orderID, o.orderDate, o.shipDate, o.timestamp, o.deliveryStatus from orders o INNER JOIN customers C ON o.customerID = c.customerID INNER JOIN orderdetails od on o.orderID = od.orderID INNER JOIN products p on od.productID = p.productID");
		$query->execute();
		$query->bind_result($productid,$picture,$orderid,$orderdate,$shipdate,$timestamp,$deliverystatus);
		echo "<div class = 'orderdetails'>";
		echo "<table align='center' width='400' height='200' border='1'>";
		echo "<tr>";
		echo "<th>Product ID</th>";
		echo "<th>Picture</th>";
		echo "<th>Order ID</th>";
		echo "<th>Order Date</th>";
		echo "<th>Ship Date</th>";
		echo "<th>Timestamp</th>";
		echo "<th>Delivery Status</th>";
		echo "</tr>";
	while($query->fetch())
	{
		echo "<tr>";
		echo "<td>".$productid."</td>";
		echo "<td><img src=".$picture." height=\"150px\" width=\"100px\"/></td>";
		echo "<td>".$orderid."</td>";
		echo "<td>".$orderdate."</td>";
		echo "<td>".$shipdate."</td>";
		echo "<td>".$timestamp."</td>";
		echo "<td>".$deliverystatus."</td>";
		echo "</tr>";	
	
	}
	echo "</div>";
	
		?>
		
<!--Update-->
		
		</body>



<?php
}
	else { 
header("Location: ../Login/login.php");
}
?>

</html>
