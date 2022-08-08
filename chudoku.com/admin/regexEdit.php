<?php
session_start();
require('../RequiredFile/database.php');
if(isset($_SESSION["logged_in"]))
{					
		
	if(isset($_POST["editproducts"])){
		$category = $_POST["category"];
		$productID = $_POST["productid"];
		$productname = $_POST["productname"];
		$description = $_POST["description"];
		$unitprice = $_POST["unitprice"];
		$unitsinstore = $_POST["unitsinstore"];
		$picture = $_POST["fileupload"];
		$picpath = "/chudoku.com/store/".$category."/".$picture;
		$supplier = $_POST["supplier"];
		
		if (!empty($category)){
			if(preg_match("/^([0-9]){4}+$/",$productID)){	
			if(preg_match("/^([A-Za-z0-9\s ])+[(]{1}+([A-Za-z0-9\s ])+[)]{1}+[ ]{0,}+$/",$productname)){
				if(preg_match("/^([0-9])+[.]{1}+([0-9]){2}+$/",$unitprice)){
					if (preg_match("/^[0-9]+$/",$unitsinstore)){
						if (preg_match("/^([a-zA-Z0-9\.\/\-])+$/",$picpath)){
							if (preg_match("/^([a-zA-Z0-9\.\/\- ])+$/",$supplier)){
								if($_POST["editproducts"]=="yes")
										{	
											
											$query=$con->prepare("update products set productID=?,productName=?,productDescription=?,unitsPrice=?,unitsInStore=?,Picture=?,Supplier=?,Category=? where productID='$productID'");
											while ($query->fetch()){}
											$newproductID = mysqli_real_escape_string($con,$productID);
											$newproductname = mysqli_real_escape_string($con,$productname);
											$newdescription= mysqli_real_escape_string($con,$description);
											$newUnitsPrice= mysqli_real_escape_string($con,$unitprice);
											$newUnitStore= mysqli_real_escape_string($con,$unitsinstore);
											$newPicture= mysqli_real_escape_string($con,$picpath);
											$newSupplier = mysqli_real_escape_string($con,$supplier);
											$category = mysqli_real_escape_string($con,$category);
											$query->bind_param('ssssssss',$newproductID,$newproductname,$newdescription,$newUnitsPrice,$newUnitStore,$newPicture,$newSupplier,$category);
				
												if($query->execute())
													{
														?>
														<body onload=success()></body>
														<?php
		
													}
			
										}
									
						}
							else 
							?>
		<body onload=err(4)></body>
		<?php				//Invalid Supplier
								
				}
					else 
					?>
		<body onload=err(3)></body>
		<?php		//Invalid Picture
				}
				else 
				?>
		<body onload=err(2)></body>
		<?php					//Invalid Units
			}
	else 
		?>
		<body onload=err(1)></body>
		<?php  //Invalid price
	
	}
	else 
		?>
		<body onload=err(5)></body>
		<?php //Invalid Product Name
		
			}
		else 
			?>
		<body onload=err(6)></body>
		<?php //Invalid ProductID

		}
	else 
		?>
		<body onload=err(7)></body>
		<?php //Empty Category, not selected
	}

}
function checkid($id)
{
	require('../RequiredFile/database.php');
	$query = $con->prepare("SELECT productID from products");
	$query->execute();
	$query->bind_result($dbID);
	while($query->fetch())
	{
		if($id==$dbID)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
?>
<script>
function success() {
    alert("Products Updated!");
	window.location = 'admin.php';
}
function err(errNo) {
	if (errNo==1){
    alert("Invalid Price!");
	window.location = 'editProductsDetails.php';
	}
	else if (errNo==2){
    alert("Invalid Units!");
	window.location = 'editProductsDetails.php';
	}
	else if (errNo==3){
    alert("Invalid Picture Directory!");
	window.location = 'editProductsDetails.php';
	}
	else if (errNo==4){
    alert("Invalid Supplier");
	window.location = 'editProductsDetails.php';
	}
	else if (errNo==5){
    alert("Invalid Product Name");
	window.location = 'editProductsDetails.php';
	}
	else if (errNo==6){
    alert("Invalid Product ID");
	window.location = 'editProductsDetails.php';
	}
	else if (errNo==7){
    alert("Category not selected");
	window.location = 'editProductsDetails.php';
	}
}
</script>