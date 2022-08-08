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
		
	
		if(isset($_POST["updateaddress"])){
		
			$address=$_POST["address"];
			$city=$_POST["city"];
			$state=$_POST["state"];
			$country=$_POST["country"];
			$postalcode = $_POST["postalcode"];
			$phone = $_POST["phone"];
			
			if (preg_match("/^[A-Za-z0-9'\.\-\s\,]+[#]{1}+[A-Za-z0-9'\.\-\s\,]+$/",$address)){ //Expression (Address) can be made out of letter, numbers and special characters like #
				if (preg_match("/^([A-Za-z\,])+$/",$city)){	//Expression (City) can be made out of letter and also a comma 
					if (preg_match("/^([A-Za-z\,])+$/",$state)){	//Expression (State) can be made out of letter and also a comma 
						if (preg_match("/^([A-Za-z])+$/",$country)){	//Expression (Country) can be made out of letter 
							if (preg_match("/^([0-9]{6})+$/",$postalcode)){	//Expression (Postal Code) is supposed to be made out of 6 numbers 
								if (preg_match("/^(([8|9]){1}[0-9]{7})+$/",$phone)){	//Expression (Phone) is supposed to be made out of 
										if($_POST["updateaddress"]=="yes")
										{	
											while ($query->fetch()){}
											$query=$con->prepare("update billinginfo set address=?,city=?,state=?,country=?,postalCode=?,phone=? where customerID='$customerid'");
											$address = mysqli_real_escape_string($con,$address);
											$city = mysqli_real_escape_string($con,$city);
											$state = mysqli_real_escape_string($con,$state);
											$country = mysqli_real_escape_string($con,$country);
											$postalcode = mysqli_real_escape_string($con,$postalcode);
											$phone = mysqli_real_escape_string($con,$phone);
											$query->bind_param('ssssss',$address,$city,$state,$country,$postalcode,$phone);
											
		
												if($query->execute())
													{
														?>
														<body onload=success()></body> 
														<?php //Success	
		
													}
										}
										
										
							}
						else {
								?>
								<body onload=err(6)></body> 
								<?php //Wrong Number
						}
						}
						else {
								?>
								<body onload=err(5)></body>
								<?php //Wrong Postal Code
						}
					}
				else {
							?>
							<body onload=err(4)></body>
							<?php //Wrong Country
				}
		}
			else {
							?>
							<body onload=err(3)></body>
							<?php //Wrong State
			}
	}
		else {
					?>
					<body onload=err(2)></body>
					<?php 	//Wrong City
		}
	}
	else {
			?>
			<body onload=err(1)></body>
			<?php //Wrong Address
	}
}

}





else { 
		header("Location: ../Login/login.php");
	}
?>

<script>
function err(errNo) {
	if (errNo==1){
    alert("The address entered doesn't fulfill the criteria!\nAddress is supposed to include at least one #");
	window.location = 'editaddress.php';
	}
	else if (errNo==2){
    alert("The city entered doesn't fulfil the criteria!\nCity is not supposed to include any special characters or numbers #");
	window.location = 'editaddress.php';
	}
	else if (errNo==3){
    alert("The state entered doesn't fulfil the criteria!\nState is not supposed to include any special characters or numbers");
	window.location = 'editaddress.php';
	}
	else if (errNo==4){
    alert("The country entered doesn't fulfil the criteria!\nCountry is not supposed to include any special characters or numbers");
	window.location = 'editaddress.php';
	}
	else if (errNo==5){
    alert("The Postal Code entered doesn't fulfil the criteria!\nPostal Code is not supposed to include any alphabets, special characters and only consists of 6 numbers");
	window.location = 'editaddress.php';
	}
	else if (errNo==6){
    alert("The Phone number entered doesn't fulfil the criteria!\nPhone number is not supposed to include any alphabets, special characters and is supposed to start with either 8/9 and consist of 8 numbers");
	window.location = 'editaddress.php';
	}
}
function success(){
alert("Address Book Updated!");
window.location='profile.php';
}
</script>