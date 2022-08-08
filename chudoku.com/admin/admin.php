<?php
session_start();
$SessionTimingBySecond = 600;
require('../RequiredFile/database.php');
require('../RequiredFile/timeout.php');
?>
<html>
<head>
<link type="text/css", rel="stylesheet", href="stylesheet.css"/>
</head>
<body>
<div id="warp">
<!-- Top Row -->

<?php
if(isset($_SESSION["logged_in"]))
{
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

<!-- picture -->
<div style="clear:both">
<img src="Japan.jpg" width="1300" height="300"/>
</div>
<a href="../profile/profile.php"><button style="font-family:raleway">Profile Page</button></a>
<h3 style="font-family:raleway;font-weight:400">For Admins to check on the editing profile page</h3></center>
<center><h3 style="font-family:raleway;font-weight:400">View Datas</h3></center>
<!-- button -->
<div class=admin>
<?php
		echo "<center><h2 style='font-family:raleway'>Customer Details</h2></center>";
		$query=$con->prepare("select * from customers where type='customer'");
		$query->execute();
		$query->bind_result($customerid,$nric,$firstname,$lastname,$email,$username,$password,$type);
		
echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>Customer ID</th>";
echo "<th>NRIC</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Email</th>";
echo "<th>Username</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<tr>";
	echo "<td>".$customerid."</td>";
	echo "<td>".$nric."</td>";
	echo "<td>".$firstname."</td>";
	echo "<td>".$lastname."</td>";
	echo "<td>".$email."</td>";
	echo "<td>".$username."</td>";
	echo "</tr>";	
	
}

echo "</table>";
echo "<div class='space'></div>";
echo "<center><h2 style='font-family:raleway'>Products Details</h2></center>";
$query=$con->prepare("select * from products ORDER BY category ASC");
$query->execute();
$query->bind_result($productid,$productname,$description,$unitsprice,$unitsinstore,$picture,$supplier,$category);
		
echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>Product ID</th>";
echo "<th>Product Name</th>";
echo "<th>Description</th>";
echo "<th>Units Price</th>";
echo "<th>Units In Store</th>";
echo "<th>Picture</th>";
echo "<th>Supplier</th>";
echo "<th>Category</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<tr>";
	echo "<td>".$productid."</td>";
	echo "<td>".$productname."</td>";
	echo "<td>".$description."</td>";
	echo "<td>".$unitsprice."</td>";
	echo "<td>".$unitsinstore."</td>";
	echo "<td><img src=".$picture." height=\"250px\" width=\"200px\"/></td>";
	echo "<td>".$supplier."</td>";
	echo "<td>".$category."</td>";
	echo "</tr>";	
	
}
echo "</table>";
		
echo "<div class='space'></div>";
echo "<center><h2 style='font-family:raleway'>Order Details</h2></center>";
$query=$con->prepare("select * from orders ORDER BY orderID ASC");
$query->execute();
$query->bind_result($orderid,$orderdate,$shipdate,$timestamp,$deliverystatus,$customerid);
		
echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>Order ID</th>";
echo "<th>Order Date</th>";
echo "<th>Ship Date</th>";
echo "<th>Time Stamp</th>";
echo "<th>Delivery Status</th>";
echo "<th>Customer ID</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<tr>";
	echo "<td>".$orderid."</td>";
	echo "<td>".$orderdate."</td>";
	echo "<td>".$shipdate."</td>";
	echo "<td>".$timestamp."</td>";
	echo "<td>".$deliverystatus."</td>";
	echo "<td>".$customerid."</td>";
	echo "</tr>";	
	
}
echo "</table>";	
		
echo "<div class='space'></div>";
echo "<center><h2 style='font-family:raleway'>Payment Details</h2></center>";
$query=$con->prepare("select * from payment ORDER BY paymentID ASC");
$query->execute();
$query->bind_result($paymentid,$paymenttype,$totalprice,$paymentdate,$transactionstatus,$orderid);
		
echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>Payment ID</th>";
echo "<th>Payment Type</th>";
echo "<th>Total Price</th>";
echo "<th>Transaction Status</th>";
echo "<th>Order ID</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<tr>";
	echo "<td>".$paymentid."</td>";
	echo "<td>".$paymenttype."</td>";
	echo "<td>".$totalprice."</td>";
	echo "<td>".$paymentdate."</td>";
	echo "<td>".$transactionstatus."</td>";
	echo "<td>".$orderid."</td>";
	echo "</tr>";	
	
}
echo "</table>";		
echo "<div class='space'></div>";		
}
else {
	?>
	<body onload=deny()></body>
	<?php
}
}
		
else
{ 
	header("Location: ../Login/login.php");
}

		
		?>

		
</div>



</div>
</body>
</html>
<script>
function deny() {
    alert("Access Denied!");
	window.location = '../homepage/homepage.php';
}
</script>