<?php
    include "connection.php";
    include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
   
   <title>Admin Registration</title>
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
    <div class="reg_img">
        
        <div class="box2">
            <h1 style ="text-align: centre; font-size: 35px;font-family: Lucida Console;">&nbsp &nbsp RS Library Management System </h1>
            <h1 style="text-align: centre;font-size:25px;"> User Registration form</h1>
          
            <form name="Registration" action ="" method="post">
           
            <div class="login"> 
              <input class="form-control" type ="text" name="firstname" placeholder="First Name" required=""> <br>
              <input class="form-control" type ="text" name="lastname" placeholder="Last Name" required=""> <br>
              <input class="form-control" type ="text" name="username" placeholder="Username" required=""> <br>
              <input class="form-control" type="password"  name="password" placeholder="Password" required=""> <br>
              <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
              <input class="form-control" type="text" name="contact" placeholder="Phone No" required=""><br>  

              <input class="btn btn-default" type="submit" name="submit" value="Signup" style="color: black; width: 70px; height: 30px"></div>
          </form>
         
        </div>
    </div>
</section>

         <?php 

         if(isset($_POST['submit']))
         {
            $count=0;
            $sql="Select username from `admin`"; /*selecting the username queury to mkae it unique*/
            $res=mysqli_query($db,$sql); /*will show a result and we will run a loop as the username is more than 1*/

            while($row=mysqli_fetch_assoc($res)) /*this wil fetch 1 by 1 of the username registered in*/
            {
               if($row['username']==$_POST['username'])    /*for checking we will if, so each time the user is input*/
                {
                  $count=$count+1;                                              /*we will increment the value of count*/
                }
            }
            if($count==0)
            {
              mysqli_query($db,"INSERT INTO `admin` VALUES('', '$_POST[firstname]', '$_POST[lastname]',  '$_POST[username]',  '$_POST[password]',  '$_POST[email]',  '$_POST[contact]','1.jpg');");
         ?>
         <script type="text/javascript">  /*to show a message when  sign up is complete!*/
          alert("Registration Successful!");   
         </script>
         <?php
            }   
          else 
          {

            ?>
         <script type="text/javascript">  /*to show a message when  sign up is complete!*/
          alert("The Username already exists!");   
         </script>
         <?php   

          }

        }

         ?>

</body>
</html>