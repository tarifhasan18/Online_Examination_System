<?php

session_start();
include 'conn.php';


if (isset($_SESSION['userid']))
{
   $email=$_SESSION['email'];
}else{
    header("Location:login.php");
}
$userid=$_SESSION['userid'];

$sql3="SELECT * from users where userid='$userid'";
$query3=mysqli_query($conn,$sql3);
$data=mysqli_fetch_array($query3);


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
  #category{
    border: 2px solid black;
    width: 830px;
    margin-left: 250px;
    margin-top: 60px;
    padding: 10px;
    height: 100%;

  }
  .div1{
    background-color: deeppink;
    padding-top: 23px;
    float: left;
    margin:  25px;
    width: 200px;
    height: 70px;
    text-align: center;
  }
  #countdown{
     float: right;

  }
  #result{
    border: 1px solid black;
    margin-top: 6px;
    margin-left: 440px;
    width: 460px;
    padding: 20px;
  }body{
     font-family: cursive;
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
<h2 style="text-align:center;margin-left: 90px; margin-top: 90px;">Your Exam Result</h2>
  <div id="result">
  <?php 
if (isset($_SESSION['chapterid'])){
  $chapterid=$_SESSION['chapterid'];
  $class=$_SESSION['class3'];
  $subject1=$_SESSION['subject3'];
  $chapter=$_SESSION['chapter'];

}
if (isset($_SESSION['score'])) {
    $score = $_SESSION['score'];
    $wrong = $_SESSION['wrong'];
    $total=$_SESSION['total'];
}
    $sql4="SELECT * from exam";
    $query4=mysqli_query($conn,$sql4);
    $row1=mysqli_fetch_array($query4);
    $examname=$row1['examname'];

    echo "<b>Exam Name: </b>".$row1['examname'];
    echo "<br>";
    echo "<b>Class: </b> ".$class;
    echo "<br>";
    echo "<b>Subject:</b> ".$subject1;
    echo "<br>";
    echo "<b>Chapter: </b> ".$chapter;
    echo "<br>";
    echo "<br>";
    echo "<b>Your score is:</b> $score out of $total";
    echo "<br><b>Correct Answer:</b> $score";
    echo "<br> <b>Your wrong Answer:</b> $wrong";
    echo "<br><br>Your result has been sent to <b style='color:blue'> $email</b>.";
    echo "<br>Go to <a style='color:blue' href='profileresult.php'><u>Result</u></a> to see your previous Results and Ranks.";

  ?>


  </div>
  </body>

</html>