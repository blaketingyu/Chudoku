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
		<div class="detailsheader">		
		<p align="center"><strong>Personal Details<strong></p><hr>
		</div>
		<?php
		$user=$_SESSION["name"];
		$query=$con->prepare("select * from customers where username=?");
		$sqlinject = mysqli_real_escape_string($con,$user);
		$query->bind_param('s', $sqlinject);
		$query->execute();
		$query->bind_result($customerid,$nric,$firstname,$lastname,$email,$username,$password,$type);
		?>
		<div class="details">
		<table style="margin-left:"150" border='0'>

		<?php	
while($query->fetch())
		{
		echo "<tr>"."<th>First Name:</th>";
		echo "<td>".$firstname."</td>"."</tr>";
		echo "<tr>"."<th>Last Name:</th>";
		echo "<td>".$lastname."</td>"."</tr>";
		echo "<tr>"."<th>NRIC:</th>";
		echo "<td>".$nric."</td>"."</tr>";
		echo "<tr>"."<th>Email:</th>";
		echo "<td>".$email."</td>"."</tr>";
		echo "<tr>"."<th>Password:</th>";
		echo "<td ><a href =\"updatepassword.php\">CHANGE PASSWORD</a></td>";
	
	
		$_SESSION['firstname']=$firstname;
		$_SESSION['lastname']=$lastname;
		$_SESSION['email']=$email;
		$_SESSION['nric']=$nric;
}
		echo "</table>";
		?>
		
		<a href="editpersonaldetails.php"><button style="margin-top:50px">Edit</button></a>
		</div>

		</div>

		
		<div class="detailsheader">		
		<p align="center"><strong>Address Book<strong></p><hr>
		</div>
		<?php
		$query=$con->prepare("select customerID,city,address,state,country,postalCode,phone from billinginfo where customerID='$customerid'");
		$query->execute();
		$query->bind_result($customerid,$city,$address,$state,$country,$postalcode,$phone);
		?>
			<div class="addressdetails">
			<table style="margin-left:"150" border='0'>
			<tr><th>Address:</th>
			<th>City:</th>
			<th>State:</th>
			<th>Country:</th>
			<th>Postal Code:</th>
			<th>Phone Number:</th>
			</tr>
			<?php	
			while($query->fetch())
			{
				
				echo "<tr>";
				echo "<td>".$address."</td>";
				echo "<td>".$city."</td>";
				echo "<td>".$state."</td>";
				echo "<td>".$country."</td>";
				echo "<td>".$postalcode."</td>";
				echo "<td>".$phone."</td>";
				echo "</tr>";	
			
				$_SESSION['address']=$address;
				$_SESSION['city']=$city;
				$_SESSION['state']=$state;
				$_SESSION['country']=$country;
				$_SESSION['postalcode']=$postalcode;
				$_SESSION['phone']=$phone;
				
		}
			echo "</table>";
			?>
			<a href="editaddress.php"><button style="margin-top:50px">Edit</button></a>
			</div>
		
		
		
		</div>
		
		<div class="detailsheader">		
		<p align="center"><strong>Credit Card Info<strong></p><hr>

		<?php
		$query=$con->prepare("select customerID,creditCardID,creditcardType,cardExpiryDate,CVV from billinginfo where customerID='$customerid'");
		$query->execute();
		$query->bind_result($username,$creditcardid,$creditcardtype,$cardexpirydate,$cvv);
		?>
		</div>
		<div class="details">
		<table style="margin-left:"150" border='0'>
			<tr><th>Credit Card Type:</th>
			<th>Credit Card Number:</th>
			<th>Card Expiry Date:</th>
			</tr>
			<?php	
			
			
			while($query->fetch())
			{
			$lastfour = substr($creditcardid, 12);
			$creditcard = str_pad($lastfour, 16, '*', STR_PAD_LEFT);
			echo "<tr>";
			echo "<td>".$creditcardtype."</td>";
			echo "<td>".$creditcard."</td>";
			echo "<td>".$cardexpirydate."</td>";
			echo "</tr>";	
			
			$_SESSION['creditcardtype']=$creditcardtype;
			$_SESSION['creditcardid']=$creditcardid;
			$_SESSION['cardexpirydate']=$cardexpirydate;
			
		}
			echo "</table>";
			?>
			<a href="editbillinginfo.php"><button style="margin-top:50px">Edit</button></a>
			</div>
		
		

		
		<?php
		
}
	else
{ 
	header("Location: ../Login/login.php");
}


		?>
</div>
</body>
</html>