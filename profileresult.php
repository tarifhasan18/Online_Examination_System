<?php
session_start();
include 'conn.php';

if (isset($_SESSION['userid']))
{
    //header("Location: class.php");
    //echo $_SESSION['userid'];
   // echo $_SESSION['email'];
    //echo $_SESSION['username'];
}else{
    header("Location:login.php");
}
$userid=$_SESSION['userid'];

$sql3="SELECT * from users where userid='$userid'";
$query3=mysqli_query($conn,$sql3);
$data=mysqli_fetch_array($query3);
$email=$data['email'];
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
  .cat{
    
    margin-left: 50px;
    margin-top: 60px;
    padding: 10px;
    height: 500px;
    float: left;
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
#nav2 {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 170px;
  background-color: #f1f1f1;
  height: 700px;
  float: left
}

#li2 a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #04AA6D;
  color: white;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 950px;
  margin-left: 5px;
  float: left;
  margin-top: 10px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
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
<ul id="nav2">
  <li id="li2"><a class="" href="">Dashboard</a></li>
  <hr>
  <li id="li2"><a href="profile.php">Profile</a></li>
  <li id="li2"><a class="active" href="profileresult.php">Result</a></li>

</ul>
 

<div class="cat">
  
<h2 style="text-align:center;">Your Previous All Exam Results</h2>
<table id="customers">
  <tr>
    <th>Exam Name</th>
    <th>Date & Time</th>
    <th>Class</th>
    <th>Subject</th>
    <th>Chapter</th>
    <th>Full Marks</th>
    <th>Your Marks</th>
    <th>Your Ranking</th>
    
  </tr>
  <?php 
      //$sql="SELECT * from result where email='$email' order by date desc";
//   $sql="
// SELECT
// date,
// examname,
//   email,
//   username,
//   class,
//   subject,
//   chapter,
//   total,
//   marks,
//   RANK() OVER (PARTITION BY class,subject ORDER BY marks DESC) AS subject_rank
// FROM
//   result where email='$email' order by date desc";

  $sql = "
SELECT
  date,
  examname,
  email,
  username,
  class,
  subject,
  chapter,
  total,
  marks,
  subject_rank,
  RANK() OVER (ORDER BY marks DESC) AS overall_rank
FROM
(
  SELECT
    date,
    examname,
    email,
    username,
    class,
    subject,
    chapter,
    total,
    marks,
    RANK() OVER (PARTITION BY class, subject, chapter ORDER BY marks DESC) AS subject_rank
  FROM
    result
) AS ranked_results
WHERE
  email = '$email'
ORDER BY
  date DESC
";

      $query=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_array($query)){
        ?>
        <tr>
          <td><?php echo $row['examname'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['class'] ?></td>
          <td><?php echo $row['subject'] ?></td>
          <td><?php echo $row['chapter'] ?></td>
          <td><?php echo $row['total'] ?></td>
          <td><?php echo $row['marks'] ?></td>
          <td><?php echo $row['subject_rank'] ?></td>
          
        </tr>

        <?php 
      }

  ?>
</table>

</div>

</body>

</html>