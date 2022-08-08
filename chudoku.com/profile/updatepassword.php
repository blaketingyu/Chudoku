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
		<p align="center"><strong>Change Password<strong></p><hr>
			<form method="post" action="verify.php">
		</div>
		<?php
		$user=$_SESSION["name"];
		$query=$con->prepare("select username,customerID,firstName,lastName,NRIC,email,password from customers where username='$user'");
		$query->execute();
		$query->bind_result($username,$customerid,$firstname,$lastname,$nric,$email,$password);
		?>
<!--Update-->

		<div class="details">
		<table style="margin-left:"150" border='0'>
		
		<table align="center" border="0">
		<tr>
		<th style="font-size:30px">Your Account Details </th></tr>
		<tr>
		<td>First Name: <?php echo $_SESSION["firstname"]; ?></td>
		</tr>
		<tr>
		<td>Last Name: <?php echo $_SESSION["lastname"]; ?></td>
		</tr>
		<tr>
		<td>Email: 	<?php echo $_SESSION["email"]; ?></td>
		</tr>
		</table>
		<div class="whitespace">
		</div>
		<table align="center">
		
		
		<tr>
		<td>Old Password:</td>
		<td><input type="password" name="oldpassword"/></td>
		</tr>
		<tr>
		<td>New Password:</td>
		<td><input type="password" name="newpassword"/></td>
		</tr>
		<tr>
		<td>Retype Password:</td>
		<td><input type="password" name="retypepassword"/></td>
		</tr>
		<td>&nbsp;</td>
		<td>
		
		<input type="hidden" name="updatepassword" value="yes" />	
		<input type="submit" value="Change Password"/>
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