<?php include "config/config.php";  //  include, include_once or require, require_once any one can be used ?> 
<?php 
	if(isset($_POST['submit'])){
		$email = mysqli_real_escape_string($conn,trim($_POST['email']));
		$password = mysqli_real_escape_string($conn,md5($_POST['password']));
		
		$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
		$fire = mysqli_query($conn,$query);
		$count = mysqli_num_rows($fire);
		if($fire){
			if($count > 0){
				session_start();
				$_SESSION['login']= true;
				$_SESSION['email']= $email;
				header("Location: index.php");
			}
			else
				echo "<script type='text/javascript'>alert('Invalid Entry');</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<div class="w3-container w3-center">
			<div class="w3-row">
				<div class="w3-col s11 m6 l3 w3-border w3-display-middle" id="login">
				    <h1>The Originals</h1>
               		<img class="w3-round-xlarge w3-border" id="user" src="img/user.png" alt="User">
					<!--Form Start-->
					<form class="w3-container" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						<p><input class="w3-input w3-border" type="email" name="email" id="email" placeholder="Email.."></p>
						<p><input class="w3-input w3-border" type="password" name="password" id="password"placeholder="Password.."></p>
						<p id="button"><button type="submit" name="submit" class="w3-button w3-round-xlarge" style="width:100%; background-color: #099605; font-weight: bold;">Login</button></p>
						<p>Or <a href="signup.php">Register</a></p>
						<p><a href="forgotpassword.php">Forgot Password</a> ?</p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>