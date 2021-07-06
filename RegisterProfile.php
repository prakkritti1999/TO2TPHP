<head>
    <title>Company Profile Page</title>
</head>

<?php
$con=  mysqli_connect("localhost","root","");
mysqli_select_db($con, "to2tphp");
session_start();

$compname=$_SESSION['CompanyName'];

$profile_query="select * from company where CompanyName='$compname'";
$res=mysqli_query($con, $profile_query);
$row=mysqli_fetch_assoc($res);
?>

<h2 style="text-align: left; color:#3333ff; font-size:30px; margin-top:50px; margin-left:50px;">Welcome....   <b><?php echo $row['UserName'];?></b>.</h2>
<p style="margin-left:50px"><img src="<?php echo $row['Image'];?> "> </p>;
<?php
echo '<a href="logout.php">'
        . '<button style="margin-left:50px; height:50px; width:80px;">'.'LOGOUT'.'</button>'
    . '</a>';
?>

