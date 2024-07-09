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
    $chapterid=$_POST['chapterid'];
    $class=$_POST['class'];
    $subject2=$_POST['subject'];
    $chapter=$_POST['chapter'];

    $_SESSION['chapterid']=$chapterid;
    $_SESSION['class3']=$class;
    $_SESSION['subject3']=$subject2;
    $_SESSION['chapter']=$chapter;

    echo $_SESSION['chapterid'];
    echo $_SESSION['class3'];
    echo $_SESSION['subject3'];
    echo $_SESSION['chapter'];

    if (isset($_SESSION['chapterid']))
        header("Location:question.php");
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
    width: 830px;
    margin-left: 250px;
    margin-top: 60px;
    padding: 10px;
    height: 500px;
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
  #chapter{
      float: left;
     }
  #chaptername{
      background-color: deeppink;
      color: white;
      width: 230px;
      height: 100px;
      margin: 10px;
      font-weight: bold;
      /*float: left;*/
  }
  #chaptername:hover{
       cursor: pointer;
       background-color: blue;
       color: white;
   }
  /* Style the dropdown container */
  .dropdown {
      position: absolute;
      display: inline-block;
  }

  /* Style the dropdown button */
  .dropbtn {

      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
  }

  /* Style the dropdown content (hidden by default) */
  .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
  }

  /* Style the links inside the dropdown */
  .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
  }

  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {
      background-color: #3498db;
      color: white;
  }

  /* Show the dropdown content when the button is hovered over */
  .dropdown:hover .dropdown-content {
      display: block;
  }
  #div5{
      display: none;
  }#button4:hover .div5{
      display: block;
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
        <li><a href="#">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="logout.php">Logout</a></li>
          <li><img style="float: left;  border-radius: 50%;" width="30px" height="30px" src="image/<?php echo $data['image']?>"><a style="float: left; margin-top: 5px"><?php echo $data['username'];?></a> </li>


      </div>
    </ul>
  </nav>
 


<div class="category">
    <?php


    $conn=mysqli_connect("localhost:3306","root","180238","online_examination_system");

    if (isset($_SESSION['class2'])){
        $class=$_SESSION['class2'];
        $subject=$_SESSION['subject'];

        $sql="SELECT * from chapter where class='$class' AND subject='$subject'";
        $query=mysqli_query($conn,$sql);

        while ($row=mysqli_fetch_array($query)){
            ?>
            <form id="chapter" method="post" action="chapter.php">
                <input type="text" name="chapterid" value="<?php echo $row['chapterid']?>" hidden="">
                <input type="text" name="class" value="<?php echo $row['class']?>" hidden="">
                <input type="text" name="subject" value="<?php echo $row['subject']?>" hidden="">
                <input type="text" name="chapter" value="<?php echo $row['chapter']?>" hidden="">
                <input id="chaptername" type="submit" name="submit" value="<?php echo $row['chapter']?>">

            </form>
            <?php
        }

    }
    ?>

</div>

</body>

</html>