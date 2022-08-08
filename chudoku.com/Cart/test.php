<?php

$conn = mysqli_connect("localhost","root","","chudoku.com");

"SELECT * FROM products WHERE productID='" . $_GET["productID"] . "'";
$itemArray = array($productByCode[0]["productID"]=>array('name'=>$productByCode[0]["productName"], 'Product ID'=>$productByCode[0]["productID"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["unitsPrice"]));
			

?>