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
if(isset($_SESSION['fromadminedit'])){
	if($_SESSION['fromadminedit']=="yes"){
		$_SESSION['fromadminedit']="no";
		if(isset($_GET['operation'])){
			if($_GET['operation']=="edit")
			{
				$query=$con->prepare("select * from products where productID=".$_GET['productid']);
				$query->execute();
				$query->bind_result($productid,$productname,$description,$unitsprice,$unitsinstore,$picture,$supplier,$category);
				if($query->execute())
				{
				while($query->fetch()){}
				$_SESSION['productid']=$productid;
				$_SESSION['productname']=$productname;
				$_SESSION['description']=$description;
				$_SESSION['unitsprice']=$unitsprice;
				$_SESSION['unitsinstore']=$unitsinstore;
				$_SESSION['picture']=$picture;
				$_SESSION['supplier']=$supplier;
				$_SESSION['category']=$category;
				header("Location:../admin/editproductsdetails.php");
				}
				
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
function redirect() {
    alert("Access Denied!");
	window.location = 'editproducts.php';
}
</script>