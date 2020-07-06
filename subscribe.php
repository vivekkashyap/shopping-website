<?php 
	require 'config/config.php' ;
	$subqry = mysqli_query($conn, "INSERT INTO subscribe (email) VALUE (".$_POST['email'].")");
?>