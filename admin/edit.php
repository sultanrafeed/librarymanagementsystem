<?php
    include "navbar.php";
    include "connection.php";    
?>
<!DOCTYPE html>
<html>
<head>
    <title>edit profile</title>
    <style type="text/css">
        .form-control
        {
            width: 350px;
            height: 38px;
        }
        .form1
        {
            padding-left: 800px;
        }
        label
        {
            color: black;
        }

    </style>
</head>
<body style="background-color: rgb(241, 233, 233);">
 
    <h2 style="text-align: center;color: #fff;">Edit Information</h2>
    <?php
       
       $sql = "SELECT * FROM admin WHERE username='$_SESSION[login_user]' ";
       $result = mysqli_query($db,$sql) or die (mysql_error());

       while($row= mysqli_fetch_assoc($result)) 
       {
            $firstname=$row['firstname'];
            $lastname=$row['lastname'];
            $username=$row['username'];
            $password=$row['password'];
            $email=$row['email'];
            $contact=$row['contact'];
       }
    
    ?>

    <div class="profile_info" style="text-align: center;">
        <span style="color: white;">Welcome,</span>
        <h4 style="color: white;"><?php echo $_SESSION['login_user']; ?></h4>
    </div><br><br>

<div class="form1">
        <form action="" method="post" enctype="multipart/form-data">

        <input class="form-control" type="file" name="file">

        <label><h4><b>First Name: </b></h4></label>
        <input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>">
        
        <label><h4><b>Last Name: </b></h4></label>
        <input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>">
        
        <label><h4><b>Username: </b></h4></label>
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
        
        <label><h4><b>Password: </b></h4></label>
        <input class="form-control" type="text" name="password" value="<?php echo $password; ?>">
        
        <label><h4><b>Email: </b></h4></label>
        <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
        
        <label><h4><b>Contact: </b></h4></label>
        <input class="form-control" type="text" name="contact" value="<?php echo $contact; ?>">
        
        <br>
        <div style="padding-left: 100px;">
        <button class="btn btn-default" type="submit" name="submit">save</button></div>
    </form>
</div>
    <?php

        if(isset($_POST['submit']))
        {
            move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']['name']);

            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $email=$_POST['email'];
            $contact=$_POST['contact'];
            $pic=$_FILES['file']['name'];

            $sql1 = "UPDATE admin SET pic='$pic', firstname='$firstname', lastname='$lastname', username='$username', password='$password', email='$email', contact='$contact' WHERE username='".$_SESSION['login_user']."';";

            if(mysqli_query($db, $sql1))
            {
                ?>
                    <script type="text/javascript">
                        alert("Saved Successfully.");
                        window.location="profile.php";
                    </script>
                <?php
            }
        }
    ?>
</body>
</html>