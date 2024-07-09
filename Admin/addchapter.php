<?php
session_start();
if(isset($_SESSION['email'])){
    
}else{
    header("Location: index.php");
}
if (isset($_POST['edit'])){
    $_SESSION["chapterid"] = $_POST['chapterid'];
    echo $_SESSION['chapterid'];
    header("Location: editchapter.php");
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
    
    /*margin-left: 250px;
    margin-top: 60px;*/
    padding: 10px;
    height: 500px;
    float: left;
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
      width: 500px;
      margin-left: 290px;
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

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;

  border: none;
  cursor: pointer;
  width: 40%;
}

button:hover {
  opacity: 0.8;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 900px;
    margin-left: 50px;
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
  margin: 8px 0;
  float: left;
  border: none;
  cursor: pointer;
  width: 40%;
  margin: 2px;
}
#button1:hover{
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
        
        <li><a href="logout.php">Logout</a></li>
          <li><?php echo $_SESSION['email']?></li>

      </div>
    </ul>
  </nav> 
<ul id="nav2">
  <li id="li2"><a class="" href="#home">Dashboard</a></li>
  <hr>
    <li id="li2"><a class="" href="home.php">Home</a></li>

  <li id="li2"><a class="" href="addclass.php">Add Class</a></li>
  <li id="li2"><a href="addsubject.php">Add Subject</a></li>
  <li id="li2"><a class="active" href="addchapter.php">Add Chapter</a></li>
    <li id="li2"><a href="ScheduleExam.php">Schedule Exam</a></li>
  <li id="li2"><a href="addquestion.php">Add Question</a></li>
    <li id="li2"><a href="users.php">Manage Users</a></li>
    <li id="li2"><a href="result.php">Results</a></li>
</ul>
 

<div class="cat">
    
  <form id="form1" action="addchapter.php" method="post">
  <p for="">Enter Chapter name</p>
  <input type="text" name="class" placeholder="Enter class name" required><br>
  <input type="text" name="subject" placeholder="Enter subject name" required><br>
  <input type="text" name="chapter" placeholder="Enter chapter name" required><br>
  <button type="submit" name="addchapter">Add Chapter</button>
  </form>
<br>
  <table id="customers">
   <tr>
    <th>Class Name</th>
    <th>Subject Name</th>
    <th>Chapter Name</th>
    <th>Action</th>
   </tr>
 
<?php 

include 'conn.php';

if(isset($_POST['addchapter']))
{
    $class=$_POST['class'];
    $subject=$_POST['subject'];
    $chapter=$_POST['chapter'];

    $sql="INSERT into chapter(class,subject,chapter) values('$class','$subject','$chapter')";
    $query=mysqli_query($conn,$sql);

    if($query)
    {
        echo "<script>alert('Chapter Added Successfully')</script>";

    }
}




$sql2="SELECT * from chapter";
$query2=mysqli_query($conn,$sql2);

while($row=mysqli_fetch_array($query2))
{
    ?>
  <tr>
    <td><?php echo $row['class']; ?> </td>
    <td><?php echo $row['subject']; ?> </td>
    <td><?php echo $row['chapter']; ?> </td>
    <td>
      <form class="form2" action="addchapter.php" method="post" >
                  <input type="text" name="chapterid" hidden value="<?php echo $row['chapterid']; ?>">
                  <input type="text" name="chapter" hidden value='<?php echo $row['chapter']; ?>'>
                  <button id="button1" name="edit">Edit</button>
    </form>

    <form class="form3" action="addchapter.php" method="post"> 
                <input type="text" name="chapterid" value='<?php echo $row['chapterid']; ?>' hidden>
                <button id="button1" name="delete" onclick='Delete()'>Delete</button>
    </form>
    </td>
  </tr>
    <p> </p>

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
                      $chapterid=$_POST['chapterid'];
      
                      $sql6="DELETE from chapter where chapterid='$chapterid'";
                      $query6=mysqli_query($conn,$sql6);
                      //header("Location: addquestion.php");
                  }
                ?>
  } else {
    txt = "You pressed Cancel!";
  }
  document.getElementById("demo").innerHTML = txt;
  
}
                    </script>

</html>