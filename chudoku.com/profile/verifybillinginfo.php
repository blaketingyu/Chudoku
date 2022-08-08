	<?php

session_start();
require('../RequiredFile/database.php');
if(isset($_SESSION["logged_in"]))
{					
		$user=$_SESSION["name"];
		$query=$con->prepare("select * from customers where username=?");
		$sqlinject = mysqli_real_escape_string($con,$user);
		$query->bind_param('s', $sqlinject);
		$query->execute();
		$query->bind_result($customerid,$nric,$firstname,$lastname,$email,$username,$password,$type);
		
	
		if(isset($_POST["updatebillinginfo"])){
		
			$creditcardtype=$_POST["creditcardtype"];
			$creditcardid=$_POST["creditcardid"];
			$cardexpirydate=$_POST["cardexpirydate"];
			$cvv=$_POST["cvv"];
			
			if(!empty($creditcardtype)){
				if(preg_match("/^([0-9 ]){16}+$/",$creditcardid)){ //Expression (CreditCardID) can be made out of 16 numbers
					if(preg_match("/^\d{2}\/\d{4}$/",$cardexpirydate)){ //Expression (CardExpiryDate) can be only be made out of numbers and hyphens
						if(preg_match("/^([0-9]{3})+$/",$cvv)){ //Expression (CVV) can be only be made out of 3 numbers
										if($_POST["updatebillinginfo"]=="yes")
										{	
											while ($query->fetch()){}
											$query=$con->prepare("update billinginfo set creditCardType=? , creditCardID=?, cardExpiryDate=?, CVV=? where customerID='$customerid'");
											$creditcardtype = mysqli_real_escape_string($con,$creditcardtype);
											$creditcardid = mysqli_real_escape_string($con,$creditcardid);
											$cardexpirydate= mysqli_real_escape_string($con,$cardexpirydate);
											$cvv = mysqli_real_escape_string($con,$cvv);
											$query->bind_param('ssss',$creditcardtype,$creditcardid,$cardexpirydate,$cvv);
											
		
												if($query->execute())
													{
														?>
														<body onload=success()></body> 
														<?php //Success	
		
													}
			
										}
						}
							else 
								?>
								<body onload=err(3)></body> 
								<?php 
	
					}
					else 
						?>
								<body onload=err(2)></body> 
								<?php 
				}
				else 
				?>
								<body onload=err(1)></body> 
								<?php 
			
										
						
	}else 
			?>
		<body onload=err(4)></body>
		<?php
		}
		
}





else { 
		header("Location: ../Login/login.php");
	}
?>
<script>
function err(errNo) {
	if (errNo==1){
    alert("The credit card number entered doesn't fulfill the criteria!\nThe number is supposed to include 16 numbers");
	window.location = 'editbillinginfo.php';
	}
	else if (errNo==2){
    alert("The expiry date entered doesn't fulfil the criteria !\nThe expiry date should be entered in a date format MM/YY");
	window.location = 'editbillinginfo.php';
	}
	else if (errNo==3){
    alert("The CVV entered doesn't fulfil the criteria!\nCVV is supposed to only 3 numbers");
	window.location = 'editbillinginfo.php';
	}
	else if (errNo==4){
    alert("Please Choose an card type");
	window.location = 'editbillinginfo.php';
	}
}
function success(){
alert("Billing Info Updated!");
window.location='profile.php';
}
</script>
	