<html>
<head>
<link type="text/css", rel="stylesheet", href="stylesheet.css"/>
</head>
<body>
<div id="warp">
<!-- Top Row -->
<div>
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../store/storepage.php">
<p>STORE</p></a>
<a href="../Cart/cart.php">
<p>CART</p></a>
<a href="../login/login.php">
<p>JOIN/SIGN IN</p></a>
</div>

<div class="body-background" style="clear:both">
<div class="title">
<p> Registration Form </p>
</div>
<div class="content">
<form method="post" action="verify.php" autocomplete="off">
<table align="center" border="0">
<tr>
<td>First Name:</td>
<td><input type="text" name="fname" /></td>
</tr>
<tr>
<td>Last Name:</td>
<td><input type="text" name="lname" /></td>
</tr>
<tr>
<td>Username:</td>
<td><input type="text" name="uname" /></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name="passwd" /></td>
</tr>
<tr>
<td>Re-enter <br> Password:</td>
<td><input type="password" name="repasswd" /></td>
</tr>
<tr>
<td>NRIC:</td>
<td><input type="text" name="nric" /></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" name="email" /></td>
</tr>
<tr>
<td>Address:</td>
<td><input type="text" name="address" /></td>
</tr>
<tr>
<td>City:</td>
<td><input type="text" name="city" /></td>
</tr>
<tr>
<td>State:</td>
<td><input type="text" name="state" /></td>
</tr>
<tr>
<td>Country:</td>
<td><input type="text" name="country" /></td>
</tr>
<tr>
<td>Postal Code:</td>
<td><input type="text" name="postalcode" /></td>
</tr>
<tr>
<td>Phone Number:</td>
<td><input type="text" name="phone" /></td>
</tr>
<tr>
<td>Credit Card Type:</td>
<td>
<select name="cardtype" style="width:215px">
<option>Card Type</option>
<option value="Mastercard" name="options">Mastercard</option>
<option value="Visa" name="options">Visa</option>
<option value="NETS" name="options">NETS</option>
</select>
</td>
</tr>
<tr>
<td>Credit Card Number:</td>
<td><input type="text" name="cardNum" /></td>
</tr>
<tr>
<td>CVV:</td>
<td><input type="password" name="cvv" /></td>
</tr>
<tr>
<td>Credit Card Expiry Date:</td>
<td><input type="text" name="cardexpire" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">
<input type="submit" value="Next"/>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>

<div class="errmsg">
<?php
			if(isset($_GET['err']))
			{
				if ($_GET['err'] == 1)
				{
					echo "The username entered doesn't fulfill the criteria <br>";
					echo "Username is not supposed to include any special characters, only numbers and alphabet";
				}
				elseif ($_GET['err'] == 2)
				{
					echo "The username entered is already being used";
				}
				elseif ($_GET['err'] == 3)
				{
					echo "Your first name or last name entered doesn't fulfil the criteria <br>";
					echo "The maximum letters for each name is 35 and it's not supposed to include any special characters and numbers";
				}
				elseif ($_GET['err'] == 4)
				{
					echo "Please fill up both password and retype password";
				}
				elseif ($_GET['err'] == 5)
				{
					echo "The Password entered doesn't match, please retype your password";
				}
				elseif ($_GET['err'] == 6)
				{
					echo "Password requirements has not been met<br>";
					echo "The password has to contain at least one uppercase, 1 number and 1 number";
				}
				elseif ($_GET['err'] == 7)
				{
					echo "The NRIC entered is in invalid format";
				}
				elseif ($_GET['err'] == 8)
				{
					echo "Someone with the following NRIC has already created an account";
				}
				elseif ($_GET['err'] == 9)
				{
					echo "The Email entered doesn't fulfil the criteria <br>";
					echo "Please enter the email in the correct format";
					
				}
				elseif ($_GET['err'] == 10)
				{
					echo "Someone with the following Email has already created an account <br>";
				}
				
				
			}
		?>
</div>
</body>
</html>