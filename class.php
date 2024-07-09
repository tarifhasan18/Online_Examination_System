<?php
include 'conn.php';

if (isset($_SESSION['email']))
{
    //header("Location: class.php");
    echo $_SESSION['email'];
}else{
    header("Location:login.php");
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
        <li><a href="#">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </div>
    </ul>
  </nav>


<div class="category">
  <?php 
  $sql="SELECT * from class";
  $query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query))
  {
    ?>
        <a class="div1" href="subject.php"><?php echo $row['class'] ?></a>
    <?php
  }

?>
  
  <!--a class="div1" href="#">Class Two</a>
  <a class="div1" href="#">Class Three</a>
  <a class="div1" href="#">Class Four</a>
  <a class="div1" href="#">Class Five</a>
  <a class="div1" href="#">Class Six</a>
  <a class="div1" href="#">Class Seven</a>
  <a class="div1" href="#">Class Eight</a>
  <a class="div1" href="#">Class Nine</a>
  <a class="div1" href="subject.php">Class Ten</a>
  <a class="div1" href="#">Class Eleven</a>
  <a class="div1" href="#">Class Twelve</a-->
</div>

</body>

</html>