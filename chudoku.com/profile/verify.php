<?php

session_start();
require('../RequiredFile/database.php');
if(isset($_SESSION["logged_in"]))
{		
		
		$user=$_SESSION["name"];
			
	if(isset($_POST["updatepassword"])){   //check whether a value is set
		
				$oldpassword = $_POST['oldpassword'];
				$newpassword = $_POST['newpassword'];
				$retypedpassword = $_POST['retypepassword'];
				$uppercase = preg_match('@[A-Z]@', $newpassword);
				$lowercase = preg_match('@[a-z]@', $newpassword);
				$number = preg_match('@[0-9]@', $newpassword);
				$query=$con->prepare("select password from customers where username='$user'");
				$query->execute();
				$query->bind_result($password);
				while ($query->fetch()){
				}
					if ($oldpassword == $password) {
						if($_POST['retypepassword']==$_POST['newpassword']){
							if(empty($newpassword) OR empty($retypedpassword)) 
								{
									?>
								<body onload=err(1)></body> 
								<?php 					//empty pw for any of the form
								}
							else
								{
									if (!$uppercase || !$lowercase || !$number || strlen($newpassword) < 8 || strlen($newpassword) > 20)
								{
									?>
								<body onload=err(2)></body> 
								<?php 				//doesnt check if fail RegEx
								}	
									else
										{
											if($_POST["updatepassword"]=="yes")
										{
				
											$query=$con->prepare("update customers set password='$newpassword' where username='$user'");
		
										if($query->execute())
										{
											?>
											<body onload=success()></body> 
											<?php //Success		
										}
										}
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
    alert("Please enter input for both password ");
	window.location = 'updatepassword.php';
	}
	else if (errNo==2){
    alert("Doesnt fulfil the password requirements!\nThe password has to contain at least one uppercase, 1 number and 1 number");
	window.location = 'updatepassword.php';
	}
	else if (errNo==3){
    alert("Passwords do not match");
	window.location = 'updatepassword.php';
	}
	else if (errNo==4){
    alert("Old password entered wrongly");
	window.location = 'updatepassword.php';
	}
}
function success(){
alert("Password Updated!");
window.location='profile.php';
}
</script>
	