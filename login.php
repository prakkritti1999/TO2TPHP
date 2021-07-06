<?php
    $con=  mysqli_connect("localhost", "root", "");
    mysqli_select_db($con, "to2tphp");
    session_start();
    
    if(isset($_POST['login'])){
        $_SESSION['UserName']=$_POST['uname'];
        $uname=$_SESSION['UserName'];
        
        $_SESSION['Password']=$_POST['password'];
        $pass=$_SESSION['Password'];
        
        $login_valid="Select * from company where UserName= '$uname' && Password='$pass'";
        $result= mysqli_query($con, $login_valid);
        $row= mysqli_fetch_assoc($result);
        
        if($row['UserName']==$uname && $row['Password']==$pass ){
            header("location: Profile.php");
        }
        else {
            echo '<script>alert("Incorrect User Name or Password");window.location="login.php"</script>';
        }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN for The Other2 Thirds Consulting LLP</title>
        <link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/bootstrap/js/jQuery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            #div2{
                margin-top: 80px;
                margin-left: 300px;
                width: 600px;
                padding-top:  40px;
                padding-bottom: 40px;
                padding-left: 70px;
            }
            .panel{
                background-color: white;
                border: 10px solid plum;
                border-radius: 20px;
            }
            .panel-heading{
                background-color: white!important;
                height: 70px; 
                padding-bottom: 60px; 
                padding-top: 5px;
            }
            .panel-footer{
                background-color: white!important;
            }
            #h2{
                text-align: center;
                font-size: 20px;
            }
            body{
                background-color:whitesmoke;
            }
            button{background-color: blue;color: white;}
            .btn:hover{
                color: white;
                text-decoration: none;
            }
            .btn{
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container" id="div2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 id="h2">Login for <b>The Other2 Thirds Consulting LLP</b></h2>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="login.php">
                                <div class="form-group">
                                    <label>UserName:</label>
                                    <input type="text" placeholder="Enter User Name" name="uname" required="true" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" placeholder="Enter Password" name="password" required="true" class="form-control">
                                </div>
                                <button class="btn btn-block" name="login">Login</button>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <h4><a href="mail.php" target="_self" name="forgot"> Forgot Password?</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>