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
		<form method="post" action="verifyAdd.php">
		<div class="details">
		<table style="margin-left:"150" border='0'>
		<table align="center" border="0">
		<center><h1 style="font-family:raleway">Add Product Page</h1></center>
		<tr>
		<td>Category
		<select name="category">
		<option value="">Categories</option>
		<option value="Figurines">Figurines</option>
		<option value="Cards">Cards</option>
		<option value="Apparel">Apparels</option>
		</select>
		</td>
		</tr>
		</table>
		<table>
		<table style="margin-left:"150" border='0'>
		<table align="center" border="0">
		<tr>
		<td>Product ID:</td>
		<td><input type="text" name="productid" /></td>
		</tr>
		<tr>
		<td>Product Name:</td>
		<td><input type="text" name="productname" /></td>
		</tr>
		<tr>
		<td>Product Description:</td>
		<td><input type="text" name="description"/></td>
		</tr>
		<tr>
		<td>Unit Price:</td>
		<td><input type="text" name="unitprice"/></td>
		</tr>
		<tr>
		<td>Units in Store:</td>
		<td><input type="text" name="unitsinstore"/></td>
		</tr>
		<tr>
		<td>Picture:</td>
		<td><input type="file" name="fileupload" value="fileupload" id="fileupload"></td>
		</tr>
		<tr>
		<td>Supplier:</td>
		<td><input type="text" name="supplier"/></td>
		</tr>
		
		
		<td>&nbsp;</td>
		<td>
	
		<input type="hidden" name="addproducts" value="yes" />
		<input type="submit" value="Add Record"/>
		</td>
		</table>
			
		</div>
		</form>
		</body>
		
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
</body>
</html>


<script>
function deny() {
    alert("Access Denied!");
	window.location = '../homepage/homepage.php';
}
</script>