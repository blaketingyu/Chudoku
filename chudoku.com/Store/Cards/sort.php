<?php
require('../../RequiredFile/timeout.php');
require('../../RequiredFile/database.php');
session_start();
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
require('../../RequiredFile/database.php');
?>

<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="stylesheetcards.css"/>
</head>
<body style= "background-color: white">
<?php
if(isset($_SESSION["logged_in"]))
{
	if($_SESSION['type'] == "customer")
{
?>
<div class="smaller">
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../../Store/storepage.php">
<p>STORE</p></a>
<a href="../../Cart/cart.php">
<p>CART</p></a>
<div class="dropdown">
  <button class="dropbtn">Welcome <?php echo $_SESSION["name"]; ?></button>
  <div class="dropdown-content">
    <a href="../../Profile/profile.php">Edit User Profile</a>
	<a href="../../Profile/checkOrder.php">Check Orders</a>
    <a href="../../Logout/logout.php">Logout</a>
  </div>
</div>
</div>
<?php
}
else if($_SESSION['type'] == "admin")
{
	?>
<div class="smaller">
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../../admin/admin.php">
<p>HOME</p></a>
<a href="../../Store/storepage.php">
<p>STORE</p></a>
<a href="../../Cart/cart.php">
<p>CART</p></a>
<div class="dropdown">
  <button class="dropbtn">Welcome <?php echo $_SESSION["name"]; ?></button>
  <div class="dropdown-content">
    <a href="../../admin/addproducts.php">Add Products</a>
	<a href="../../admin/editproducts.php">Edit Products</a>
	<a href="../../admin/deleteproducts.php">Delete Products</a>
    <a href="../../logout/logout.php">Logout</a>
  </div>
</div>
</div>
<?php 
}
}
else {
	?>
<body style= "background-color: white">
<div id="warp">
<img style=float:left src="Logo.png" width="300" height="75"/>
<a href="../../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../../store/storepage.php">
<p>STORE</p></a>
<a href="../../Cart/cart.php">
<p>CART</p></a>
<a href="../../Login/login.php">
<p>JOIN/SIGN IN</p></a>
<?php } ?>

<!--header picture-->
<img src="header.jpg" height="300px" width="1300" style=float:center>
<!--The refine bar-->
<div class="refine">
	<h4 style="font-family:raleway">REFINE BY</h4>
	<hr width="200" align="left">
	<h4 style="font-family:raleway">Popular Original</h4>
	<a href="sort.php?value=Pokemon"><li style="font-family: Raleway" >Pokemon</li></a>
	<a href="sort.php?value=Yu-Gi-Oh"><li style="font-family: Raleway" >Yu-Gi-Oh</li></a>
	<a href="sort.php?value=CardfightVanguard"><li style="font-family: Raleway" >Cardfight Vanguard</li></a>
</div>
<form name="form" action="sort.php" method="post">
<select name="Sort">
  <option>Sort By <option>
  <option value="asc">Price lowest to highest</option>
  <option value="desc">Price highest to lowest</option>
  <input type="submit" value="Sort"/>
</select>

</form>
<div class="products">

<ul>
<?php
if (isset ($_POST['Sort'])){
	
$sort=$_POST['Sort'];
	if($sort == "asc")
	{
 $query=$con->prepare("select * from products where category = 'Cards' ORDER BY unitsPrice ASC");
 $query->execute();
$query->bind_result($productid,$name,$description, $price, $units, $picture, $supplier, $category);
 while($query->fetch())
{
$text = $name;
$text = preg_replace("/\([^)]+\)/","",$text);
$text = str_replace(array(' '), '', $text);
echo"<li><a href=\"/chudoku.com/store/".$category."/products/".$text."/".$text.".php\"><img class=\"tile_image\" src=".$picture." height=\"450px\" width=\"300px\"/><br><p>".$name."</p></a></li>"; 
}
}

if($sort == "desc")
{
$query=$con->prepare("select * from products where category = 'Cards' ORDER BY unitsPrice DESC");
 $query->execute();
$query->bind_result($productid,$name,$description, $price, $units, $picture, $supplier, $category);
while($query->fetch())
{
$text = $name;
$text = preg_replace("/\([^)]+\)/","",$text);
$text = str_replace(array(' '), '', $text);
echo"<li><a href=\"/chudoku.com/store/".$category."/products/".$text."/".$text.".php\"><img class=\"tile_image\" src=".$picture." height=\"450px\" width=\"300px\"/><br><p>".$name."</p></a></li>"; 
}
}
}
else {
if(isset($_GET['value'])){
  $query=$con->prepare("select * from products where category = 'Cards'");
 $query->execute();
$query->bind_result($productid,$name,$description, $price, $units, $picture, $supplier, $category);
while($query->fetch())
{
$text = $name;
$text = preg_replace('/^.*(\(.*\)).*$/', '$1', $text);
$text = str_replace(array( '(', ')' ), '', $text);
$text = str_replace(array(' '), '', $text);

$productname = $name;
$productname = preg_replace("/\([^)]+\)/","",$productname);
$productname = str_replace(array(' '), '', $productname);

if ($_GET['value'] == $text) {
echo"<li><a href=\"/chudoku.com/store/".$category."/products/".$productname."/".$productname.".php\"><img class=\"tile_image\" src=".$picture." height=\"450px\" width=\"300px\"/><br><p>".$name."</p></a></li>"; 
}
}
}
}
 

?>
</html>