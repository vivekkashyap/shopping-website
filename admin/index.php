<?php include "../config/config.php"; 

$query = "SELECT * FROM admin";
    $fire = mysqli_query($conn,$query);
    $name = mysqli_fetch_array($fire)["name"];

session_start();
 if(!isset($_SESSION['login']) && $_SESSION['name']= $name)
    header("location:adminlogin.php");

?>

<!DOCTYPE>
<html>
  <head>
    <title>Admin</title>
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
        <h2 class="w3-left"><strong>Welcome To Admin Panel</strong></h2>
        <p class="w3-right">
          <span class="w3-margin-right"><?php echo "Hello ".$_SESSION['name'] ?></span>
        	<a href="logout.php" title="Logout"><i class="fa fa-sign-out w3-margin-right"></i></a>
        </p>
      </header>
      <hr>

      <div class="w3-container">
        <br>
        <table class="w3-table-all w3-margin-top">
            <thead>
              <tr>
                <th>Operations</th> 
                <th>Click Here</th>
              </tr>
            </thead>
            <tr>
              <td>1. Insert Items</td>
              <td><a href="../insert.php"><button class='w3-button w3-blue'>Insert</button></a></td>
            </tr>
            <tr>
              <td>2. Delete Items</td>
              <td><button class='w3-button w3-blue'>Delete</button></td>
            </tr>
            <tr>
              <td>3. Update Items</td>
              <td><button class='w3-button w3-blue'>Update</button></td>
            </tr>
          </table>
          <br>
        <h3>more to come...</h3>
      </div>

      <div class="w3-center w3-padding-24 w3-margin-top"> <h3>&copy; Copyright 2018 | The Originals </h3></div>
    </div>
  </body>
</html>
