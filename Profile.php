<head>
    <title>Company Profile Page</title>
</head>
<?php
  
$con=  mysqli_connect("localhost","root","");
mysqli_select_db($con, "to2tphp");
session_start();

$uname=$_SESSION['UserName'];
$password=$_SESSION['Password'];

$profile_query="select * from company where UserName='$uname' && Password='$password'";
$res=mysqli_query($con, $profile_query);
$row=mysqli_fetch_assoc($res);

echo '<h2 style="text-align: left; color:#3333ff; font-size:30px; margin-top:50px; margin-left:50px;">Welcome....   '.'<b>'.$row['UserName'].'</b>'.'</h2>';
echo '<p style="margin-left:50px"><img src="data:image/jpeg;base64, '. base64_encode($row['Image']).'"/> </p>';
echo '<a href="logout.php">'
        . '<button style="margin-left:50px; height:50px; width:80px;">'.'LOGOUT'.'</button>'
    . '</a>';
?>