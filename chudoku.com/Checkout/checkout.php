<?php
session_start();
$SessionTimingBySecond = 600;
?>
<html>
<head>
<link type="text/css", rel="stylesheet", href="checkout.css"/>
<title>Checkout</title>
</head>
<body>
<div id="warp">
<!-- Top Row -->

<?php
if(isset($_SESSION["logged_in"]))
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
    <a href="../logout.php">Logout</a>
  </div>
</div>
</div>

<!--Coding for the checkout-->

<html>
<br></br><br></br>
<!--display items in cart?-->
<div class="hithere">
<!--form coding here and at relevant parts below-->
<form action="verifyCheckout.php" method="post">
<h1>Checkout</h1>

<h2>Please enter your credit card information for verification</h2>
<table>
<tr>
	<td>Credit Card No:</td>
	<td><input type="text" name="creditCardNo"></td>
</tr>
<tr>
	<td>Credit Card Expiry Date:</td>
	<td><input type="text" name="expDate" value="mm/yyyy"></td>
</tr>
<tr>
	<td>CVV:</td>
	<td><input type="text" name="cvv"></td>
</tr>
<!--<tr>
	<td>Card type:</td>
	<td>
	<select name="cardType">
	<option value="MasterCard">MasterCard</option>
	<option value="NETS">NETS</option>
	<option value="Visa">Visa</option>
	</select>
	</td>
</tr>-->
<tr>
	<td><input type="submit" value="Verify" name="checkout"</td>
</tr>
</table>
</form>
</html>
</div>
<?php
}
else
{
	header("Location: ../Login/login.php");
}
?>
