
<?php

   $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "mango_sneakers";

  try {
     $dsn= "mysql:host=" . $dbHost . ";dbname=" . $dbName; 
    $pdo = new PDO($dsn, $dbUser, $dbPassword); 
    
    /* echo "Connection Successful"; */

  } catch(PDOException $e){  
    echo "DB connection failed: " . $e->getMessage();
  }
  

    

$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  if(empty($name) || empty($email) || empty($message)) {
    $status = "All fields are compulsory.";
  } else {
    if(strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
      $status = "Please enter a valid name";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $status = "Please enter a valid email";
    } else {




        $sql= "INSERT INTO contactus (name, email, message)
        VALUES (:name, :email, :message )";
        $stmt = $pdo->prepare($sql);
            
        $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);



      $status = "Your message was sent";
      $name = "";
      $email = "";
      $message = "";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css"/>

    
</head>
<body>
<header>
        <a href="#" class="logo">𝕸𝖆𝖓𝖌𝖔<span>𝙨𝙣𝙚𝙖𝙠𝙚𝙧𝙨</span></a>
        <ul class="nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="aboutUs.html">About Us</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="offers.html">Offers</a></li>
            <li><a href="user.php">User</a></li>
            <li><a href="collabs.html">Collabs</a></li>
        </ul>
    </header>

    <section class="banner2">


    <section class="contact" id=contact>
        <div class="title3">
            <h2 class="title">Contact Us</h2>
            <p>Any suggestions you have, we are here to hear them. 
               Don't hesitate to reach to us!</p>
        </div>




        </section>

        
        <div class="container">

    <form action="" method="POST" class="main-form">
      <div class="form-group">
        <!-- <label for="name">Full Name</label>  -->
        <input type="text" name="name" placeholder="Name" id="name" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $name ?>">
      </div>

      <div class="form-group">
       <!--     <label for="email">Email</label>       -->
        <input type="text" name="email" placeholder="Email" id="email" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $email ?>">
      </div>

      <div class="form-group">
        <!--      <label for="message">Your Message</label>      -->
        <textarea name="message" placeholder="Message" id="message" cols="30" rows="10"
          class="gt-input gt-text"><?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $message ?></textarea>
      </div>

      <input type="submit" class="gt-button" value="Submit">

      <div class="form-status">
        <?php echo $status ?>
      </div>
    </form>
  </div>



</section>

<footer>
    <div class="footer-div">   
       <ul class="navv">
   <li><a href="#bannerr">Privacy Policy</a></li>
   <li><a href="#about">Terms of sale </a></li>
   <li><a href="contactUs.html">Social Media</a></li>
   <li><a href="#treatment">Offers</a></li>
   <li><a href="#user">User</a></li>
   </ul> 
</div>
</footer>


<script src="JS.js"></script>    

<script type="text/javascript">
    //hide and show--toggle, dmth checks for visibility
    //scrollY-property of the Window interface, kthen numrin e pixel-ave qe dokumenti eshte currently scrolled vertikalisht ne nje dritare
    //If the document isn't scrolled at all up or down, then scrollY is 0... bon edhe pa ata?
    window.addEventListener('scroll',function(){
        const header= document.querySelector('header');
        header.classList.toggle("sticky",window.scrollY>0)
    })
    </script>



    <script src='https://code.jquery.com/jquery-3.2.1.min.js'>
    </script>

    <script>
        $('.message a').click(function(){$('form').animate({height: "toggle",opacity: "toggle"},"slow");});
    </script>



</body>
</html>

