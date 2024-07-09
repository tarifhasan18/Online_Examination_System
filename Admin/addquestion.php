<?php
session_start();
include 'conn.php';
if(isset($_SESSION['email'])){
  
}else{
    header("Location: index.php");
}
if (isset($_POST['edit'])){
    $_SESSION["questionid"] = $_POST['questionid'];
    header("Location: editquestion.php");
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
  height: 800px;
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
      margin-left: 200px;
      margin-top: 0px;
      padding:30px;
      float: left;
    }

input[type=text], input[type=password] {
  width: 80%;
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
  width: 1200px;
    margin-top: 100px;
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
  width: 100px;
  margin: 2px;
}
#button1:hover{
  background-color: blue;
  color: white;
}
#selectExam{
    width: 270px;
    height: 40px;
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
  <li id="li2"><a href="addchapter.php">Add Chapter</a></li>
    <li id="li2"><a href="ScheduleExam.php">Schedule Exam</a></li>
  <li id="li2"><a class="active" href="addquestion.php">Add Question</a></li>
    <li id="li2"><a href="users.php">Manage Users</a></li>
    <li id="li2"><a href="result.php">Results</a></li>
</ul>
 
<h3 style="margin-left: 650px;margin-top: 50px">Enter Exam Questions</h3>
<div class="cat">
<form id="form1" action="addquestion.php" method="post">

   <label style="font-family: Arial">Select Exam Name</label> <br><br><select name="selectExam" id="selectExam" required>
    <?php
    $sql11="SELECT * from exam";
    $query11=mysqli_query($conn,$sql11);

    while ($data=mysqli_fetch_array($query11)){
        $examname=$data['examname'];
        echo $examname
        ?>

            <option value="<?php echo $examname;?>" <?php if (isset($_POST['selectExam']) && $_POST['selectExam'] == '<?php echo $examname?>') echo 'selected'; ?>><?php echo $examname?></option>
            <!--option value="option2" <?php if (isset($_POST['selectOption']) && $_POST['selectExam'] == 'option2') echo 'selected'; ?>>Option 2</option>
            <option value="option3" <?php if (isset($_POST['selectOption']) && $_POST['selectOption'] == 'option3') echo 'selected'; ?>>Option 3</option-->

    <?php
    }


    ?>
    </select><br>
    <input type="text" name="class" placeholder="Enter class name" required><br>
    <input type="text" name="subject" placeholder="Enter subject name" required><br>
    <input type="text" name="chapter" placeholder="Enter chapter name" required><br>
    <input type="text" name="question" placeholder="Enter question" required><br>
    <input type="text" name="option1" placeholder="Enter option1" required><br>
    <input type="text" name="option2" placeholder="Enter option2" required><br>
    <input type="text" name="option3" placeholder="Enter option3" required><br>
    <input type="text" name="option4" placeholder="Enter option4" required><br>
    <input type="text" name="correct" placeholder="Enter Correct Option" required><br>

    <button type="submit" name="addquestion">Add Question</button>
  </form>
<br>
  
</div><br>
<table id="customers">
   <tr>
       <th>Exam Name</th>
    <th>Class Name</th>
    <th>Subject</th>
    <th>Chapter</th>
    <th>Question</th>
    <th>Option 1</th>
    <th>Option 2</th>
    <th>Option 3</th>
    <th>Option 4</th>
    <th>Correct Option </th>
    <th>Action</th>
   </tr>
 
<?php 

include 'conn.php';

if(isset($_POST['addquestion']))
{
    $examname=$_POST['selectExam'];
    $class=$_POST['class'];
    $subject=$_POST['subject'];
    $chapter=$_POST['chapter'];
    $question=$_POST['question'];
    $option1=$_POST['option1'];
    $option2=$_POST['option2'];
    $option3=$_POST['option3'];
    $option4=$_POST['option4'];
    $correct=$_POST['correct'];




    $sql="INSERT into question(examname,class,subject,chapter,question,option1,option2,option3,option4,correct) 
    values('$examname','$class','$subject','$chapter','$question','$option1','$option2','$option3','$option4','$correct')";
    $query=mysqli_query($conn,$sql);

    if($query)
    {
        echo "<script>alert('Question Added Successfully')</script>";

    }
}


$sql2="SELECT * from question";
$query2=mysqli_query($conn,$sql2);

while($row=mysqli_fetch_array($query2))
{
    ?>

    <br>
  <tr>
      <td><?php echo $row['examname']; ?> </td>
    <td><?php echo $row['class']; ?> </td>
    <td><?php echo $row['subject']; ?> </td>
    <td><?php echo $row['chapter']; ?> </td>
    <td><?php echo $row['question']; ?> </td>
    <td><?php echo $row['option1']; ?> </td>
    <td><?php echo $row['option2']; ?> </td>
    <td><?php echo $row['option3']; ?> </td>
    <td><?php echo $row['option4']; ?> </td>
    <td><?php echo $row['correct']; ?> </td>
    <td>
      <form class="form2" action="addquestion.php" method="post" >
                  <input type="text" name="questionid" hidden value="<?php echo $row['questionid']; ?>">
                  <input type="text" name="class" hidden value='<?php echo $row['class']; ?>'>
                  <button id="button1" name="edit">Edit</button>
    </form> <br>

    <form class="form3" action="addquestion.php" method="post"> 
                <input type="text" name="questionid" value='<?php echo $row['questionid']; ?>' hidden>
                <button id="button1" name="delete" onclick='Delete()'>Delete</button>
    </form>
    </td>
    
  </tr>
    <p> </p>

    <?php 
}



?>
 </table>

</body>
<p id="demo"></p>
                <script>
                        function Delete() {

  var txt;
  if (confirm("Press a button!")) {
    <?php
                  include 'conn.php';
                  if (isset($_POST['delete'])) { 
                      $questionid=$_POST['questionid'];
      
                      $sql6="DELETE from question where questionid='$questionid'";
                      $query6=mysqli_query($conn,$sql6);
                      header("Location: addquestion.php");
                  }
                ?>
  } else {
    txt = "You pressed Cancel!";
  }
  document.getElementById("demo").innerHTML = txt;
  
}
                    </script>

</html>