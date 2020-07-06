<?php include "config/config.php";
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
  session_start();
 if(!isset($_SESSION['login']))
    header("location:login.php");

// Attempt select query execution
$sql = "SELECT * FROM product";

 if($result = mysqli_query($conn, $sql))
        {

?>

<!DOCTYPE>
<html>
  <head>
    <title>Account</title>
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
      <hr>
      <!-- Top header -->
      <header class="w3-container w3-xlarge">
        <p class="w3-left"><strong>About</strong></p>
        <p class="w3-right">
          <span class="w3-margin-right"><?php echo "Hello ".$_SESSION['email'] ?></span>
          <a href="logout.php" title="Logout"><i class="fa fa-sign-out w3-margin-right"></i></a>
        </p>
      </header>
      <hr>
      <div class="w3-margin-top">
          <h4><strong> Group Members Name </strong></h4>
          <p>Vivek Kashyap</p>
          <p>Sumit Singh</p>
          <p>Sudhanshu Kumar</p>
          <br>
          <h4>About</h4>
          <p>We Are Happy to help</p>
        </div>

      <div class="w3-center w3-padding-24 w3-margin-top"> <h3>&copy; Copyright 2018 | The Originals </h3></div>
    </div>
  </body>
</html>
<?php } ?>