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
$sql = "SELECT * FROM product WHERE 1";

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
  <nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3; width:200" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <h3 class="w3-wide"><a href="index.php"><b>THE ORIGINALS</b></a></h3>
    </div>
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
      <a href="#" class="w3-button w3-block w3-black w3-left-align w3-btn">Home</a>
      <a href="mobiles.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Mobiles</a>
      <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
        Electronics <i class="fa fa-caret-down"></i>
      </a>
      <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
        <a href="watches.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Watches</a>
        <a href="printer.php" class="w3-button w3-block w3-white w3-left-align w3-btn">Printer</a>
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
      <p class="w3-left">Product</p>
      <p class="w3-right">
        <?php echo "Hello ".$_SESSION['email']."..." ?>
      	<a href="logout.php" title="Logout"><i class="fa fa-sign-out w3-margin-right"></i></a>
        <a href="#cart"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
      </p>
    </header>

    <!-- Image header -->
    <div class="w3-display-container w3-container">
      <img src="img/banner.jpg" alt="Banner" style="height:500px; width:100%">
      <div class="w3-display-left w3-text-white" style="padding:24px 48px">
        <p><a href="#product" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
      </div>
    </div>

    <div class="w3-container w3-text-grey" id="product">
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
                      <form class='w3-container' method='get' >
                        <div class='w3-display-container'>
                          <img src='".$row["source"]."' style='width:200px; height:250px'>
                          <div class='w3-display-middle w3-display-hover'>
                            <button class='w3-button w3-black' name='addtocart' id='addtocart'  >Add To Cart <i class='fa fa-shopping-cart'></i></button>  
                          </div>
                        </div>
                        <p>". $row["name"]."<br><b>". $row["newamount"] ." </b><br><strike> ". $row["oldamount"] ." </strike></p>
                      </form>
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
      ?>

    </div>

    <!-- Subscribe section -->
    <div class="w3-container w3-light-grey w3-padding-20">
      <h1>Subscribe</h1>
      <p>To get special offers and latest information:</p>
      <form id="form" action="" method="post">
        <p><input class="w3-input w3-border" type="text" name="email" placeholder="Enter e-mail" style="width:100%"></p>
        <p><input class="w3-button w3-red w3-margin-bottom" type="submit" name="submit" value="Subscribe"/></p>
      </form>
    </div>

    <?php
      if(isset($_POST['submit']))
      {
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        if ($email!="")
        {
          $query2 = "INSERT INTO subscribe VALUES ('$email')" ;
          $data2 = mysqli_query($conn,$query2);

          if($data2)
          {
            echo "<script>alert('You are Subscribed')</script>" ;
          } 
          else 
            echo "Something Wrong!!";
        }
      }
    ?>


    <div id="cart">
      <p>This Is cart </p>
    </div>
    
    <!-- Footer -->
    <footer class="w3-padding-50 w3-light-grey w3-small w3-center" id="footer">
      <div class="w3-row-padding">
        <div class="w3-col s4">
          <h4>Feedback</h4>
          <form id="formfeedback" action="" method="post">
            <p><input class="w3-input w3-border" type="text" placeholder="Name" name="name2" required></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Email" name="email2" required></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="subject" required></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Message" name="message" required></p>
            <input type="submit" name="feedback" class="w3-button w3-block w3-black" value="Send">
          </form>
        </div>

        <?php
          $email = '';
          if(isset($_POST['feedback']))
          {
            $name2 = isset($_POST['name2']) ? $_POST['name2'] : '';
            $email2 = isset($_POST['email2']) ? $_POST['email2'] : '';
            $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
            $message = isset($_POST['message']) ? $_POST['message'] : '';

          if ($name2!="" && $email2!="" && $subject!="" && $message!="")
          {
            $query3 = "INSERT INTO feedback VALUES ('$name2','email2','subject','message')" ;
            $data3 = mysqli_query($conn,$query3);

            if($data3)
            {
              echo "<script>alert('Thank You')</script>" ;
            } 
            else 
              echo "Something Wrong!!";
          }
        }
        ?>

        <div class="w3-col s4 w3-margin-top">
          <h4> Group Members Name </h4>
          <p>Vivek Kashyap</p>
          <p>Sumit Singh</p>
          <p>Sudhanshu Kumar</p>
          <br>
          <h4>About</h4>
          <p>We Are Happy to help</p>
        </div>

        <div class="w3-col s4 w3-justify w3-margin-top">
          <h4>Online Store</h4>
          <p><i class="fa fa-fw fa-map-marker"></i> Company Name</p>
          <p><i class="fa fa-fw fa-phone"></i> 9907****86</p>
          <p><i class="fa fa-fw fa-envelope"></i> mailmeyourvision@gmail.com</p>
          <h4>We accept</h4>
          <p><i class="fa fa-fw fa-cc-amex"></i> Paytm</p>
          <p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
          <p><i class=""></i> ----Work in Progress-----</p>
          <br>
        </div>
      </div>
    </footer>

    <div class="w3-black w3-center w3-padding-24 w3-margin-top"> &copy; Copyright 2018 | The Originals </div>

    <!-- End page content -->
  </div>

  <script>
  // Drop down Menu on sidebar 
  function myAccFunc() {
      var x = document.getElementById("demoAcc");
      if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
      } else {
          x.className = x.className.replace(" w3-show", "");
      }
  }

  // Click on the "Electronics" link on page load to open the accordion for submenu
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
