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

//echo $data['username'];

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
            .category{
                border: 2px solid black;
                width: 815px;
                margin-left: 250px;
                margin-top: 10px;
                padding: 40px;
                height: 540px;
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
            #class{
                float: left;

            }
            #classname{
                background-color: deeppink;
                color: white;
                width: 220px;
                height: 100px;
                margin: 10px;
                font-weight: bold;
            }#classname:hover{
                 cursor: pointer;
                 background-color: blue;
                 color: white;
             }
             #update{
                 margin-left: 80px;
                 width: 200px;
                 height: 40px;
                 background-color: darkcyan;
                 color: white;
                 border: 1px solid darkcyan;
                 text-align: center;
                 font-size: 17px;
             }
             #update:hover{
                 cursor: pointer;
                 color: white;
                 background-color: darkblue;

             }
             #nav2 {
                list-style-type: none;
                margin: 0;
                padding: 0;
                width: 170px;
                background-color: #f1f1f1;
                height: 700px;
                float: left
}#li2 a {
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
  <li id="li2"><a class="active" href="profile.php">Profile</a></li>
  <li id="li2"><a  href="profileresult.php">Result</a></li>

</ul>
<br>
    <br>
<h2 style="text-align: center; margin-left: 100px;">Profile</h2>
    <div class="category">
        <?php

        $conn=mysqli_connect("localhost:3306","root","180238","online_examination_system");

        $userid=$_SESSION['userid'];
        //echo $userid;
        $sql="SELECT * FROM users where userid='$userid'";
        $query=mysqli_query($conn,$sql);

        $row=mysqli_fetch_array($query);
        $image=$row['image'];
        
        echo "<div style='margin-left: 300px'>";
        echo "<img style='height: 140px; width: 160px;border-radius: 50%' src='image/$image'>";
        echo "</div>";
        ?>
        <form style="margin-top: 20px;margin-left:220px" action="profile.php" method="post" enctype="multipart/form-data">
           <!--label style="font-size: 18px; font-weight: bold">Username</label-->
            <input type="text" name="userid" value="<?php echo $_SESSION['userid']; ?>" hidden="">
            <input style="font-size:17px;width: 350px; height: 50px; padding: 10px; background-color: aliceblue; border: 1px solid aliceblue;" type="text" name="name" value="<?php echo $row['username']?>">
            <br><br>
            <!--label style="font-size: 18px; font-weight: bold">Email</label-->
            <input style="font-size:17px;width: 350px; height: 50px; padding: 10px; background-color: aliceblue; border: 1px solid aliceblue;" type="text" name="email" value="<?php echo $row['email']?>">
            <br><br>
            <input style="font-size:17px;width: 350px; height: 50px; padding: 10px; background-color: aliceblue; border: 1px solid aliceblue;" type="text" name="address" value="<?php echo $row['address']?>">
            <br><br>
            <input style="font-size:17px;width: 350px; height: 50px; padding: 10px; background-color: aliceblue; border: 1px solid aliceblue;" type="password" name="password" value="<?php echo $row['password']?>">
            <br><br>
             <input id="update"  type="submit" name="update" value="Update Information">


        </form>

    </div>

    </body>

    </html>

<?php
if (isset($_POST['update']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $userid=$_POST['userid'];
    $password=$_POST['password'];

    $sql4="SELECT * FROM users";
    $query4=mysqli_query($conn,$sql4);

    $row2=mysqli_fetch_array($query4);


    if ($row2['email'] != $email){
        $sql="UPDATE users SET username='$name',email='$email',password='$password',address='$address' where userid='$userid'";
        $query=mysqli_query($conn,$sql);

        if ($query){
           // header("Location:logout.php");
            echo '<script type="text/javascript">window.location.href = "logout.php";</script>';
        }
    }elseif ($row2['password'] != $password){
        $sql="UPDATE users SET username='$name',email='$email',password='$password',address='$address' where userid='$userid'";
        $query=mysqli_query($conn,$sql);

        if ($query){
            // header("Location:profile.php");
            echo '<script type="text/javascript">window.location.href = "logout.php";</script>';

        }
    }else{
        $sql="UPDATE users SET username='$name',email='$email',password='$password',address='$address' where userid='$userid'";
        $query=mysqli_query($conn,$sql);

        if ($query){
            // header("Location:profile.php");
            echo '<script type="text/javascript">window.location.href = "profile.php";</script>';

        }
    }



}

?>