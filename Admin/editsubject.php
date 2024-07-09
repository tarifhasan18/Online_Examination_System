<?php
session_start();
include 'conn.php';
if(isset($_SESSION['email'])){

}else{
    header("Location: index.php");
}
if (isset($_SESSION['chapterid'])){
   
}
if (isset($_POST['Edit'])){
    $subjectid=$_POST['subjectid'];
    $class=$_POST['class'];
    $subject=$_POST['subject'];

    $sql2="UPDATE subject set class='$class', subject='$subject' where subjectid='$subjectid'";
    $query2=mysqli_query($conn,$sql2);
    if ($query2){
        ?>
        <script type="text/javascript">
            alert("Updated Information");

        </script>


        <?php

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/style.css" />
    <title>Online Examination System</title>
    <style type="text/css">
        body{
            font-family: cursive;
        }
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
            width: 200px;
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
            width: 100%;
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
        #form2{
            border: 1px solid black;
            width: 400px;
            padding-left: 30px;
            padding-top: 30px;
            padding-bottom: 30px;
            margin-left: 300px;
            margin-top: 50px;
        }
        #name,#address{
            width: 300px;
            padding: 10px;
            background-color: aliceblue;
            border: 1px solid aliceblue;
        }#name,#address:hover{
             border: 1px solid aliceblue;
             cursor: pointer;
         }
        #submit{
            margin-left: 100px;
            padding: 10px;
            border: 1px solid darkcyan;
            color: white;
            background-color: darkcyan;
            font-weight: bold;
        }
        #submit:hover{
            background-color: blue;
            border: 1px solid blue;
            color: white;
            cursor: pointer ;
            padding: 10px;
        }
        #edit{
            width: 170px;
            background-color: darkcyan;
            color: white;
            border: 1px solid darkcyan;
            height: 40px;
            font-weight: bold;
            font-size: 17px;
        }
        #edit:hover{
            background-color: darkblue;
            color: white;
            cursor: pointer;
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
    <li id="li2"><a class="active" href="addsubject.php">Add Subject</a></li>
    <li id="li2"><a  href="addchapter.php">Add Chapter</a></li>
    <li id="li2"><a href="ScheduleExam.php">Schedule Exam</a></li>
    <li id="li2"><a href="addquestion.php">Add Question</a></li>
    <li id="li2"><a href="users.php">Manage Users</a></li>
    <li id="li2"><a href="result.php">Results</a></li>
</ul>


<div class="cat">
    <form id="form2" method="post" action="editsubject.php">
        <?php
        include 'conn.php';

        if (isset($_SESSION['subjectid']))
            $subjectid=$_SESSION['subjectid'];
        $sql="SELECT * from subject where subjectid='$subjectid'";
        $query2=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($query2);
        ?>
        <input type="text" name="subjectid" value="<?php echo $row['subjectid']?>" hidden="">
        <input type="text" name="class" value="<?php echo $row['class']?>"> <br><br>
        <input type="text" name="subject" value="<?php echo $row['subject']?>"><br><br>
        <input id="edit" type="submit" name="Edit" value="Edit Information">
        <?php

        ?>

    </form>
    <!--a href="s2index.php">Go to Previous Page</a-->

</div>

</body>

</html>