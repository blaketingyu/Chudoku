<?php
session_start();
require('../RequiredFile/database.php');
if(isset($_SESSION["logged_in"]))
{
?>
<html>
<!--Header-->
<head>
<link type="text/css", rel="stylesheet", href="stylesheet.css">
</head>

	<body>
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
    <a href="../logout/logout.php">Logout</a>
  </div>
</div>
</div>
	
	
<!--Account Details-->

		<div class="detailsheader">		
		<p align="center"><strong>Personal Details<strong></p><hr>
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
		<form method="post" action="verifypersonaldetails.php">
		
		<table align="center" border="0">
		<tr>
		<td>First Name:</td>
		<?php if(!empty($_SESSION["firstname"])){ ?>
		<td><input type="text" name="firstname" value="<?php echo $_SESSION["firstname"]; ?>" /></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="firstname" /></td>
		</tr>
		<?php }?>
		
		<tr>
		<td>Last Name:</td>
		<?php if(!empty($_SESSION["lastname"])){ ?>
		<td><input type="text" name="lastname" value="<?php echo $_SESSION["lastname"]; ?>" /></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="lastname"/></td>
		</tr>
		<?php }?>
		<tr>
		<td>Email:</td>
		<?php if(!empty($_SESSION["email"])){ ?>
		<td><input type="text" name="Email" value="<?php echo $_SESSION["email"]; ?>"/></td>
		</tr>
		<?php }else {?>
		<td><input type="text" name="Email"/></td>
		</tr>
		<?php }?>
		
		<td>&nbsp;</td>
		<td>
		
		<input type="hidden" name="updatepersonaldetails" value="yes" />
		<input type="submit" value="Update Record"/>
		</td>
		</form>
		</table>
		<a href="../Profile/profile.php"><button style="margin-left:100px">Cancel</button></a>
		
		</div>
		
		</body>
<?php

}
	else { 
header("Location: ../Login/login.php");

}
?>
</div>
</html>