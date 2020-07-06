<?php
		define("HOSTNAME","localhost");   //define is used to define constant in php
		define("USERNAME","root");		  //constant name are given in capital letters as per the standard naming convention
		define("PASSWORD","");
		define("DBNAME","shopping");

		$conn = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME) or die("Cannot connect to database");     
		//In contants there is no need of inverted commas
		//die is run when not connected to database

		//if($conn)  echo "<script type='text/javascript'>alert('You are Connected to Database');</script>";
?>