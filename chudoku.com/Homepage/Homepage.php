<?php
session_start();
require('../RequiredFile/timeout.php');
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
?>
<html>
<head>
<title>Chudoku</title>
<link type="text/css", rel="stylesheet", href="stylesheet.css"/>
</head>
<body>
<div id="warp">
<!-- Top Row -->

<?php
if(isset($_SESSION['logged_in']))
{
	if($_SESSION['type'] == "customer"){
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
	header("Location:../admin/admin.php");
}
else
{
?>
<img style=float:left src="logo.png" width="300" height="75"/> 
<a href="../Homepage/Homepage.php">
<p>HOME</p></a>
<a href="../store/storepage.php">
<p>STORE</p></a>
<a href="../Cart/cart.php">
<p>CART</p></a>
<a href="../Login/login.php">
<p>JOIN/SIGN IN</p></a>
<?php
}
?>


<!-- picture -->
<div style="clear:both">
<img src="Japan.jpg" width="1300" height="300"/>
</div>

<center><h2 style="font-family:raleway">Looking for Japanese Collectibles?</h2></center>
<center><h3 style="font-family:raleway;font-weight:400">We Got You Covered!</h3></center>
<!-- button -->
<div>


<center><a href="../store/storepage.php"><button type="button">SHOP NOW</button></a></center>
</div>
<br>
<center><h1>Just Arrived</h1></center>

<ul>
	
	<li><a href ="../store/Figurines/products/Saitama/Saitama.php"><img src="Onepunch.jpg"/></a><li>
	<li><a href ="../store/Apparel/products/SurveyCorpHoodie/SurveyCorpHoodie.php"><img src="attack.jpg"/></a><li>
	<li><a href ="../store/Cards/products/G-TrialDeck1/G-TrialDeck1.php"><img src="card.jpg"/></a></li>
</ul>

</div>
</body>
</html>