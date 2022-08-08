<html>
<body>
<?php
function CheckForDuplicateID($idtocheck)
{
	require("../Required/Required.php");
	$query = $con->prepare("SELECT TRANSACTION_ID FROM PURCHASE_SUM WHERE TRANSACTION_ID=".$idtocheck);
	$query->execute();
	$query->bind_result($transactionid);
	if($query->fetch())
	{
		return true;
	}
	else
	{
		return false;
	}
}
session_start();
require("../Required/Required.php");

$checkcredit = $_POST['checkcredit'];
$checkexpirydate = $_POST['checkexpirymonth']."/".$_POST['checkexpiryyear'];
$checkcvv = $_POST['checkcvv'];
$username = $_SESSION['username'];

$query=$con->prepare("SELECT c.CREDIT_CARD_NUM, c.EXP_DATE, c.CVV, pm.PAYMENT_ID FROM CREDITCARD_INFO c, USER u, PROFILE p, PAYMENT pm WHERE u.USERNAME = '$username' AND u.USER_ID = 
p.USER_ID AND p.PROFILE_ID = pm.PROFILE_ID AND pm.CREDIT_CARD_NUM = c.CREDIT_CARD_NUM");
$query->execute();
$query->bind_result($creditcardnum, $expdate, $cvv, $paymentid);

while($query->fetch())
{
}
if ($checkcredit == $creditcardnum && $checkexpirydate == $expdate && $checkcvv == $cvv)
{
	do			//ensure no 2 randomised numbers will be the same
	{
		$transactionid = rand(1,999999);
	}while(CheckForDuplicateID($transactionid) == true);
	$date = date("d/m/Y");
	$totalamount = $_SESSION['overalltotal'];
	$itemcodearray = array();
	foreach ($_SESSION['cart_item'] as $item)
	{
		$itemcodearray[] = $item['code'];
	}
	
	$itemcodes = implode(", ", $itemcodearray);

	$query1= $con->prepare("INSERT INTO PURCHASE_SUM (`TRANSACTION_ID`, `PAYMENT_ID`, `TOTAL_AMT`, `ITEMCODES_PURCHASED`, `PURCHASE_DATE`) VALUES (?,?,?,?,?)");
	$query1->bind_param('iidss', $transactionid, $paymentid, $totalamount, $itemcodes, $date);
	if ($query1->execute())
	{
		$_SESSION['transactionid'] = $transactionid;
		$_SESSION['totalamount'] = $totalamount;
		$_SESSION['date'] = $date;
		header('Location: PurchaseSummary.php');
	}
}
else
{
	header('Location: ../ShoppingCart/ShoppingCart.php?checkouterror=1');
}
?>
</body>
</html>