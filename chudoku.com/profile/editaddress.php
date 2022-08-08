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
elseif($_SESSION['type'] == "admin")
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
		<p align="center"><strong>Address Book<strong></p><hr>
		</div>
		<?php
		$user=$_SESSION["name"];
		$query=$con->prepare("select billinginfo.customerID,billinginfo.city,billinginfo.address,billinginfo.state,billinginfo.country,billinginfo.postalCode,billinginfo.phone from billinginfo INNER JOIN customers ON billinginfo.customerID=customers.customerID");
		$query->execute();
		$query->bind_result($customerid,$city,$address,$state,$country,$postalcode,$phone);
		?>
		
<!--Update-->
		<div class="addressdetails">
		<form method="post" action="verifyaddress.php">
		
		<table style="margin-left:"150" border='0'>
		
		<table align="center" border="0">
		<tr>
		<td>Address:</td>
		<?php if(!empty($_SESSION["address"])){ ?>
		<td><input type="text" name="address" value="<?php echo $_SESSION["address"]; ?>" /></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="address"/></td>
		</tr>
		<?php }?>
		
		<tr>
		<td>City:</td>
		<?php if(!empty($_SESSION["city"])){ ?>
		<td><input type="text" name="city" value="<?php echo $_SESSION["city"]; ?>" /></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="city"/></td>
		</tr>
		<?php }?>
		
		<tr>
		<td>State:</td>
		<?php if(!empty($_SESSION["state"])){ ?>
		<td><input type="text" name="state" value="<?php echo $_SESSION["state"]; ?>"/></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="state"/></td>
		</tr>
		<?php }?>
		
		<tr>
		<td>Country:</td>
		<?php if(!empty($_SESSION["country"])){ ?>
		<td><input type="text" name="country" value="<?php echo $_SESSION["country"]; ?>"/></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="country"/></td>
		</tr>
		<?php }?>
		
		<tr>
		<td>Postal Code:</td>
		<?php if(!empty($_SESSION["postalcode"])){ ?>
		<td><input type="text" name="postalcode" value="<?php echo $_SESSION["postalcode"]; ?>" /></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="postalcode"/></td>
		</tr>
		<?php }?>
		
		<tr>
		<td>Phone Number: </td>
		<?php if(!empty($_SESSION["phone"])){ ?>
		<td><input type="text" name="phone" value="<?php echo $_SESSION["phone"]; ?>" /></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="phone"/></td>
		</tr>
		<?php }?>
		<td>&nbsp;</td>
		
		
		<input type="hidden" name="updateaddress" value="yes" />
		<td><input type="submit" value="Update Record"/></td>
		</table>
		</form>	
		<a href="../Profile/profile.php"><button style="margin-left:100px">Cancel</button></a>	
		</div>
		
		</body>



<?php
}
	else { 
header("Location: ../Login/login.php");
}
?>
</html>
