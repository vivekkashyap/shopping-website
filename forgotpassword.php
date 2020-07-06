<?php include "config/config.php";  //  include, include_once or require, require_once any one can be used ?> 
<?php 
	if(isset($_POST['submit']) & !empty($_POST['email']))
	{
		$email = mysqli_real_escape_string($conn,trim($_POST['email']));
		$sql = "SELECT * FROM `users` WHERE email = '$email'";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if($count > 0)
		{
         $to = "vivek.kashyap102@gmail.com";
         $subject = "This is subject";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:vivek.cpp@gmail.com";
         
         $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
			}
		else {
			echo "User name does not exist in database";
			}
	}
/*
	$r = mysqli_fetch_assoc($res);
	$password = $r['password'];
	$to = $r['email'];
	$subject = "Your Recovered Password";

	$message = "Please use this password to login " . $password;
	$headers = "From : vivek.kashyap102@gmail.com";
	if(mail($to, $subject, $message, $headers)){
		echo "Your Password has been sent to your email id";
		}
	else {
		echo "Failed to Recover your password, try again";
		}
		*/
?> 

<!DOCTYPE html>
<html>
	<head>
		<title>The Originals : Forgot Password</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<div class="w3-container w3-center">
			<div class="w3-row">
				<div class="w3-col s11 m6 l3 w3-border w3-display-middle" id="signup">
				    <h1 style="font-size: 30px">Forgot Password</h1>
					<!--Form Start-->
					<form class="w3-container" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						<p><input class="w3-input w3-border" style="clear: both;" type="email" name="email" id="email" placeholder="Email"></p>
						<p id="button"><input type="submit" name="submit" class="w3-button w3-round-xlarge" value="Send Password" style="width:100%; background-color: #099605; font-weight: bold;"></p>
						<p><a href="#">Need Help ?</a></p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>