<?php
include("process.php");
    
    
    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    } 
    else {
        $email_id=$_SESSION['user_id'];
        $query1 = "SELECT * from contact where email_id='$email_id'";
        $result= mysqli_query($con, $query1);
    }
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
                        <div class="sig1">Contact Form and Contact List Page</div>
                        <div class="conta">
                            <div class="signtxt1">Add Contacts</div>
                            <form action="./process.php" method="POST">
                            <label for="">Name</label>
                            
                            <input class="as2" name="name1" type="text" required>
                            <br>
                            <label for="">Ph No</label>
                            
                            <input class="as2" type="number" maxlength="10" max="9999999999" name="phone" required >
                            
                            <label for="">Email</label>

                            <input class="as2" type="email" name="email"  required>
                            <br>
                            <button id="btn2" onclick="location.href='./index.php'" style="float: left;background:#a80404"name="logout"> logout</button>
                            <button id="btn2" name="record" type="submit"> save</button>
                            <br>
                            <?php
                                $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                if(strpos($url,"data=sucess")==true)
                                {
                                    echo "<p style='color:green;margin-left: 40px;margin-top: 20px;text-align: center;' class='rpl_msg'>Successfully saved</p>";
                                }
                                if(strpos($url,"data=failed")==true)
                                {
                                    echo "<p style='color:red;margin-left: 50px;margin-top: 20px;' class='rpl_msg'> Failed to save data </p>";

                                }
                                if(strpos($url,"data=repeat")==true)
                                {
                                    echo "<p style='color:red;margin-left: 50px;margin-top: 20px;' class='rpl_msg'> This Data Already Exists  </p>";

                                }
                            ?>
                            
                        </form>
                    </div>
                    <div class="con2">
                        <label for="" class="cntct">My Contacts</label>
                        <table id="contact">
                            <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        
                        while($res=mysqli_fetch_array($result))
                        {
                           echo '<tr>';
                            echo '<td>'.$res['name'].'</td>';
                            echo '<td>'.$res['phone'].'</td>';
                            echo '<td>'.$res['email'].'</td>';
                            echo '</tr>';
                        }

                        ?>
                        
                        
                        </table>
                    </div>
                    </body>
                    </html>

    
    
