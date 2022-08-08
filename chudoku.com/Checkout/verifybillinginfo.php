<?php

session_start();
if(isset($_SESSION["logged_in"]))
{		
		$connect = mysqli_connect("localhost","root","","chudoku.com"); //connect to database
		if (!$connect){
						die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
					  }
					
		$user=$_SESSION["name"];
		$query=$connect->prepare("select * from customers where username=?");
		$sqlinject = mysqli_real_escape_string($connect,$user);
		$query->bind_param('s', $sqlinject);
		$query->execute();
		$query->bind_result($customerid,$nric,$firstname,$lastname,$email,$username,$password,$type);
		
	
		if(isset($_POST["updatebillinginfo"])){
		
			$creditcardtype=$_POST["creditcardtype"];
			$creditcardid=$_POST["creditcardid"];
			$cardexpirydate=$_POST["cardexpirydate"];
			$cvv=$_POST["cvv"];
			$options=$_POST["options"];
			
			
				if(preg_match("/^([0-9 ]){16}+$/",$creditcardid)){ //Expression (CreditCardID) can be made out of 16 numbers
					if(preg_match("/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/",$cardexpirydate)){ //Expression (CardExpiryDate) can be only be made out of numbers and hyphens
						if(preg_match("/^([0-9]{3})+$/",$cvv)){ //Expression (CVV) can be only be made out of 3 numbers
										if($_POST["updatebillinginfo"]=="yes")
										{	
											while ($query->fetch()){}
											$query=$connect->prepare("update billinginfo set creditCardType=? , creditCardID=?, cardExpiryDate=?, CVV=? where customerID='$customerid'");
											$creditcardtype = mysqli_real_escape_string($connect,$options);
											$creditcardid = mysqli_real_escape_string($connect,$creditcardid);
											$cardexpirydate= mysqli_real_escape_string($connect,$cardexpirydate);
											$cvv = mysqli_real_escape_string($connect,$cvv);
											$query->bind_param('ssss',$creditcardtype,$creditcardid,$cardexpirydate,$cvv);
											
		
												if($query->execute())
													{
														header("Location:profile.php?success=3");	
		
													}
			
										}
						}
							else 
						header("Location:editbillinginfo.php?err=3");
	
					}
					else 
						header("Location:editbillinginfo.php?err=2");
				}
				else 
					header("Location:editbillinginfo.php?err=1");
			
										
						
	}
}





else { 
		header("Location: ../Login/login.php");
	}