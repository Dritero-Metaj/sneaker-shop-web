<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = $conn->prepare("INSERT INTO `user`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $cpass, $image]);
         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered succesfully!';
            header('location:user.php');
         }
      }
   }

}


session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select = $conn->prepare("SELECT * FROM `user` WHERE email = ? AND password = ?");
   $select->execute([$email, $pass]);
   $row = $select->fetch(PDO::FETCH_ASSOC);

   if($select->rowCount() > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:adminPage.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:adminPage.php');

      }else{
         $message[] = 'no user found!';
      }
      
   }else{
      $message[] = 'incorrect email or password!';
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



    <style>

    </style>
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



  
    
    <section class="user" id=user>   
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" name="register" method="post">
                <h1>Create Account</h1>
                
                <input type="text" id="name"  name="name"required placeholder="Name" />
                <span id='validate-user'></span>
                <input type="email"  name="email" required placeholder="Email" />
                <input type="password" id="password" name="pass" required placeholder="Password" />
                <span id='validatepass'></span>
                <input type="password" id="checkpassword" name="cpass" required placeholder="Confirm Password" />
                
                <input type="file" name="image" required class="box" accept="image/jpg, image/png, image/jpeg">
                 <p>Already have an account? <a href="user.php">Login now</a></p>
     
               <input type="submit" value="register now" id="signupbtn" name="submit"> 
  
               
               <!-- <button  name="register" >Sign Up</button>   class="btn"-->
    
            </form>
        </div>




        <div class="form-container sign-in-container">
            <form action="#" name="login" method="post">
                <h1>Sign in</h1>
            
                <input type="email" name="email" required  placeholder="Email" />
                <input type="password" name ="pass" required placeholder="Password" />
            


                <p>Don't have an account? <a href="user.php">Register now</a></p>
                
                <input type="submit" value="Login now" id="signinbtn" name="submit">


               <!-- <button  name="login" class="btn" >Sign In</button>-->
            </form>
        </div>




        
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, there!</h1>
                    <p>If you want to benefit more from us, please Sign Up!</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    
        </section>
         <!--footer-->
    
        
    
  
    <script type="text/javascript" src="js.js"></script>
    




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

    <script type="text/javascript">
        //hide and show--toggle, dmth checks for visibility
        //scrollY-property of the Window interface, kthen numrin e pixel-ave qe dokumenti eshte currently scrolled vertikalisht ne nje dritare
        //If the document isn't scrolled at all up or down, then scrollY is 0... bon edhe pa ata?
        window.addEventListener('scroll',function(){
            const header= document.querySelector('header');
            header.classList.toggle("sticky",window.scrollY>0)
        })
        </script>

    </body>

</html>