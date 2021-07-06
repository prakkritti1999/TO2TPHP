<form action="mail.php">
    <input type="email" placeholder="enter your email id" name="email">
    <button name="reset">Reset Password</button>
</form>
<?php
    $connect=  mysqli_connect("localhost", "root", "");
    mysqli_select_db($connect, "to2tphp");
    session_start();

    if(isset($_POST['reset'])){
    
    $email=$_POST['email'];
    
    $forgotquery="select * from company where Email_ID='$email'";
    $res=mysqli_query($connect, $forgotquery);
    $row=  mysqli_fetch_assoc($res);
    
    $compname=$row['CompanyName'];
    $subject="Forgot Password Mail";
    $headers="From: The Company";
    $pass='1234'.$compname;    
    $body="HELLO...  ".$compname."  We have received a request to reset your password. Your new password is  ".$pass;
    
    if(mail($email, $body, $subject, $headers)){
        
        $alterQuery="Update company set Password='$pass' where UserName='$uname'";
        mysqli_query($connect, $alterQuery);
        echo '<h2>Mail Sent. Password Changed successfully.</h2>';
        header("location: Profile.php");
    }
    else {
        echo 'Failed';
    }
}    
 ?>        
