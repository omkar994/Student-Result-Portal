<?php

session_start();

$uname = $_POST["uname"];


error_reporting(0);

$connect = mysqli_connect("localhost","root","") or die(mysqli_error());  
mysqli_select_db($connect,"marksheet") or die(mysqli_error());

if ($connect){
$select = "SELECT * FROM student WHERE  uname='$uname'";
$extract = mysqli_query($connect,$select);


while ($row = mysqli_fetch_assoc($extract)) 
{
    $name = $row["name"];
    $usrname = $row["uname"];
    $email = $row["email"];
    $paswd  = $row["password"];
    $phpm = $row["phpm"];
    $mysqlm = $row["mysqlm"];
    $htmlm = $row["htmlm"];
    $tmo = $row["tmo"];
    $tm = $row["tm"];
    $percentage = $row["percentage"];
        
}


mysqli_close($connect);
}

if((isset($_POST['submit']) and ($usrname == $_POST["uname"]) and ($paswd == md5($_POST['pswd']))))
{
$_SESSION['uname'] = $_POST["uname"];
echo "<p style='text-align:center;'><strong>RESULT</strong></p><br>";
print('
<table border="1" style="margin-left: auto; margin-right: auto; border-collapse: collapse; width: 46.3577%; height: 438px;" height="366">
<tbody>
<tr style="height: 17px;">
<td style="width: 71.5936%; height: 36px; text-align:center;" colspan="4"><strong>MARKSHEET</strong></td>
</tr>
<tr style="height: 17px;">
<td style="width: 71.5936%; height: 95px;" colspan="4">
<p><strong>&nbsp;Name:&nbsp;'.$name.' &nbsp; &nbsp; </strong></p>
<p><strong>&nbsp;Email: '.$email.'</strong></p>
</td>
</tr>
<tr style="height: 17px;">
<td style="width: 1.50602%; height: 46px; text-align:center;"><strong>Serial No.</strong></td>
<td style="width: 31.9134%; height: 46px; text-align:center;"><strong>Subject</strong></td>
<td style="width: 22.1938%; height: 46px; text-align:center;"><strong>Marks Obtained</strong></td>
<td style="width: 15.9804%; height: 46px; text-align:center;"><strong>Total Marks</strong></td>
</tr>
<tr style="height: 17px;">
<td style="width: 1.50602%; height: 51px; text-align:center;"> 1</td>
<td style="width: 31.9134%; height: 51px; text-align:center;">PHP</td>
<td style="width: 22.1938%; height: 51px; text-align:center;"> '.$phpm.' </td>
<td style="width: 15.9804%; height: 51px; text-align:center;">100</td>
</tr>
<tr style="height: 17px;">
<td style="width: 1.50602%; height: 53px; text-align:center;"> 2</td>
<td style="width: 31.9134%; height: 53px; text-align:center;">MYSQL</td>
<td style="width: 22.1938%; height: 53px; text-align:center;">'.$mysqlm.'</td>
<td style="width: 15.9804%; height: 53px; text-align:center;">100</td>
</tr>
<tr style="height: 17px;">
<td style="width: 1.50602%; height: 17px; text-align:center;">3</td>
<td style="width: 31.9134%; height: 17px; text-align:center;">HTML</td>
<td style="width: 22.1938%; height: 27px;" rowspan="2">
<p>&nbsp; &nbsp;&nbsp; </p>
<p style="text-align:center;">'.$htmlm.'</p>
<p></p>
<hr style="border-top: 1px solid black; text-align:center;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total:</strong>'.$tmo.'<br><br></td>
<td style="width: 15.9804%; height: 27px;" rowspan="2">
<p>&nbsp; &nbsp;</p>
<p style="text-align:center;">100</p>
<p></p>
<hr style="border-top: 1px solid black;" /><strong>&nbsp;&nbsp;&nbsp;Total:&nbsp;</strong>'.$tm.'<br><br></td>
</tr>
<tr style="height: 17px;"></tr>
</tbody>
</table>
<p></p> ');


if ($percentage > 60)
{
    echo "<h4 style='text-align:center;'>Congratulations $name. You have secured $percentage%.</h4>. ";
}

echo "<br><a href='sendmail.php' style='margin-left:620px;'>E-mail your result</a>.<br><br><br>";
print ('<div style="text-align:center;">
        <form action="slogin.php" method="POST">
        <input type="submit" name="login" value="Logout">
        </form></div>');

}

else
{ 
  echo "<script>alert('Invalid Username Or Password')</script>";
  echo "<script>location.href='slogin.php'</script>";
}
?>