<?php
session_start();
$SessionTimingBySecond = 600;
?>
<html>
<head>
<link type="text/css", rel="stylesheet", href="checkout.css"/>
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
    <a href="../logout.php">Logout</a>
  </div>
</div>
</div>

<br><br><br><br><br><br>
<html>
<!--if there are errors, display error message-->
<div class="hithere">
<?php
function OrderIDverification($checkorderid)
{
	$connect=mysqli_connect("localhost","root","","chudoku.com");
	$query = $connect->prepare("SELECT orderID FROM orders WHERE orderID=".$checkorderid);
	$query->execute();
	$query->bind_result($orderID);
	if($query->fetch())
	{
		return true;
	}
	else
	{
		return false;
	}
}
$connect=mysqli_connect("localhost","root","","chudoku.com");
if (!$connect){
	die('Could not connect: ' . mysqli_connect_errno());//cannot connect
}

$user=$_SESSION["name"];

  $query=$connect->prepare("SELECT billinginfo.customerID,billinginfo.cvv,billinginfo.creditCardID,billinginfo.cardExpiryDate from billinginfo INNER JOIN customers ON billinginfo.customerID=customers.customerID where username='$user'");
  $query->execute();
  $query->bind_result($customerID,$cvv2,$creditCardNo2,$expDate2);

 while($query->fetch()){}
 

$creditCardNo1=$_POST["creditCardNo"];
$expDate1=$_POST["expDate"];		
$cvv1=$_POST["cvv"];

if(preg_match("/^([0-9 ]){16}+$/",$creditCardNo1)){ //Expression (CreditCardID) can be made out of 16 numbers
	if(preg_match("/^\d{2}\/\d{4}$/",$expDate1)){ //Expression (CardExpiryDate) can be only be made out of numbers and hyphens
		if(preg_match("/^([0-9]{3})+$/",$cvv1)){ //Expression (CVV) can be only be made out of 3 numbers
			if($creditCardNo1 == $creditCardNo2 && $expDate1 == $expDate2 && $cvv1 == $cvv2){//code to match user credit card info
				//if there is no error in the verification
				do
				{
					$orderID=rand(1,9999);
				}while(OrderIDverification($orderID) == true);
				//things to be added into the Database
				$orderDate=date("Y-m-d");
				$shipDate=date("Y-m-d");
				$timestamp=date("Y-m-d");
				$deliveryStatus=("Shipping on Delivery");
				foreach ($_SESSION['cart_item']as $item)
				{
					$cartarray[] = $item['code'];
				}
				
				$cart=implode(", ",$cartarray); //Product IDs
				
				$addtoDB=$connect->prepare("INSERT INTO orders (`orderID`,`orderDate`,`shipDate`,`timestamp`,`deliveryStatus`,`customerID`) VALUES(?,?,?,?,?,?)");
				$addtoDB->bind_param('ssssss',$orderID,$orderDate,$shipDate,$timestamp,$deliveryStatus,$customerID);
				
				
				
				if ($addtoDB->execute())
				{
					foreach ($_SESSION["cart_item"] as $item){
					$addOrders=$connect->prepare("INSERT INTO orderdetails (`OrderID`,`productID`) VALUES (?,?)");
					$addOrders->bind_param('ii',$orderID,$item["code"]);
					$addOrders->execute();
					}
					
					echo"<h2>Your Purchase is successful! Thank you for shopping at Chudoku.com!</h2>";
					
				}
				
				}
			else{
			?><h2>Credit Card information do not match<br><br>Please try again</h2><?php
		}}
		else{
		?><h2>Make sure CVV contains 3 digits<br><br>Please try again</h2><?php
	}}
	else{
	?><h2>Make sure date is in the correct format<br><br>Please try again</h2><?php
}}
else{
?><h2>Make sure the Credit Card No is 16 digits<br><br>Please try again</h2><?php
}
?>
	
<h2><a href="checkout.php">Click here to return back to checkout</a><h2>
</html>
</div>
<?php
}
else
{ 
		header("Location: ../Login/login.php");
}
?>
