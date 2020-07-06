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
$sql = "SELECT * FROM product";

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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="jquery-1.11.1.min.js"></script>

  <style>
    .w3-sidebar a {font-family: "Roboto", sans-serif}
    body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
  </style>

  

</head>

<body class="w3-content" style="max-width:1200px">
<div>
  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3; width:200px" id="mySidebar">
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
      <p class="w3-left">Products</p>
      <p class="w3-right">
        <?php echo "Hello ".$_SESSION['email']."..." ?>
        <a href="logout.php" title="Logout"><i class="fa fa-sign-out w3-margin-right"></i></a>
        <a href="#mycart"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
      </p>
    </header>

    <!-- Image header -->
    <div class="w3-display-container w3-container">
      <img src="img/banner.jpg" alt="banner" style="height:500px; width:100%">
      <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
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
                      <div class='w3-container'>
                        <div class='w3-display-container'>
                          <img src='".$row["source"]."' style='width:200px; height:250px'>
                          <div class='w3-display-middle w3-display-hover'>
                              <button class='w3-button w3-black addtocart' id='cname". $row["proid"]."' >Add To Cart <i class='fa fa-shopping-cart'></i></button>
                          </div>
                        </div>
                        <p><span id='". $row["name"]."'>". $row["name"]."</span><br><b>". $row["newamount"] ." </b><br><strike> ". $row["oldamount"] ." </strike></p>
                      </div>
                    </div>
                  ";
              }
              // Free result set
              mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
      ?>

      <script>
          <script>
            $('.addtocart').on('click', function(){
              var sub = document.getElementById(‘cname1’);
              var txtVal = document.getElementById(‘<?php echo $row["name"]?>’).value;
              document.write('txtVal');
              sub.innerHTML = “Entered Text is “+txtVal;
            });
        </script>

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
        $que = "INSERT INTO subscribe VALUES ('$email')" ;
        $data2 = mysqli_query($conn,$que);

        if($data2)
          echo "<script>alert('You are Subscribed')</script>" ; 
        else 
          echo "Something Wrong!!"; 
      }
      }
    ?>

    <div id="mycart">
      <!-- checkout -->
      <div class="checkout">
        <h3 class= "" data-wow-delay=".5s">Your shopping cart contains: <span>1 Products</span></h3>
        <div class="checkout-right" data-wow-delay=".5s">
          <table class="w3-table-all">
            <thead>
              <tr>
                <th>Product ID</th> 
                <th>Image</th>
                <th>Quality</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tr class="rem1" style="display: non;">
              <td><span><?php echo $row['proid']; ?></span></td>
              <td><a href="single.html"><img src="<?php $row['source'] ?>" alt=" " class="img-responsive" /></a></td>
              <td>
                <div class="w3-row">
                    <button class='w3-button value-minus'> - </button>
                    <button class='w3-button value' type="number"> <span>1</span> </button>
                    <button class='w3-button value-plus'> + </button>
                </div>
              </td>
              <td><span id="cname"></span></td>
              <td><span><?php $row['newamount'] ?></span></td>
              <td>
                <div class=" rem">
                  <div class="close"> <input type="button" name="" value="Remove"> </div>
                </div>
                <script>$(document).ready(function(c) {
                  $('.close').on('click', function(c){
                    $('.rem1').fadeOut('slow', function(c){
                      $('.rem1').remove();
                    });
                    });   
                  });
                 </script>
              </td>
            </tr>
            
          <!--quantity-->
            <script>
            $('.value-plus').on('click', function(){
              var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
              divUpd.text(newVal);
            });

            $('.value-minus').on('click', function(){
              var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
              if(newVal>=1) divUpd.text(newVal);
            });
            </script>
          <!--quantity-->
          </table>
        </div>
  </div>
  </div>
    <script>
      $(document).ready(function(c) {
        $('#alert_close').on('click', function(c){
          $('#message').fadeOut('slow', function(c){
              $('#message').remove();
          });
        });   
      });
    </script>
    
    <!-- Footer -->
    <footer class="w3-margin-top w3-padding-50 w3-light-grey w3-small w3-center" id="footer">
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
            $query3 = "INSERT INTO feedback VALUES ('$name2','$email2','$subject','$message')" ;
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
  // Accordion 
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


<?php
  } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
?>
