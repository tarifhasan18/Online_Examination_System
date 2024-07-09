<?php
session_start();
include 'conn.php';

if (isset($_SESSION['userid']))
{

}else{
    header("Location:login.php");
}
$userid=$_SESSION['userid'];

$sql3="SELECT * from users where userid='$userid'";
$query3=mysqli_query($conn,$sql3);
$data=mysqli_fetch_array($query3);


if (isset($_POST['submit'])){
    $class_id=$_POST['class_id'];
    $class=$_POST['class'];

    $_SESSION['classid']=$class_id;
    $_SESSION['class']=$class;

    if (isset($_SESSION['class'])){
        header("Location: subject.php");
    }
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
  body{
     font-family: cursive;
  }
  .category{
    border: 2px solid black;
    width: 815px;
    margin-left: 250px;
    margin-top: 60px;
    padding: 40px;
    height: 540px;
  }

  #class{
      float: left;

  }
  #classname{
      background-color: deeppink;
      color: white;
      width: 220px;
      height: 100px;
      margin: 10px;
      font-weight: bold;
  }#classname:hover{
      cursor: pointer;
      background-color: blue;
      color: white;
     }
</style>
</head>

<body>
  <nav class="navbar">
   
    <div class="logo">Online Examination System</div>

    <ul class="nav-links">

      <div class="menu">

        <li><a href="home.php">Home</a></li>
        <li><a href="/">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="logout.php">Logout</a></li>
          <li><img style="float: left;  border-radius: 50%;" width="30px" height="30px" src="image/<?php echo $data['image']?>"><a href="profile.php" style="float: left; margin-top: 5px"><?php echo $data['username'];?></a> </li>

      </div>
    </ul>
  </nav>


<div class="category">
    <?php

    $conn=mysqli_connect("localhost:3306","root","180238","online_examination_system");

    $sql="SELECT * FROM class";
    $query=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($query)){
        ?>
        <form id="class" action="home.php" method="post">
            <input type="text" name="class_id" value="<?php echo $row['classid'];?>" hidden="">
            <input type="text" name="class" value="<?php echo $row['class']?>" hidden="">
            <input id="classname" type="submit" name="submit" value="<?php echo $row['class'];?>">

        </form>
        <?php
    }
    ?>

</div>

</body>

</html>

<?php


?>