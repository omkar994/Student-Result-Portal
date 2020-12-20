<?php

if(isset($_POST["register"]))
{ 
    print('<h3><a href="index.php" style="text-align:center;">Home</a></h3><br><br><br>');
   
    //please use print function as we are creating html form inside php script
       
    print('
   <div style="text-align:center;">
   <p><b>Register</b></p><br>
   <form action="sregister.php" method="post">
   <input type= "text" placeholder="Name" name="name" required><br><br>
   <input type= "text" placeholder="Username" name="uname" required><br><br>
   <input type "email" placeholder="Email" name="email" required><br><br>
   <input type= "password" placeholder="Password" name="pswd" required><br><br>
   <input type= "password" placeholder="Confirm Password" name="cpswd" required><br><br>
   <input type= "submit" name="submit">
   </form><div>');

}

if (@$_POST['submit'])
{

  print('<h3><a href="index.php" style="text-align:center;">Home</a></h3><br><br><br>');

$email = $_POST["email"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid email format<br>Please register again<br>";
  print(' 
      <form action = "sregister.php" method="post">      
      <input type="submit" value="Register" name="register">
      </form> ');

  exit(0);
}

$connect = mysqli_connect("localhost","root","") or die(mysqli_error());  
mysqli_select_db($connect,"marksheet") or die(mysqli_error());

if($connect)
{
  $name = $_POST["name"];
  $uname = ($_POST["uname"]);
  $email = $_POST["email"];
  $pswd = md5($_POST["pswd"]);
  


  
  $insert = "INSERT INTO student VALUES ('$name','$uname','$email','$pswd','','','','','','')"; //marks will be added by admin
  $write = mysqli_query($connect,$insert) or die(''.$uname.' is already taken by another user. Please select another username.<br><br>
  <form action = "sregister.php" method="post">      
  <input type="submit" value="Register again" name="register">
  </form>');

  if ($write)
  {
      echo "You've registered successfully<br><br>";
    
  }
  else{
      
    echo "Oops failed to stored the data";
  }

  mysqli_close($connect);
}






}

?>