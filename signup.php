<?php include "config/config.php";  //  include, include_once or require, require_once any one can be used ?> 
<?php 
	if(isset($_POST['submit'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		if ($firstname!="" && $lastname!="" && $email!="" && $password!="")
		{
			$query = "INSERT INTO users(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";
			header("Location: login.php");
	
			$fire = mysqli_query($conn,$query) or die("Data Not Inserted".mysqli_error($conn));
				
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
				<div class="w3-col s11 m6 l3 w3-border w3-display-middle" id="signup">
				    <h1 style="font-size: 30px">Create an Account</h1>
               		<img class="w3-round-xlarge w3-border" id="user" src="img/user.png" alt="User">
					<!--Form Start-->
					<form class="w3-container" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

						<p><input class="w3-input w3-border" style="width: 48%; float: left;" type="text" name="firstname" placeholder="First Name"></p>
						<p id="lastname"><input class="w3-input w3-border" style="width: 48%; float: right;" type="text" name="lastname" placeholder="Last Name"></p>
						<p><input class="w3-input w3-border" style="clear: both;" type="email" name="email" id="email" placeholder="Email"></p>
						<p><input class="w3-input w3-border" type="password" name="password" id="password"placeholder="Password"></p>
						<p id="button"><button type="submit" name="submit" class="w3-button w3-round-xlarge" style="width:100%; background-color: #099605; font-weight: bold;">SignUp</button></p>
						<p>Already a user ? <a href="login.php"> Sign In</a></p>
						<p><a href="needhelp.php">Need Help ?</a></p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>