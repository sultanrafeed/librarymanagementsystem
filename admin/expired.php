<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		
        .srch
		{
			padding-left: 70%;

		}
		.form-control 
    {
      width: 200px;
      height: 40px;
      background-color: #black;
      color: black;
    }

		body {
			background-image: url("images/issue_info.jpg");
            background-repeat: no-repeat;
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
  background-color: #222;
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
  color: white;
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
  padding-left: 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
	margin-left: 20px;
}
.h:hover
{
	color:white;
	width: 300px;
	height: 50px;
	background-color: #00544c;
}
.container
{
	height: 800px;
  width: 85%;
	background-color: black;
	opacity: .8;
	color: white;
  margin-top: -65px;
}
.scroll	
 {
     width:100%;
     height:400px;
     overflow:auto;
 }  
 th,td
 {
     width: 10%;
 }

</style>

</head>
</body>
    <!--_________________sidenav_______________-->

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


 <div class="h"> <a href="books.php">Books</a> </div>
 <div class="h"> <a href="request.php">Book Request</a></div>
 <div class="h"> <a href="issue_info.php">Issue Information</a></div>
 <div class="h"> <a href="expired.php">Expired List</a></div>
</div>

<div id="main">
 
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() { 
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
<div class="container">
  
     <?php    
        if(isset($_SESSION['login_user']))
        {
          ?> 

          <div style="float: left; padding: 25px">
          <form method="post" action=""> <!-- adding buttons inside the form-->
          <button name="submit2" type="submit" class = "btn btn-default" style="background-color: green ; color: white;">RETURNED</button>
           &nbsp&nbsp
              <button name="submit3" type="submit" class = "btn btn-default" style="background-color: red ; color: white;">EXPIRED</button>
            </form>
              </div>

              <div class="srch" >
              <br>
                <form method="post" action="" name="form1">
                <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                <input type="text" name="bookID" class ="form-control" placeholder="BID" required=""><br>
                <button class="btn btn-default" name="submit" type="submit">Submit</button><br>
                </form>
            </div>
         <?php

          if(isset($_POST['submit']))
          {
            $var1 = '<p style="color:yellow; background-color:green;">RETURNED</p>'; 
            mysqli_query($db,"UPDATE issue_book SET approve_status='$var1' where username='$_POST[username]' and  bookID='$_POST[bookID]' "); 
           
            mysqli_query($db, "UPDATE books SET quantity = quantity+1 WHERE bookID='$_POST[bookID]';");
          }
        }
   
    $c=0;

      
          $ret = '<p style="color:yellow; background-color:green;">RETURNED</p>'; 
          $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
           
          if(isset($_POST['submit2']))
            {
                $sql="SELECT student.username,studentID, books.bookID,bookname,authorname,edition,approve_status,issue_date,issue_book.return_date FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookID=books.bookID WHERE issue_book.approve_status ='$ret'  ORDER BY issue_book.return_date DESC";
                $res=mysqli_query($db,$sql);
            }
            else if(isset($_POST['submit3']))
              {
                $sql="SELECT student.username,studentID, books.bookID,bookname,authorname,edition,approve_status,issue_date,issue_book.return_date FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookID=books.bookID WHERE issue_book.approve_status ='$exp' ORDER BY issue_book.return_date DESC";
                $res=mysqli_query($db,$sql);
              }
              else
              {
                $sql="SELECT student.username,studentID, books.bookID,bookname,authorname,edition,approve_status,issue_date,issue_book.return_date FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookID=books.bookID WHERE issue_book.approve_status !='' AND issue_book.approve_status !='Yes' ORDER BY issue_book.return_date DESC";
                $res=mysqli_query($db,$sql); 
              }
 
            echo "<table class='table table-bordered table-hover' style='width:100%;' >";
              //Table header
                
                echo "<tr style='background-color: #6db6b9e6;'>";
                echo "<th>"; echo "Username";  echo "</th>";
				echo "<th>"; echo "Roll No";  echo "</th>";
				echo "<th>"; echo "BID";  echo "</th>";
				echo "<th>"; echo "Book Name";  echo "</th>";
				echo "<th>"; echo "Authors Name";  echo "</th>";
				echo "<th>"; echo "Edition";  echo "</th>";
                echo "<th>"; echo "Status";  echo "</th>";
				echo "<th>"; echo "Issue Date";  echo "</th>";
                echo "<th>"; echo "Return Date";  echo "</th>";
               
                    echo "</tr>";
                   echo "</table>";
    
                 echo "<div class='scroll'>";  
                 echo "<table class= 'table table-bordered' >";
               while($row=mysqli_fetch_assoc($res))
            {
                   echo "<tr>";
				echo "<td>"; echo $row['username']; echo "</td>";
				echo "<td>"; echo $row['studentID']; echo "</td>";
				echo "<td>"; echo $row['bookID']; echo "</td>";
				echo "<td>"; echo $row['bookname']; echo "</td>";
				echo "<td>"; echo $row['authorname']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
                echo "<td>"; echo $row['approve_status']; echo "</td>";
				echo "<td>"; echo $row['issue_date']; echo "</td>";
                echo "<td>"; echo $row['return_date']; echo "</td>";
                echo"</tr>";
            }
    echo "</table>";
     echo "</div>"; 
  
    ?>
 </div>
</div>
</body>
</html>