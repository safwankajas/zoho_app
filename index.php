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
    <div class="sig">Sign In</div>
    <div class="signtxt">Don't have an account? <a href="./signup.php" style="color: #4596d2;text-decoration: none;font-weight: 700;">Sign Up</a></div>
    <form action="./process.php" method="POST">
        <label for="">Email</label>
        <br>
        <input id="user"class="as" type="text" name="email" required>
        <br>
        <label for="">Password</label>
        <br>
        <input id="password"class="as" type="password" name="password" required>
        <br>
        <label for="" class="frgt">Forgot your password?</label>
        <br>
        
        <button id="btn" name="login" type="submit"><i style="float: left;font-size: 18px;margin-left: 10px;" class="fa fa-lock"></i> Sign In</button>
        
    </form>
    <?php
    $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($url,"sign=invalid")==true)
        {
            echo "<label class='rpl_msg'>Invalide username and password</label>";
        }
    
    ?>
</div>
</body>
</html>
<?php
 unset($_SESSION['user_id']);  
 session_destroy();  
?>