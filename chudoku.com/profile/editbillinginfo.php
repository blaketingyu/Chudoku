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
		<p align="center"><strong>Billing Information<strong></p><hr>
		</div>
		<?php
		$user=$_SESSION["name"];
		$query=$con->prepare("select billinginfo.customerID,billinginfo.creditCardType,billinginfo.creditCardID,billinginfo.cardExpiryDate from billinginfo INNER JOIN customers ON billinginfo.customerID=customers.customerID");
		$query->execute();
		$query->bind_result($customerid,$creditcardtype,$creditcardid,$cardexpirydate);
		
		?>
		
<!--Update-->

		<div class="details">
		<form method="post" action="verifybillinginfo.php">
		<table style="margin-left:"150" border='0'>
		
		<table align="center" border="0">
		<tr>
		<td>Credit Card Type:</td>
		<td>
		<select name="creditcardtype">
		<option value="">Card Type</option>
		<option value="Mastercard" name="options">Mastercard</option>
		<option value="Visa" name="options">Visa</option>
		<option value="NETS" name="options">NETS</option>
		</select></td>
		</tr>
		<tr>
		<td>Credit Card ID:</td>
		
		<td><input type="text" name="creditcardid" /></td>
		</tr>
		
		
		<tr>
		<td>Card Expiry Date(MM-YYYY):</td>
		
		<td><input type="text" name="cardexpirydate"></td>
		</tr>
		
		<tr>
		<td>CVV:</td>
		<td><input type="password" name="cvv"/></td>
		</tr>
		<td>&nbsp;</td>
		<td>
		
		<input type="hidden" name="updatebillinginfo" value="yes" />
		<input type="submit" value="Update Record"/>
		</td>
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