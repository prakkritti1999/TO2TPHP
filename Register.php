<?php
    $con=  mysqli_connect("localhost","root","");
    mysqli_select_db($con, "to2tphp");
    session_start();
    
    $error='';
    $email=$gst=$compname='';
    if(isset($_POST['register'])){
        $_SESSION['CompanyName']=$_POST['name'];
        $compname=$_SESSION['CompanyName'];
        
        $email=$_POST['email'];
        
        $gst=$_POST['gst'];
        
        //to upload images to database
        $files=$_FILES['images'];
        $filename=$files['name'];
        $filetmp=$files['tmp_name'];
        $filesext=  explode('.', $filename);
        $fileschk=  strtolower(end($filesext));
        $fileextstore=array('png','jpg','jpeg');
        
        $validations="select * from company where Email_ID ='$email'";
        $result= mysqli_query($con, $validations);
        $row= mysqli_fetch_assoc($result); 
        
        $regex_gst="/^[0-9]{2}[A-Z1-9]{10}[A-Z1-9]{1}Z[A-Z0-9]{1}$/";
        
        $user= 'WEARE'.$compname;
        $pass=$compname.'1234';
        $subject="Regarding UserName and Password";
        $body="HELLO...  ".$compname."  Your Username is  ".$user." and password is  ".$pass;
        $headers="From: The Company";
       
        if($row['Email_ID']==$email){
           $error='Email already exists';
        }
        elseif ($row['CompanyName']==$compname) {
            echo '<script>alert("Company already exists");</script>';
        }
        elseif((!preg_match($regex_gst, $gst))|| strlen($gst)!=15){
            echo '<script>alert("enter valid 15-digit company GST number");window.location="Register.php";</script>';
        }
        /*else if(in_array($fileschk,$fileextstore)!=0){
            echo 'invalid file format';
        }*/
        else{ 
            if(mail($email, $subject, $body,$headers)){
                $destfile='CompanyLOGO/'.$filename;
                move_uploaded_file($filetmp, $destfile);
                $insert_query="insert into company values ('$compname','$gst','$email','$user','$pass','$destfile')";
                mysqli_query($con, $insert_query);
                echo '<h2>Mail Sent. Company Registered Successfully!!</h2>';
                header("location: RegisterProfile.php");
            }
            else{
                echo '<script>alert("Mail sending failed!!!");window.location="Register.php";</script>';
            }
        }    
    }   
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register for The Other2 Thirds Consulting LLP</title>
        <link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/bootstrap/js/jQuery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            #div2{
                margin-top: 80px;
                margin-left: 300px;
                width: 450px;
                padding-top:  20px;
                padding-bottom: 20px;
                padding-left: 70px;
                
            }
            .panel{
                background-color: white;
            }
            .panel-heading{
                background-color: white!important;
                height: 70px; 
                padding-bottom: 60px; 
                padding-top: 5px;
            }
            #h2{
                text-align: center;
                font-size: 15px;
            }
            body{
                background-color:whitesmoke;
            }
            button{background-color: #007848;color: white;}
            .btn:hover{
                color: white;
                text-decoration: none;
            }
            .error{
                color: red;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container" id="div2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 id="h2">Register for <b>The Other2 Thirds Consulting LLP</b></h2>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="Register.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Company Name :</label>
                                    <input type="text" placeholder="Enter Company Name" name="name" value="<?php echo $compname;?>" required="true" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>GST No. :</label>
                                    <input type="text" placeholder="Enter GST No. of company" name="gst"  required="true" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input type="email" placeholder="Enter Company Email ID" name="email" required="true" value="<?php echo $email;?>" class="form-control">  
                                    <div class="error"><?php echo $error;?></div>
                                </div>
                                <div class="form-group">
                                    <label>Upload Logo :</label>
                                    <input type="file" name="images" required="true" class="form-control">  
                                    <div class="error"><?php echo $error;?></div>
                                </div>
                                <button class="btn btn-block" name="register">Register</button>
                            </form>
                        </div>    
                    </div>          
                </div>
            </div>
        </div>
    </body>
</html>    