<?php include "config/config.php"; ?>
<?php 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 session_start();
 if(!isset($_SESSION['login']))
    header("location:login.php");
 
// Attempt select query execution
$sql = "SELECT * FROM product WHERE category='printer'";

if($result = mysqli_query($conn, $sql))
        {
?>

<!DOCTYPE html>
<html>
<head>
  <title>Shopping</title>
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
  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3; width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <h3 class="w3-wide"><a href="index.php"><b>THE ORIGINALS</b></a></h3>
    </div>
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
      <a href="index.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Home</a>
      <a href="mobiles.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Mobiles</a>
      <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align w3-btn" id="myBtn">
        Electronics <i class="fa fa-caret-down"></i>
      </a>
      <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
        <a href="watches.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Watches</a>
        <a href="#" class="w3-button w3-block w3-black w3-left-align w3-btn">Printer</a>
        <a href="camera.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Cameras</a>
      </div>
      <a href="account.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Account</a>
      <a href="setting.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Settings</a>
      <a href="about.php" class="w3-button w3-block w3-white w3-left-align w3-btn">About</a>
    </div>
  </nav>

  <!-- Top menu on small screens -->
  <header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <a href="index.php"><div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div></a>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
  </header>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>
    
    <!-- Top header -->
    <header class="w3-container w3-xlarge">
      <p class="w3-left">Printer</p>
      <p class="w3-right">
      	<?php echo "Hello ".$_SESSION['email']."..." ?>
        <a href="logout.php" title="Logout"><i class="fa fa-sign-out w3-margin-right"></i></a>
        <a href="index.php#mycart"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
      </p>
    </header>

    <div class="w3-container w3-text-grey" id="jeans">
      <p><?php echo mysqli_num_rows($result).' items' ; ?></p>
    </div>

    <!-- Product grid -->
    <div class="w3-row">
      <?php
        
          if(mysqli_num_rows($result) > 0)
          {    
              while($row = mysqli_fetch_array($result))
              {
                 echo " 
                    <div class='w3-col l3 s6'>
                      <div class='w3-container'>
                        <div class='w3-display-container'>
                          <img src='".$row["source"]."' style='width:200px; height:250px'>
                          <div class='w3-display-middle w3-display-hover'>
                              <button class='w3-button w3-black'>Add To Cart <i class='fa fa-shopping-cart'></i></button>
                          </div>
                        </div>
                        <p>". $row["name"]."<br><b>". $row["newamount"] ." </b><br><strike> ". $row["oldamount"] ." </strike></p>
                      </div>
                    </div>
          
                  ";
              }
              // Free result set
              mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
       
      // Close connection
      mysqli_close($conn);
      ?>

    </div>

    <div class="w3-black w3-center w3-padding-24"> &copy; Copyright 2018 | The Originals </div>

    <!-- End page content -->
  </div>


  <script>
  // Accordion 
  function myAccFunc() {
      var x = document.getElementById("demoAcc");
      if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
      } else {
          x.className = x.className.replace(" w3-show", "");
      }
  }

  // Click on the "Jeans" link on page load to open the accordion for demo purposes
  document.getElementById("myBtn").click();


  // Script to open and close sidebar
  function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
  }
   
  function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
  }
  </script>
</div>
</body>
</html>
