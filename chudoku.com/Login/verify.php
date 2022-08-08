<?php
require('../RequiredFile/database.php');
if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] or 1=1){   //check recaptcha

	$secret = "6Lf1XA4UAAAAAOIY0rOzy7vX0rBQXzTfjxFFty_H";
	$ip = $_SERVER['REMOTE_ADDR'];
	$captcha = $_POST['g-recaptcha-response'];
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
	
	$arr = json_decode($response,TRUE);
	if($arr['success'] OR 1==1)
	{
		
		$iUSER = $_POST['iUsername'];
		$iPWD = $_POST['iPassword'];
		
		if(empty($iUSER) OR empty($iPWD)) 
		{
			?>
			<body onload=missing()></body>						
			<?php				//empty username or pw
		}
		else
		{
			$uppercase = preg_match('@[A-Z]@', $iPWD);   		//have at least 1 uppercase
			$lowercase = preg_match('@[a-z]@', $iPWD);			//have at least 1 lowercase
			$number = preg_match('@[0-9]@', $iPWD);				//have at least 1 number
			if ((!preg_match("/^([A-Za-z0-9]{6,20})+$/",$iUSER)) OR ( !$uppercase || !$lowercase || !$number || strlen($iPWD) < 8 || strlen($iPWD) > 20) OR (preg_match("/^([\`\~\!\@\#\$\%\^\&\*\(\)\-\_\=\+\[\]\{\}\\\|\;\':\"\,\.\/\<\>\?])+$/",$iPWD)))
			{													//doesnt check if fail RegEx
				?>
				<body onload=invalid()></body>						
				<?php										
			}
			else
			{
				
				$query = $con->prepare("SELECT username, password, type from customers");
				
				$query->execute();
				$query->bind_result($dbusername, $dbpassword, $role);
				while($query->fetch())										
				{
					if($dbusername==$iUSER and $dbpassword == $iPWD)
					{
					session_start();
					$_SESSION["logged_in"]= 1;
					$_SESSION["name"]= $dbusername;						//set the session where the name is the username
					$_SESSION["time"]= time();	
					$_SESSION["type"]= $role;
					if($role == "customer"){
						header("Location:../Homepage/Homepage.php");		//go to logged in homepage
					}
					else if ($role == "admin"){
						header("Location:../Admin/admin.php");
					}
					break;
					}
					?>
					<body onload=invalid()></body>
					<?php
						
				}
				
			}
		}
	}
	else														//fail recaptcha 
	{															//should not happen
		header("Location:login.php");						 	//as recaptcha force user do until successful
	}
	
}
else  //recaptcha not done
{
	?>
	<body onload=recaptcha()></body>
	<?php
}

?>


<script>
function missing() {
    alert("Missing Username or Password.");
	window.location = '../login/login.php';
}

function invalid() {
    alert("Invalid Username or Password.");
	window.location = '../login/login.php';
}

function recaptcha() {
    alert("Please verify reCaptcha.");
	window.location = '../login/login.php';
}
</script>


