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


  if(isset($_POST['submit']))
  {
      $subjectid=$_POST['subjectid'];
      $class=$_POST['class'];
      $subject=$_POST['subject'];

      $_SESSION['subjectid']=$subjectid;
      $_SESSION['class2']=$class;
      $_SESSION['subject']=$subject;

      if (isset($_SESSION['class2'])){
          header("Location: chapter.php");
      }

      echo $_SESSION['subjectid'];
      echo $_SESSION['class2'];
      echo $_SESSION['subject'];

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
  .category{
    border: 2px solid black;
    width: 850px;
    margin-left: 250px;
    margin-top: 60px;
    padding: 30px;
    height: 500px;
  }

  #subject{
      float: left;

  }
  #subjectname{
      background-color: deeppink;
      color: white;
      width: 230px;
      height: 100px;
      margin: 10px;
      font-weight: bold;
      /*float: left;*/
  }#subjectname:hover{
       cursor: pointer;
       background-color: blue;
       color: white;
   }body{
     font-family: cursive;
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
  //session_start();

  $conn=mysqli_connect("localhost:3306","root","180238","online_examination_system");

  if (isset($_SESSION['class'])){
      $classid=$_SESSION['classid'];
      $class1=$_SESSION['class'];
      //echo $class1;

      $sql="SELECT * from subject where class='$class1'";
      $query=mysqli_query($conn,$sql);

      while ($row=mysqli_fetch_array($query))
      {
          // echo $row['subject'];
          //echo $row['class'];
          ?>

          <form id="subject" method="post" action="subject.php">
              <input type="text" name="subjectid" value="<?php echo $row['subjectid']?>" hidden="">
              <input type="text" name="class" value="<?php echo $row['class']?>" hidden="">
              <input type="text" name="subject" value="<?php echo $row['subject']?>" hidden="">
              <input id="subjectname" type="submit" name="submit" value="<?php echo $row['subject']?>">
          </form>
          <?php
      }

  }

  ?>

  </div>
</body>

</html>