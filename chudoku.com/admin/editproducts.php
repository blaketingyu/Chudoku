<?php
session_start();
require('../RequiredFile/timeout.php');
require('../RequiredFile/database.php');
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
	$_SESSION['fromadminedit']="yes";
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
<center><h1 style="font-family:raleway">Edit Product Page</h1></center>
<div class=admin>
		<?php
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
echo "<th>Edit</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<td>".$productid."</td>";
	echo "<td>".$productname."</td>";
	echo "<td>".$description."</td>";
	echo "<td>".$unitsprice."</td>";
	echo "<td>".$unitsinstore."</td>";
	echo "<td><img src=".$picture." height=\"250px\" width=\"200px\"/></td>";
	echo "<td>".$supplier."</td>";
	echo "<td>".$category."</td>";
	echo "<td><a href='editverify.php?operation=edit&productid=".$productid."'>Edit</a></td>";
	echo "</tr>";	
	
}
echo "</table>";
?>
		
		</td>
		</table>
		</div>
		</div>

		</body>
		<div class="errmsg">
<?php
	
}
else {
	?>
	<body onload=deny()></body>
	<?php
}
}

	else { 
header("Location: ../Login/login.php");

}
?>
</html>


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