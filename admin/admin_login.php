<?php
   include "connection.php";  
   include "navbar.php"; /*linking to the page*/
?>

<!DOCTYPE html>
<html>
<head>
   
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="uff-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type = "text/css">
        section
        {
           margin-top:-20px;
        }    
    </style> 
</head>
<body>

<section>
    <div class="log_img">
        <br>
        <div class="box1">
            <h1 style ="text-align: centre; font-size: 35px;font-family: Lucida Console;"> RS Library Management System </h1>
            <h1 style="text-align: centre;font-size:25px;"> User Login form</h1><br>
          <form name="login" action ="" method="post">
                 
            <div class="login">  
              <input class="form-control" type ="text" name="username" placeholder="Username" required=""> <br>
              <input class="form-control" type="password"  name="password" placeholder="Password" required=""> <br>
              <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 70px; height: 30px">
            </div>
          
          <p style="color: white; padding-left: 15px;">
            <br><br>
            <a style="color:white ;" href="">Forgot Password?</a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            New to this website? <a style="color: white;" href="registration.PHP">Sign Up</a>
          </p>
        </form>
        </div>
    </div>
</section>

    <?php

     if(isset($_POST['submit']))
      {
        $count=0; /*variable count to keep track of this that how many rows have matched our username and password*/ 
        $res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' && password='$_POST[password]';"); /*this will select a row but now we will count how many rows have matched*/

        $row= mysqli_fetch_assoc($res);
        
        $count=mysqli_num_rows($res); /*this will give us the number of rows that has matched with the username and password that the user has inputted.*/
      
       if($count==0)         /*value of count will use to show that message that someone has logged in or not. value =0 is no username and password is matched with the user inputted*/
       {
         ?>
         <!-- 
           <script type="text/javascript">
           alert("The Username and Password doesn't match!"); 
          </script> 
        --> 
        <div class="alert alert-danger" style="width: 700px; margin-left: 600px">
        <strong>The Username and Password doesn't match!</strong>
        </div>
        <?php
       }
       else
       {
         /*----------- if username & password matches-----*/

         $_SESSION['login_user'] = $_POST['username'];
          $_SESSION['pic']= $row['pic'];

         ?>
         <script type="text/javascript">
           window.location="index.php"
         </script>
         <?php

       }
    }  

    ?>    

</body>
</html>  