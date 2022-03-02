<?php
// Start the session
include("process.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="cont">
    <div class="sig">Sign up</div>
    <div class="signtxt">Already have an account? <a href="./index.php" style="color: #4596d2;text-decoration: none;font-weight: 700;">Sign In</a></div>
    <form  name="myform" method="POST" action="./process.php" >
        <label for="">Email</labelSuccessfully Registered>
        <br>
        <input class="as1" type="email" name="email" value="" required>
        <br>
        <label for="">Password</label>
        <br>
        <input class="as1" type="password" name="Password" required>
        <br>
        <label for="for digit number">Secret Code</label>
        
        <br>
        <input class="as1" type="number" placeholder="       Enter 4 digit numbers" maxlength="4" max="9999"name="secret" required>
        <br>
        <button id="btn1" name="signup" type="submit"><i style="float: left;font-size: 18px;margin-left: 10px;" class="fa fa-lock"></i> Sign Up</button>
        <br>
        <p for="" class="frgt1">By clicking the "Sign Up" button,you are creating an account, and you agree to the Terms of Use .</p>
        <?php
         $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         if(strpos($url,"sign=sucess")==true)
         {
             echo "<p style='color:green;margin-left: 10px;text-align: center;' class='rpl_msg'>Successfully Registered, please click <span style='color:#4596d2;'>Sign In </span> buttton </p>";
         }
         if(strpos($url,"sign=repeat")==true)
         {
             echo "<p style='color:red;margin-left: 45px;' class='rpl_msg'>This Email Already Exists </p>";

         }
    
    ?>
        
        
    </form>
   <?php
   
   
   ?>
</div>
</body>
</html>
<?php
 unset($_SESSION['user_id']);  
 session_destroy();  
?>