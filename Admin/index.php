<?php
session_start();
include 'conn.php';
global $conn;
error_reporting(0);
if (isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * from admin where email = '$email' AND password = '$password'";
    $query=mysqli_query($conn,$sql);

    $row=mysqli_fetch_array($query);


    if ($email==$row['email'] && $password==$row['password']) {
        $_SESSION['email']=$row['email'];
        $_SESSION['password']=$row['password'];
    }else{
        echo "Wrong";
        echo "<script type='text/javascript'>";
        echo "alert('Invalid Password or Error')";
        echo "</script>";
    }
}
if (isset($_SESSION['email']))
{
    header("Location: home.php");
}
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
  		width: 500px; 
  		margin-left: 370px;
  		margin-top: 50px;
  	}

input[type=text], input[type=password] {
  width: 250px;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: darkcyan;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  font-weight: bold;
  cursor: pointer;
  width: 100px;
  margin-left: 70px;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
  margin-left: 100px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
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

        <li><a href="#">Home</a></li>
        <li><a href="/">About Us</a></li>
        <li><a href="/">Contact Us</a></li>
      </div>
    </ul>
  </nav>
 

<form action="index.php" method="post">

  <div class="container">
    <label for="email"><b>Email</b></label> <br>
    <input type="text" placeholder="Enter Email" name="email" required><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
        
    <button type="submit" name="login">Login</button>
  </div>
 

  
   
    
  </div>
</form>
<?php 

include 'conn.php';

if(isset($_POST['login1']))
{

	$email=$_POST['email'];
	$password=$_POST['password'];



	$sql1 = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
	$query1=mysqli_query($conn,$sql1);

    if ($query1->num_rows > 0) {
		$row = mysqli_fetch_assoc($query1);
		header("Location: home.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}	
}

?>
</body>

</html>