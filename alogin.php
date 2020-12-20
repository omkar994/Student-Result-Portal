<?php


    print('<h3><a href="index.php" style="text-align:center;">Home</a></h3><br><br><br>');
    //please use print function as we are creating html form inside php script
    print('
   <div style="text-align:center;">
   <p><b>Login</b></p><br>
   <form action="admin.php" method="post">
   <input type= "text" placeholder="Username" name="uname" required><br><br>
   <input type= "password" placeholder="Password" name="pswd" required><br><br>
   <input type= "submit" name="submit">
   </form><div> '); 




?>