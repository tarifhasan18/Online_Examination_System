<?php
session_start();
if(isset($_SESSION['email'])){
}else{
    header("Location: index.php");
}
if (isset($_POST['edit'])){
    $_SESSION["id"] = $_POST['id'];
    echo $_SESSION['id'];
    header("Location: editexam.php");
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
            font-family: ;
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
            font-weight: bold;
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
            float: left;
            font-family: cursive;
        }

        #li2 a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            font-family: cursive;
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
            margin-top: 0px;
            padding:30px;
        }

        input[type=text], input[type=password] {
            width: 350px;
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
            background-color: darkblue;
            color: white;
        }
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 1000px;
            margin-left: 0px;
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

            margin: 8px 0;
            float: left;
            border: none;
            cursor: pointer;
            width: 70px;
            margin: px;
        }
        #button1:hover{
            background-color: blue;
            color: white;
        }
        input[type=datetime-local]{
            width: 200px;
            height: 30px;
        }
    </style>
</head>

<body>
<nav class="navbar">

    <div class="logo">Online Examination System</div>

    <ul class="nav-links">

        <div class="menu">

            <li><a style=" font-family: cursive;" href="logout.php">Logout</a></li>
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
    <li id="li2"><a class="active" href="ScheduleExam.php">Schedule Exam</a></li>
    <li id="li2"><a href="addquestion.php">Add Question</a></li>
    <li id="li2"><a href="users.php">Manage Users</a></li>
    <li id="li2"><a href="result.php">Results</a></li>
</ul>

<h3 style="margin-top: 50px; margin-left: 660px">Set an Exam Schedule</h3>
<div class="cat">

    <form id="form1" action="ScheduleExam.php" method="post" enctype="multipart/form-data">
        <p for="" style="font-weight: bold">Enter Exam Details</p>
        <!--input type="text" name="examid" placeholder="Enter Exam ID" required><br-->
        <input type="text" name="examname" placeholder="Enter Exam Name" required><br><br>
        <label style="font-size: 18px">Exam Start Time</label>
        <input type="datetime-local" name="starttime" step="1" placeholder="Enter Start Time" required><br><br>
        <label style="font-size: 18px">Exam Close Time</label>
        <input type="datetime-local" name="endtime" step="1" placeholder="Enter End Time" required><br><br>
        <button style="margin-left: 100px" type="submit" name="addexam">Scedule Exam</button>
    </form>
    <br>
    <table id="customers">
        <tr>
            <!--th>Exam ID</th-->
            <th>Exam Name</th>
            <th>Start Time</th>
            <th>Close Time</th>
            <th>Action</th>
        </tr>

        <?php

        include 'conn.php';

        if(isset($_POST['addexam']))
        {
           // $examid=$_POST['examid'];
            $examname=$_POST['examname'];
            $starttime=$_POST['starttime'];
            $endtime=$_POST['endtime'];

            $sql="INSERT into exam(examname,starttime,endtime) values('$examname','$starttime','$endtime')";
            $query=mysqli_query($conn,$sql);

            if($query)
            {
                echo "<script>alert('Exam Added Successfully')</script>";

            }
        }




        $sql2="SELECT * from exam";
        $query2=mysqli_query($conn,$sql2);

        while($row=mysqli_fetch_array($query2))
        {
            ?>
            <tr>
                <!--td><?php echo $row['examid']; ?> </td-->
                <td><?php echo $row['examname']; ?> </td>
                <td><?php echo $row['starttime']; ?> </td>
                <td><?php echo $row['endtime']; ?> </td>
                <td>
                    <form class="form2" action="ScheduleExam.php" method="post" >
                        <input type="text" name="id" hidden value="<?php echo $row['id']; ?>">
                        <!--input type="text" name="examid" hidden value='<?php echo $row['examid']; ?>'-->
                        <button id="button1" name="edit">Edit</button>
                    </form>

                    <form class="form3" action="ScheduleExam.php" method="post">
                        <input type="text" name="id" value='<?php echo $row['id']; ?>' hidden>
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
                $id=$_POST['id'];

                $sql6="DELETE from exam where id='$id'";
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