<html>
<head>
<link type="text/css", rel="stylesheet", href="stylesheet.css"/>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
<a href="login.php">
<p>JOIN/SIGN IN</p></a>
</div>

<!-- picture -->
<div style="clear:both">
<img style="float:left" src="animegirl.png" width="60%" height="500"/>
</div>

<div class="space">
	<div class="words">
		<div class="errmsg">
		<?php
			if(isset($_GET['err']))
			{
				if ($_GET['err'] == 1)
				{
					echo "Missing Username or Password";
				}
				elseif ($_GET['err'] == 2)
				{
					echo "Invalid Username or Password";
				}
				elseif ($_GET['err'] == 3)
				{
					echo "Please verify reCaptcha";
				}
			}
		?>
		</div>
		<form name="form" action="verify.php" method="post" autocomplete="off">
			Username:  <input type="text" name="iUsername" size="25" />
			<br>
			Password:  <input type="password" name="iPassword" size="25" style="margin-left:8px"/>
			<br>
			<div class="g-recaptcha" data-sitekey="6Lf1XA4UAAAAAJbsL_zYCpt-8mkDcqBC0L7BST8x"></div>
			<input class="button1" type="submit" value="Login"/>
		</form>
		<center><h3>Don't have an account?</h3><center>
		<a href="../Register/Register.php">
		<center><button class="button2" type="button">Register!</button><center></a>
	</div>
</div>

</div>
</body>
</html>
