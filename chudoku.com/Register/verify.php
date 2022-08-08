<html>
<body>  
<?php
require("../requiredfile/database.php");
require("../requiredfile/key.php");

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['uname'];
$password = $_POST['passwd'];
$retypepassword = $_POST['repasswd'];
$nric = $_POST['nric']; 
$email = $_POST['email']; 
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$postalcode = $_POST['postalcode'];
$phone = $_POST['phone'];
$cardtype = $_POST['cardtype'];
$cardnum = $_POST['cardNum'];
$cvv = $_POST['cvv'];
$cardexpire = $_POST['cardexpire'];

//Generate Random ID until it does not match existing IDs
do
{
	$randNumForID = createid();
}while(checkid($randNumForID) == false);

if (regexUsername($username)== false){
		?>
		<body onload=err(1)></body> 
		<?php 	//Username doesn't match the requirements
	}

else {
	if (checkUsername($username)==false){
		?>
		<body onload=err(2)></body> 
		<?php  //Username already used
		}
	else {
		if (regexName($fname) == false || regexName($lname) == false)
		{
			?>
			<body onload=err(3)></body> 
			<?php 	//First name & Last Name doesn't match the requirements
		}
		else{
		if (checkPassword($password,$retypepassword)==1) { //Empty form
			?>
			<body onload=err(4)></body> 
		<?php }
		if (checkPassword($password,$retypepassword)==2) { //The password doesn't match
			?>
			<body onload=err(5)></body> 
		<?php }
		if (checkPassword($password,$retypepassword)==3) { //The password doesn't fulfill the requirements
			?>
			<body onload=err(6)></body> 
		<?php }
		if (checkPassword($password,$retypepassword)==4)
		{	
			if (regexNRIC($nric)==false){
				?>
				<body onload=err(7)></body> 
				<?php	// NRIC doesnt fit the requirement
			}
			else {
			
			if(checkNRIC($nric)== false){
				?>
				<body onload=err(8)></body> 
				<?php				//NRIC already in database 
			}
			else {
				if (regexEmail($email) == false) {	
					?>
					<body onload=err(9)></body> 
					<?php	// Email doesnt fit the requirement
					}
				else 
				{
					if (checkEmail($email) == false) {
						?>
						<body onload=err(10)></body> 
						<?php	// Email already in database 
						}
							else {

					if (checkAddress($address) == false) { //Address does not meet criteria, requires #
						?>
						<body onload=err(11)></body> 
						<?php	
						}
					elseif (checkCity($city) == false) { //City does not meet criteria
						?>
						<body onload=err(12)></body> 
						<?php	
						}
					elseif (checkState($state) == false) { //State does not meet criteria
						?>
						<body onload=err(13)></body> 
						<?php	
						}
					elseif (checkCountry($country) == false) { //Country does not meet criteria
						?>
						<body onload=err(14)></body> 
						<?php	
						}
					elseif (checkPostalCode($postalcode) == false) { //Postal Code does not meet criteria
						?>
						<body onload=err(15)></body> 
						<?php
						}
					elseif (regexPhone($phone) == false) { //Phone Number does not meet criteria
						?>
						<body onload=err(16)></body> 
						<?php	
						}
					elseif (checkPhone($phone) == false) { //Phone Number already in Database
						?>
						<body onload=err(17)></body> 
						<?php	
						} 
					elseif (checkcardtype($cardtype) == false) { //Empty Field
						?>
						<body onload=err(18)></body> 
						<?php	
						}
					elseif (regexCardNum($cardnum) == false) { //Card Number does not meet criteria
						?>
						<body onload=err(19)></body> 
						<?php	
						}
					elseif (checkCreditID($cardnum) == false) { //Card Number already in database
						?>
						<body onload=err(20)></body> 
						<?php	
						}
					elseif (checkExpiryDate($cardexpire) == false) { //Expiry Date does not meet criteria
						?>
						<body onload=err(21)></body> 
						<?php	
						}
					elseif (checkCVV($cvv) == false) { //CVV does not meet criteria
						?>
						<body onload=err(22)></body> 
						<?php
						}
					else {
						
							$query= $con->prepare("INSERT INTO `customers` (`customerID`, `NRIC`,`firstName`, `lastName`, `email`, `username`,`password` , `type`) VALUES (?,?,?,?,?,?,?,?)"); 
							$ifname=$fname; 
							$ilname=$lname; 
							$iusername=$username; 
							$ipassword=encrypt($password); 
							$inric=encrypt($nric); 
							$iemail=$email;
							$role='customer';
							$query->bind_param('isssssss', $randNumForID, $inric, $ifname, $ilname, $iemail, $iusername, $ipassword, $role);
							$query->execute();
							
							$query2 = $con->prepare("INSERT INTO `billinginfo` (`address`,`city`,`state`,`country`,`postalCode`,`phone`,`creditCardID`,`CVV`,`creditCardType`,`cardExpiryDate`,`customerID`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
							
							$iaddress = $address; 
							$icity=$city; 
							$istate=$state;
							$icountry=$country;
							$ipostalcode=$postalcode;
							$iphone=$phone;
							$icardNum=encrypt($cardnum); 
							$icvv=encrypt($cvv); 
							$icardtype=$cardtype;
							$icardexpire=$cardexpire;
							
							$query2->bind_param('ssssssssssi', $iaddress, $icity, $istate, $icountry, $ipostalcode, $iphone, $icardNum, $icvv, $icardtype, $icardexpire, $randNumForID);
							$query2->execute();
							
							header("Location:success.php");
					}
							}

						}
					}

				}	
			}	
		}
	}
}







function createid()
{
	$generateid = rand(6000,6999);
	return $generateid;
}

function checkid($id)
{
	require("../requiredfile/database.php");
	$query = $con->prepare("SELECT customerID from customers");
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



function checkNRIC($nric)
{
	require("../requiredfile/database.php");
	$query = $con->prepare("SELECT NRIC from customers");
	$query->execute();
	$query->bind_result($dbNRIC);
	while($query->fetch())
	{
		if($nric==$dbNRIC)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

function checkEmail($email)
{
	require("../requiredfile/database.php");
	$query = $con->prepare("SELECT email from customers");
	$query->execute();
	$query->bind_result($dbEmail);
	while($query->fetch())
	{
		if($email==$dbEmail)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

function checkUsername($username)
{
	require("../requiredfile/database.php");
	$query = $con->prepare("SELECT username from customers");
	$query->execute();
	$query->bind_result($dbUsername);
	while($query->fetch())
	{
		if($username==$dbUsername)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
function regexNRIC($nric) {
 if (empty($nric)){
	return false;
	}
else {
	if (preg_match("/^([S|T|s|t]){1}([0-9]){7}([A-Za-z]){1}+$/",$nric)){
		return true;
		}
}
}
function regexEmail($email) {
 if (empty($email)){
	return false;
	}
else {
	if (preg_match("/[a-zA-Z0-9_\-]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}/",$email)){
		return true;
		}
}
}
function regexUsername($username) {
 if (empty($username)){
	return false;
	}
else {
	if (preg_match("/^([a-zA-Z0-9]{6,20})+$/",$username)) {
		return true;
		}
}
}
function regexName($name) {
 if (empty($name)){
	return false;
}
else {
	if (preg_match("/^([a-zA-Z ]{2,35})+$/",$name)) {
		return true;
	}
	else{
		return false;
	}
}
}

function checkPassword($newpassword,$retypepassword)
{
	if(empty($newpassword) OR empty($retypepassword)) {
		return 1;
	}
	else {
		if ($newpassword!=$retypepassword){
			return 2;
		}
		else {
			$uppercase = preg_match('@[A-Z]@', $newpassword);
			$lowercase = preg_match('@[a-z]@', $newpassword);
			$number = preg_match('@[0-9]@', $newpassword);
			if (!$uppercase || !$lowercase || !$number || strlen($newpassword) < 8 || strlen($newpassword) > 20) {
				return 3;
			}
			else {
				return 4;
			}
		}
	}
}
function checkAddress($address) {
 if (empty($address)){
	return false;
}
else {
	if (preg_match("/^[A-Za-z0-9'\.\-\s\,]+[#]{1}+[A-Za-z0-9'\.\-\s\,]+$/",$address)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkCity($city) {
 if (empty($city)){
	return false;
}
else {
	if (preg_match("/^([A-Za-z\, ])+$/",$city)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkState($state) {
 if (empty($state)){
	return false;
}
else {
	if (preg_match("/^([A-Za-z\, ])+$/",$state)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkCountry($country) {
 if (empty($country)){
	return false;
}
else {
	if (preg_match("/^([A-Za-z ])+$/",$country)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkPostalCode($postalcode) {
 if (empty($postalcode)){
	return false;
}
else {
	if (preg_match("/^([0-9]{6})+$/",$postalcode)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkPhone($phone)
{
	require("../requiredfile/database.php");
	$query = $con->prepare("SELECT phone from billinginfo");
	$query->execute();
	$query->bind_result($dbPhone);
	while($query->fetch())
	{
		if($phone==$dbPhone)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
function regexPhone($phone) {
 if (empty($phone)){
	return false;
}
else {
	if (preg_match("/^(([8|9]){1}[0-9]{7})+$/",$phone)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkcardtype($creditcardtype) {
 if (empty($creditcardtype)){
	return false;
}
else 
	
		return true;

}
function regexCardNum($creditcardid) {
 if (empty($creditcardid)){
	return false;
}
else {
	if(preg_match("/^([0-9 ]){16}+$/",$creditcardid)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkCreditID($creditcardid)
{
	require("../requiredfile/database.php");
	$query = $con->prepare("SELECT creditCardID from billinginfo");
	$query->execute();
	$query->bind_result($dbCardID);
	while($query->fetch())
	{
		if($creditcardid==$dbCardID)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
function checkExpiryDate($cardexpirydate) {
 if (empty($cardexpirydate)){
	return false;
}
else {
	if(preg_match("/^\d{2}\/\d{4}$/",$cardexpirydate)) {
		return true;
	}
	else{
		return false;
	}
}
}
function checkCVV($cvv) {
 if (empty($cvv)){
	return false;
}
else {
	if(preg_match("/^([0-9]{3})+$/",$cvv)) {
		return true;
	}
	else{
		return false;
	}
}
}

function encrypt($text){
	require("../requiredfile/key.php");
	$encryptedtext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
	$encryptHex = bin2hex($encryptedtext);
	return $encryptHex;
}


?>
</body>
</html>
<script>
function err(errNo) {
	if (errNo==1){
    alert("The username entered doesn't fulfill the criteria!\nUsername is not supposed to include any special characters, only numbers and alphabet");
	window.location = 'Register.php';
	}
	else if (errNo==2){
    alert("The username entered is already being used");
	window.location = 'Register.php';
	}
	else if (errNo==3){
    alert("Your first name or last name entered doesn't fulfil the criteria\nThe maximum letters for each name is 35 and it's not supposed to include any special characters and numbers");
	window.location = 'Register.php';
	}
	else if (errNo==4){
    alert("Please fill up both password and retype password");
	window.location = 'Register.php';
	}
	else if (errNo==5){
    alert("The Password entered doesn't match, please retype your password");
	window.location = 'Register.php';
	}
	else if (errNo==6){
    alert("Password requirements has not been met\nThe password has to contain at least one uppercase, 1 number and 1 number");
	window.location = 'Register.php';
	}
	else if (errNo==7){
    alert("The NRIC entered is in invalid format");
	window.location = 'Register.php';
	}
	else if (errNo==8){
    alert("Someone with the following NRIC has already created an account");
	window.location = 'Register.php';
	}
	else if (errNo==9){
    alert("The Email entered doesn't fulfil the criteria\nPlease enter the email in the correct format");
	window.location = 'Register.php';
	}
	else if (errNo==10){
    alert("Someone with the following Email has already created an account");
	window.location = 'Register.php';
	}
	else if (errNo==11){
    alert("Address does not meet criteria, requires # for apartment number");
	window.location = 'Register.php';
	}
	else if (errNo==12){
    alert("City does not meet criteria, it cannot contain numbers and special characters");
	window.location = 'Register.php';
	}
	else if (errNo==13){
    alert("State does not meet criteria, it cannot contain numbers and special characters");
	window.location = 'Register.php';
	}
	else if (errNo==14){
    alert("Country does not meet criteria, it cannot contain numbers and special characters");
	window.location = 'Register.php';
	}
	else if (errNo==15){
    alert("Postal Code does not meet criteria, postal code contains 6 numbers");
	window.location = 'Register.php';
	}
	else if (errNo==16){
    alert("Phone Number does not meet criteria\nPhone number starts off with 8/9 and contains 8 numbers");
	window.location = 'Register.php';
	}
	else if (errNo==17){
    alert("Phone Number is already registered with another account");
	window.location = 'Register.php';
	}
	else if (errNo==18){
    alert("Card Type is not selected");
	window.location = 'Register.php';
	}
	else if (errNo==19){
    alert("Card Number does not meet criteria, card number must include 16 numbers");
	window.location = 'Register.php';
	}
	else if (errNo==20){
    alert("Card Number is already registered with another account");
	window.location = 'Register.php';
	}
	else if (errNo==21){
    alert("Card Expiry Date does not meet the criteria, it's to be entered in the following format (MM/YYYY)");
	window.location = 'Register.php';
	}
	else if (errNo==22){
    alert("CVV entered does not meet criteria, CVV contains 3 numbers only");
	window.location = 'Register.php';
	}
	
}

</script>