<?php
session_start();
require('../RequiredFile/timeout.php');
require('../RequiredFile/database.php');
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
if(isset($_SESSION["logged_in"]))
{
if($_SESSION['type'] == "admin")
{
if(isset($_SESSION['fromadmindelete'])){
	if($_SESSION['fromadmindelete']=="yes"){
		$_SESSION['fromadmindelete']="no";
		if(isset($_GET['operation'])){
			if($_GET['operation']=="delete")
			{
				$query=$con->prepare("delete from products where productID=".$_GET['productid']);
				if($query->execute())
				{
					?>
					<body onload=success()></body>
					<?php
				}
			}
		}
		else{
			?>
	<body onload=redirect()></body>
	<?php
		}
	}
	else{
		?>
	<body onload=redirect()></body>
	<?php
	}
}
else{
	?>
	<body onload=redirect()></body>
	<?php
}
}
else {
	?>
	<body onload=deny()></body>
	<?php
}
}

	else { 
header("Location: ../Login/login.php");
}
?>
<script>
function deny() {
    alert("Access Denied!");
	window.location = '../homepage/homepage.php';
}
function redirect(){
	alert("Access Denied!");
	window.location = 'deleteproducts.php';
}
function success(){
	alert("Product Deleted!");
	window.location = 'deleteproducts.php';
}


</script>