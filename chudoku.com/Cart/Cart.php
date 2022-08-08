<?php
session_start();
$SessionTimingBySecond = 600;
?>
<html>
<head>
<link type="text/css", rel="stylesheet", href="cart.css"/>
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
<br><br><br>

<?php

	$conn = mysqli_connect("localhost","root","","chudoku.com");
	
	function selectDB($conn) {
		mysql_select_db($this->database,$conn);
	}
	
	function runQuery($query) {
		$conn = mysqli_connect("localhost","root","","chudoku.com");	
		$result = mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$conn = mysqli_connect("localhost","root","","chudoku.com");
		$result  = mysqli_query($conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

//session_start();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			if (preg_match("/^([0-9]){1,4}+$/", $_POST["quantity"])){
			$productByCode = runQuery("SELECT * FROM products WHERE productID='" . $_GET["productID"] . "'");
			//$query=$conn->prepare("SELECT productID, productName, unitsPrice FROM products where productID = '".$_GET["code"]."'");
			//$query->execute();
			//$query->bind_result($productID, $productName, $unitsPrice);
			//while ($query->fetch()){
			$itemArray = array($productByCode[0]["productID"]=>array('name'=>$productByCode[0]["productName"], 'code'=>$productByCode[0]["productID"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["unitsPrice"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["productID"], $_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["productID"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
			}
			else{
				?>
				<script>
				function error(){
				alert("Please enter numbers only")
				}
				</script>
				<body onload=error()></body>
				<?php
				}
		}
	break;
	
	case "remove"://not used for now
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["productID"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}

?>
<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
<link href="cart.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="Cart.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1" >
<tbody>
<tr>
<th><strong>Name</strong></th>
<th><strong>Product ID</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Price</strong></th>
<!--<th><strong>Action</strong></th>-->
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td><strong><?php echo $item["name"]; ?></strong></td>
				<td><?php echo $item["code"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td align=right><?php echo "$".$item["price"]; ?></td>
				<!--<td><a href="Cart.php?action=remove&productID=<?php //echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>-->
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products<a id="btnEmpty" href="../Checkout/Checkout.php">Checkout</a></div>
	<?php
	$product_array = runQuery("SELECT * FROM products");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		
			<div class="product-item">
			<form method="post" action="Cart.php?action=add&productID=<?php echo $product_array[$key]["productID"]; ?>">
			<div class="product-image"><img class="cartimage" src="<?php echo $product_array[$key]["Picture"]; ?>"></div>
			<div><strong><?php echo $product_array[$key]["productName"]; ?></strong></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["unitsPrice"]; ?></div>
			<div><input type="text" name="quantity" value="1" size="2" />    <input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
</div>
</BODY>
</HTML>
<?php
}
else
{ 
		header("Location: ../Login/login.php");
}
?>