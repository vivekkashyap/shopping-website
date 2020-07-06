<?php include "config/config.php"; 

$query = "SELECT * FROM admin";
    $fire = mysqli_query($conn,$query);
    $name = mysqli_fetch_array($fire)["name"];

session_start();
 if(!isset($_SESSION['login']) && $_SESSION['name']= $name)
    header("location:admin/adminlogin.php");

?>

<!DOCTYPE>
<html>
  <head>
    <title>Insert</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .w3-sidebar a {font-family: "Roboto", sans-serif}
    body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
    </style>
  </head>

  <body class="w3-content" style="max-width:1200px">
    <div>
      <!-- Top menu on small screens -->
      <header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
        <a href="index.php"><div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div></a>
      </header>

      <hr>
      <!-- Top header -->
      <header class="w3-container w3-xlarge">
        <p class="w3-left"><strong>ADMIN PANEL</strong></p>
        <p class="w3-right">
          <span class="w3-margin-right"><?php echo "Hello ".$_SESSION['name'] ?></span>
          <a href="logout.php" title="Logout"><i class="fa fa-sign-out w3-margin-right"></i></a>
        </p>
      </header>
      <hr>

    	<form id="form_1"  action="" method="post" enctype="multipart/form-data">
        <p> Category 
          <select class="w3-select w3-border" name="category">
            <option value="" disabled selected>Choose your option...</option>
            <option name="category" value="mobiles">mobiles</option>
            <option name="category" value="watches">watches</option>
            <option name="category" value="printer">printer</option>
            <option name="category" value="camera">camera</option>
          </select>
        </p>
        <p>Name <input type="text" class="w3-select w3-border" name="name" value=""/></p>
    		<p>Pictures <input type="file" class="w3-input w3-border-0" name="source" value=""/></p>
    		<p>Old Price <input type="text" class="w3-select w3-border" name="oldamount" value=""/></p>
    		<p>New Price <input type="text" class="w3-select w3-border" name="newamount" value=""/></p>
    		<p><input class="w3-button w3-large w3-round-large w3-light-green" type="submit" name="submit" value="Submit"/></p>
    	</form>

      <div class="w3-center w3-padding-24 w3-margin-top"> <h3>&copy; Copyright 2018 | The Originals </h3></div>
    </div>
  </body>
</html>

<?php	
  $category = '';
	if(isset($_POST['submit']))
	{
    $category = isset($_POST['category']) ? $_POST['category'] : '';
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$oldamount = isset($_POST['oldamount']) ? $_POST['oldamount'] : '';
		$newamount = isset($_POST['newamount']) ? $_POST['newamount'] : '';    
		$source = $_FILES['source']['name'];
		$tempname = $_FILES['source']['tmp_name'];
		$folder = "img/".$source;
		move_uploaded_file($tempname, $folder);
	}
 
	if ($category!="" && $name!="" && $oldamount!="" && $newamount!="" && $source!="")
	{
		$query = "INSERT INTO product VALUES ('','$category','$name','$newamount','$oldamount','$folder','')" ;


		$data = mysqli_multi_query($conn,$query);

		if($data)
			echo "<script>alert('Data Inserted Sucessfully in ". $category ." ')</script>" ;
    else
      echo "<script>alert('OOPS!!! Something Wrong')</script>";
	}
?>
