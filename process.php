<?php
session_start();

$host = 'localhost';
$uname = 'root';
$pword = '';

$db = 'zoho_app';
// $con = mysqli_connect($host,$uname,$pword);
// Connect to MySQL
$con = new mysqli($host, $uname, $pword);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// If database is not exist create one
if (!mysqli_select_db($con,$db)){
    $sql = "CREATE DATABASE ".$db;
   
    if ($con->query($sql) === TRUE) {
        $con = mysqli_connect($host,$uname,$pword,$db);
        $sql = "CREATE TABLE `users` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `username` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            `secert` varchar(100) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;";
            
        mysqli_query($con, $sql);
        $sql = "CREATE TABLE `contact` (
            `email_id` VARCHAR(30) NOT NULL,
            `email` VARCHAR(30) NOT NULL,
            `name` VARCHAR(30) NOT NULL,
            `phone` VARCHAR(50) NOT NULL
            )";
            
        mysqli_query($con, $sql);
    }
}
else
{
    $con = mysqli_connect($host,$uname,$pword,$db);
}   
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


//----------signin process----------------------

if(isset($_POST['login']))
{
                $Username = $_POST['email'];
                $Password = $_POST['password'];
                
           
            // removes backslashes
            $username = stripslashes($Username);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($con,$username);
            $password = stripslashes($Password);
            $password = mysqli_real_escape_string($con,$password);
            $sql1 = "SELECT * from users where username = '$username'";  
            // decrypted the password from hash
            $password=md5($password);
            $con = mysqli_connect($host,$uname,$pword,$db);
            $result =mysqli_query($con, $sql1) or die(mysql_error()); 
                 
                if (!$result)
                {
                    echo '<p class="error">Username password combination is wrong!</p>';
                } 
                else 
                {
                    $result=mysqli_fetch_assoc($result);
                    if ($password == $result['password']) 
                    {
                        $_SESSION['user_id'] =$username ;
                        header("Location: contact.php");

                    } 
                    else 
                    {
                        header("location: index.php?sign=invalid");
                        
                    }
                }

            
}
//**********************************_singup process_**************************-----------------------------------------------------
if (isset($_POST['signup'])) {
    $secert = $_POST['secret'];
 
    $email = $_POST['email'];
    $email = stripslashes($email);
    $email = mysqli_real_escape_string($con,$email);
 
    $password = $_POST['Password'];
    $password = stripslashes($password);
    $password = mysqli_real_escape_string($con,$password);


    // password and secert code is encrypted by use hash funntion
    $password_hash = md5($password);
    $secert_hash = md5($secert);


    // check the same email in data base
    $sql = "select * from users where username = '$email'";
    $result =mysqli_query($con, $sql) or die(mysql_error());
    $row = mysqli_num_rows($result); 
    if ($row > 0) {
        header("location: signup.php?sign=repeat");
        
    }
    // push the value into database
    if ($row== 0) {
        $query = "INSERT INTO users (secert, username, password)
                  VALUES('$secert_hash', '$email', '$password_hash')";
        mysqli_query($con, $query);
        // Storing username of the logged in user,
        // in the session variable
        // $_SESSION['user_id'] =$email ;
         
        // // Welcome message
        // $_SESSION['success'] = "You have logged in";
         
        // Page on which the user will be
        // redirected after logging in
        header("location: signup.php?sign=sucess");
        // echo '<p class="error">Successfully Registered</p>';
        


    }
}


// -------------------******************contact fill and store in database********************-----------
if (isset($_POST['record']))
{

    $email_id=$_SESSION['user_id'];
    
    $name=$_POST['name1'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    // ---------------avoide repeating data saving--------------
    $sql = "select * from contact where email_id='$email_id' and email = '$email'and phone='$phone'and name='$name'";
    $result =mysqli_query($con, $sql) or die(mysql_error());
    $row = mysqli_num_rows($result);
    // ----------report repeating data------
    if ($row > 0) {
        header("location: contact.php?data=repeat");
        
    }
    // push the value into database
    if ($row== 0) 
    { 

            $query1 = "INSERT INTO contact (email_id, name, phone,email) VALUES('$email_id', '$name', '$phone','$email')";
            $result= mysqli_query($con, $query1);
            if($result)
            {
                header("location: contact.php?data=sucess");
            }
            else
            {
                header("location: contact.php?data=failed");
            }
    }
   

}
?>
