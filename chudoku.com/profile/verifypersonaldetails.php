<?php

session_start();
require('../RequiredFile/database.php');
if(isset($_SESSION["logged_in"]))
{					
		$user=$_SESSION["name"];
		$query=$con->prepare("select * from customers where username=?");
		$query->execute();
		$query->bind_result($customerid,$nric,$firstname,$lastname,$email,$username,$password,$type);
		
		if(isset($_POST["updatepersonaldetails"])){   //check whether a value is set
			
						$firstname=$_POST["firstname"];
						$lastname=$_POST["lastname"];
						$email=$_POST["Email"];
						
		if(preg_match("/^([a-zA-Z])+$/",$firstname)){ //Expression (First name) can be only be made out letters
			if(preg_match("/^([a-zA-Z])+$/",$lastname)){ //Expression (Last name) can be only be made out letters
				if(preg_match("/[a-zA-Z0-9_\-]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}/",$email)){ //Expression (Email) are supposed to include @ & /.
				if($_POST["updatepersonaldetails"]=="yes")
					{
						
						while ($query->fetch()){}
						$query=$con->prepare("update customers set firstName=? , lastName=? , Email=? where username='$user'");
						$firstname = mysqli_real_escape_string($con,$firstname);
						$lastname = mysqli_real_escape_string($con,$lastname);
						$email = mysqli_real_escape_string($con,$email);
						$query->bind_param('sss',$firstname,$lastname,$email);
						
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
								<?php ;
						}
	
						
}
		







	else { 
			header("Location: ../Login/login.php");

		}
?>
<script>
function err(errNo) {
	if (errNo==1){
    alert("The name entered doesn't fulfill the criteria!\nThe name is not supposed to include special characters or numbers");
	window.location = 'editpersonaldetails.php';
	}
	else if (errNo==2){
     alert("The name entered doesn't fulfill the criteria!\nThe name is not supposed to include special characters or numbers");
	window.location = 'editpersonaldetails.php';
	}
	else if (errNo==3){
    alert("The email entered doesn't fulfil the criteria!\nEmail is supposed to be in the email format");
	window.location = 'editpersonaldetails.php';
	}
}
function success(){
alert("Personal Details Updated!");
window.location='profile.php';
}
</script>
	