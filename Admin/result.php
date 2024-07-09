<?php
session_start();
include "conn.php";
if(isset($_SESSION['email'])){

}else{
    header("Location: index.php");
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
        .cat{
            padding: 10px;
            height: 500px;
            float: left;
            border: ;
            margin-left: 5px;
            margin-top: 50px;
            width: 800px;
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
        #form1 {
            border: 3px solid #f1f1f1;
            width: 700px;
            margin-left: 300px;
            margin-top: 50px;
            padding:30px;
        }

        input[type=text], input[type=password] {
            width: 60%;
            padding: 12px 20px;
            margin: 8px 0;
            /*display: inline-block;*/
            border: 1px solid #ccc;
            box-sizing: border-box;
        }


        button:hover {
            opacity: 0.8;
        }
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 1010px;
            margin-left: 5px;
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
        #button1{
            background-color: red;
            color: white;
            padding: 14px 20px;
            margin-left: 28px;
            float: ;
            border: none;
            cursor: pointer;
            width: 100px;
            margin: 2px;
        }
        #button1:hover{
            background-color: blue;
            color: white;
        }
        #delete{
            background-color: red;
            color: white;
            font-weight: bold;
            border: 1px solid red;
            padding: 5px;
        }
        #delete:hover{
            cursor: pointer;
            background-color: blue;
            color: white;
            border: 1px solid blue;
        }
    </style>
</head>

<body>
<nav class="navbar">

    <div class="logo">Online Examination System</div>

    <ul class="nav-links">

        <div class="menu">

            <li><a href="logout.php">Logout</a></li>
            <li style=" font-family: cursive;"><?php echo $_SESSION['email']?></li>

        </div>
    </ul>
</nav>
<ul id="nav2">
    <li id="li2"><a class="" href="#home">Dashboard</a></li>
    <hr>
    <li id="li2"><a class="" href="home.php">Home</a></li>

    <li id="li2"><a class="" href="addclass.php">Add Class</a></li>
    <li id="li2"><a href="addsubject.php">Add Subject</a></li>
    <li id="li2"><a href="addchapter.php">Add Chapter</a></li>
    <li id="li2"><a href="ScheduleExam.php">Schedule Exam</a></li>
    <li id="li2"><a href="addquestion.php">Add Question</a></li>
    <li id="li2"><a href="users.php">Manage Users</a></li>
    <li id="li2"><a class="active"  href="result.php">Result</a></li>
</ul>


<div class="cat">
  
<h2 style="text-align:center; margin-left: 190px;">Previous All Exam Results</h2>
<table id="customers">
  <tr>
    <th>Exam Name</th>
    <th>Date & Time</th>
    <th>Email</th>
    <th>Username</th>
    <th>Class</th>
    <th>Subject</th>
    <th>Chapter</th>
    <th>Full Marks</th>
    <th>Your Marks</th>
    <th>Rank</th>
    <th>Action</th>
    
  </tr>
  <?php 
    
  $sql="
SELECT
id,
date,
examname,
  email,
  username,
  class,
  subject,
  chapter,
  total,
  marks,
  RANK() OVER (PARTITION BY class,subject ORDER BY marks DESC) AS subject_rank
FROM
  result order by date desc";
      $query=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_array($query)){
        ?>
        <tr>
          <td><?php echo $row['examname'] ?></td>
          <td><?php echo $row['date'] ?></td>
           <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['username'] ?></td>
          <td><?php echo $row['class'] ?></td>
          <td><?php echo $row['subject'] ?></td>
          <td><?php echo $row['chapter'] ?></td>
          <td><?php echo $row['total'] ?></td>
          <td><?php echo $row['marks'] ?></td>
          <td><?php echo $row['subject_rank'] ?></td>
          <td>
              <form action="result.php" method="post">
                    <input hidden type="number" name="id" value="<?php echo $row['id']; ?>">
                    <input id="delete" type="submit" name="delete" value="Delete">
               </form>
          </td>
          
        </tr>

        <?php 
      }

  ?>
</table>

</div>
</body>
<p id="demo"></p>
<script>
    function Delete() {

        var txt;
        if (confirm("Press a button!")) {
            <?php
            include 'conn.php';
            if (isset($_POST['delete'])) {
                $id=$_POST['id'];

                $sql6="DELETE from result where id='$id'";
                $query6=mysqli_query($conn,$sql6);

                if ($query6){
                    header("Location:result.php");
                }
            }
            ?>
        } else {
            txt = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = txt;

    }
</script>

</html>