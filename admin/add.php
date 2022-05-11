<?php
  include "connection.php";
  include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        .srch
        {
            padding-left: 1000px;
       
        }

        body {
background-color: #acddad;
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top: 50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle 
{
    margin-left: 10px;
}
.h:hover
{
    color:white ;
    width: 300px;
    height: 50px;
    background-color: #c1abd7;
}
  
.book 
{
    width: 400px;
    margin: 0px auto;
}
/*.form-control
{
   background-color: #080707;   basically the background color of the text box
   color: white;
  height: 40px;
  } */

    </style>


</head>
<body>
    <!-----------------------_______sidenav_________-->

    <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  
                    <div style="color: white; margin-left: 80px; font-size: 20px;">
                        
                    <?php
                    if(isset($_SESSION['login_user']))

                {   echo "<img class='img-circle profile_img' height= 100 width=100 src='images/". $_SESSION['pic']."  '>";
                    echo "</br></br>";

                    echo "Welcome   ".$_SESSION['login_user'];
                        }
                        ?>
                   </div><br><br>

 <div class="h"> <a href="add.php">Add New Books</a> </div>
 <div class="h"> <a href="delete.php">Delete Books</a></div>
 <div class="h"> <a href="#">Book Request</a></div>
 <div class="h"> <a href="#">Issue Information</a></div>
</div>

<div id="main">
 <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
<div class="container" style="text-align: centre;">          
  <h2 style="color:black; font-family: Lucida Console; text-align:center"><b>Add New Books</b></h2>  

  <form  class="book" action="" method="post">
   
    <input type="text" name="bookID" class="form-control" placeholder="Book ID" required=""><br> 
    <input type="text" name="bookname" class="form-control" placeholder="Book Name" required=""><br>
    <input type="text" name="authorname" class="form-control" placeholder="Authors Name" required=""><br>
    <input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
    <input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
    <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
    <input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
 
    <button style="text-align: centre;" class="btn btn-default" type="submit" name="submit">ADD</button>
  </form> 
</div>
<?php
  if(isset($_POST['submit']))
{
  if(isset($_SESSION['login_user']))
  {
    mysqli_query($db,"INSERT INTO books VALUES ('$_POST[bookID]', '$_POST[bookname]', '$_POST[authorname]', '$_POST[edition]','$_POST[status]','$_POST[quantity]', '$_POST[department]')  ;");
    ?>
    <script type="text/javascript">
      alert("Book Added Successfully.");
    </script>
  
    <?php

}
  else
  {
    ?>
      <script type="text/javascript">
        alert("You need to login first.");
      </script>
  <?php
  }
}
?>
</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() { 
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#acddad";
}
</script>

</body>
