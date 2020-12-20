<?php
session_start();
error_reporting(0);

if((isset($_POST['submit'])))
{
  $_SESSION['uname'] = $_POST["uname"];

  print('
   <div style="text-align:center;">
   <form action="insert.php" method="post">
   <input type= "text" placeholder="Name" name="name" required><br><br>
   <input type= "text" placeholder="Username" name="uname" required><br><br>
   <input type "email" placeholder="Email" name="email" required><br><br>
   <input type= "password" placeholder="Password" name="pswd" required><br><br>
   <input type= "password" placeholder="Confirm Password" name="cpswd" required><br><br>
   <label>PHP Marks: </label>
   <input type = "number" min="0" max="100"  name="phpm" required><br><br>
   <label>MSQL Marks: </label>
   <input type = "number" min="0" max="100"  name="mysqlm" required><br><br>
   <label>HTML Marks: </label>
   <input type = "number" min="0" max="100"  name="htmlm" requied><br><br><br>
   <input type= "submit" name="insert" value="Insert">
   </form><div>');
 
   print ('<div style="text-align:center;">
  <form action="admin.php" method="POST">
  <input type="submit" name="submit" value="Home">
  </form></div>');


}

elseif((isset($_POST['insert']))){
  
  $_SESSION['uname'] = $_POST["uname"];
   $pswd = @$_POST["pswd"];
   $cpswd = @$_POST["cpswd"];
   
   $email = @$_POST["email"];
   
   if (!filter_var(@$email, FILTER_VALIDATE_EMAIL)) {
     echo "Invalid email format<br>Please insert data again<br>";
     print(' 
         <form action = "insert.php" method="post">      
         <input type="submit" value="insert" name="insert">
         </form> ');
   
     exit(0);
   }
   
   if ($pswd != $cpswd) {
      echo "Password and Confirm password should match!<br>";
      echo "<br>Please insert data again<br><br>";  
      print(' 
         <form action = "insert.php" method="post">      
         <input type="submit" value="insert" name="insert">
         </form> ');
   
      exit(0);
     }
   
   $connect = mysqli_connect("localhost","root","") or die(mysqli_error());  
   mysqli_select_db($connect,"marksheet") or die(mysqli_error());
   
   if($connect)
   {
     $name = $_POST["name"];
     $uname = $_POST["uname"];
     $email = $_POST["email"];
     $pswd = $_POST["pswd"];
     $phpm = $_POST['phpm'];
     $mysqlm = $_POST['mysqlm'];
     $htmlm = $_POST['htmlm'];
     $tmo = $phpm + $mysqlm + $htmlm;
     $tm = 300;
     $percent = ($tmo / $tm) * 100 ;
   
     
     $insert = "INSERT INTO student VALUES ('$name','$uname','$email','$pswd','$phpm','$mysqlm','$htmlm','$tmo','$tm','$percent')";
     $write = mysqli_query($connect,$insert) or die(''.$uname.' is already taken by another user. Please select another username.<br><br>
     <form action = "insert.php" method="post">      
     <input type="submit" value="Insert" name="insert">
     </form>');
   
     if ($write)
     {
         echo '<p style="text-align:center">Record inserted successfully!!</p><br><br>';
         
   
     }
     else{
         
       echo "Oops failed to stored the data";
     }
   
     mysqli_close($connect);
   }
 
   print ('<div style="text-align:center;">
  <form action="admin.php" method="POST">
  <input type="submit" name="submit" value="Home">
  </form></div>');

  
}

else
  { 
    echo "<script>alert('Invalid Username Or Password')</script>";
    echo "<script>location.href='alogin.php'</script>";
  }

?>