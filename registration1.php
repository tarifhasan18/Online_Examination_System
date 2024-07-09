<?php
//include('smtp/PHPMailerAutoload.php');
session_start();

include 'conn.php';


$conn=mysqli_connect('localhost:3306','root','180238','online_examination_system');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/style.css" />
  <title>Online Examination System</title>
  <style type="text/css">
  	form {
  		border: 3px solid #f1f1f1; 
  		width: 700px; 
  		margin-left: 300px;
  		margin-top: 50px;
        height: 490px;
  	}

input[type=text], input[type=password]{
  width: 60%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 60%;
}

button:hover {
  opacity: 0.8;
}


.container {
  padding: 16px;
  margin-left: 200px;
}

  </style>
</head>

<body>
  <nav class="navbar">
   
    <div class="logo">Online Examination System</div>

    <!-- NAVIGATION MENU -->
    <ul class="nav-links">

      <!-- USING CHECKBOX HACK -->
      

      <!-- NAVIGATION MENUS -->
      <div class="menu">

        <li><a href="login.php">Home</a></li>
        <li><a href="/">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </div>
    </ul>
  </nav>
 

<form action="registration1.php" method="post" enctype="multipart/form-data">

  <div class="container">
  	 <label for="uname"><b>Enter Username</b></label> <br>
  	  <input type="text" placeholder="Enter Username" name="username" required><br>

    <label for="email"><b>Email</b></label> <br>
    <input type="text" placeholder="Enter Email" name="email" required><br>
  
    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
      <label for="Address"><b>Address</b></label><br>
      <input type="text" placeholder="Enter Addres" name="address" required><br><br>
      <label for="Image"><b>Upload your Image</b></label>
      <input type="file" name="image" placeholder="Upload image" required><br>

    <input type="number" name="number" required value='<?php echo rand(10,1000000) ?>' hidden> <br>
    <button type="submit" name="submit">Sign Up</button>
  </div>
  <label style="margin-left: 230px;">Already have account? </label><a href="login.php">Log In</a><br><br>

  
   
    
  </div>
</form>
<?php

//error_reporting(0);


if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $number = $_POST['number'];
//$password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $image = $_FILES['image']['name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];
    $image_tem_loc = $_FILES['image']['tmp_name'];

    $image_store = "image/" . $image;

    move_uploaded_file($image_tem_loc, $image_store);

    $sql1 = "SELECT * from users where email='$email'";
    $query1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($query1);


if ($row['email']==$_POST['email']){
    echo "<script>alert('Already Exists')</script>";
}else{

  $_SESSION['email1']=$email;
  $_SESSION['username']=$username;
  $_SESSION['password']=$password;
  $_SESSION['address']=$address;
  $_SESSION['image']=$image;
  $_SESSION['image_type']=$image_type;
  $_SESSION['image_size']=$image_size;
  $_SESSION['image_tem_loc']=$image_tem_loc;
  $_SESSION['number']=$number;

   // $sql = "INSERT INTO users(username,email,password,address,image) values('$username','$email','$password','$address','$image')";
    //$query = mysqli_query($conn, $sql);


   // $sql2 = "INSERT into otp(code,email) values('$number','$email')";
    //$query2 = mysqli_query($conn, $sql2);

    echo $email;
    echo $number;
    include('smtp/PHPMailerAutoload.php');
//    echo smtp_mailer($email, 'Sending Email', $number);
    //if ($query2){
        echo smtp_mailer($email, 'Email Verification', 'Your Verification Code:'.$number);
        header("Location:verify1.php");
   // }
}
}

//include('smtp/PHPMailerAutoload.php');
//$number=10;
//$email='180238@ku.ac.bd';

//echo smtp_mailer($email,'Sending Email',$number);
function smtp_mailer($to,$subject, $msg){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2;
    $mail->Username = "mdtarifhasan1997@gmail.com";
    $mail->Password = "kssnpkgsmqnjoock";
    $mail->SetFrom("mdtarifhasan1997@gmail.com","Online Examination System");
    $mail->Subject = $subject;
    $mail->Body =$msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if(!$mail->Send()){
        echo $mail->ErrorInfo;
    }else{
        return 'Sent';
        header("Location:verify.php");
    }
}
?>
</body>

</html>