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


$sql7="SELECT * from exam";
$query7=mysqli_query($conn,$sql7);
$row3=mysqli_fetch_array($query7);

//$_SESSION['examid']=$row3['examid'];
$_SESSION['examname']=$row3['examname'];
$_SESSION['starttime']=$row3['starttime'];

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
  body{
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

<br>

  <script>
      function showHideContent() {
          <?php
          $sql121="SELECT * FROM exam";
          $query121=mysqli_query($conn,$sql121);
          $data121=mysqli_fetch_array($query121);
          $starttime=$data121['starttime'];
          $endtime=$data121['endtime'];
          ?>
          const currentTime = new Date();
          var starttime="<?php echo $starttime ?>";
          var endtime="<?php echo $endtime ?>";
          const startDate = new Date(starttime); 
          const endDate = new Date(endtime);   
          if (currentTime >= startDate && currentTime <= endDate) {
              document.getElementById('category').style.display = 'block';
              document.getElementById('content2').style.display = 'none';
          } else {
             document.getElementById('category').style.display = 'none';
          }
      }

      window.onload = function() {
          showHideContent();
      };

      setInterval(showHideContent, 0);
  </script>

  <script>
      let buttonClicked = false;
      function autoClickButton() {
          if (!buttonClicked) {
              document.getElementById("myButton").click();
              buttonClicked = true; 
          }
      }
      <?php
      $sql121="SELECT TIME(endtime) AS end_time FROM exam";
      $query121=mysqli_query($conn,$sql121);
      $data121=mysqli_fetch_array($query121);
      $endtime=$data121['end_time'];
      ?>
      const clickTime = "<?php echo $endtime?>";
      const currentTime = new Date();
      const [desiredHours, desiredMinutes, desiredSeconds] = clickTime.split(":");
      const clickDate = new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate(), desiredHours, desiredMinutes, desiredSeconds);
      let timeoutDelay = clickDate - currentTime;

      if (timeoutDelay > 0) {
          setTimeout(autoClickButton, timeoutDelay);
      }
  </script>

  <script>
      function showHideContent() {
          <?php
          $sql121="SELECT * FROM exam";
          $query121=mysqli_query($conn,$sql121);
          $data121=mysqli_fetch_array($query121);
          $starttime=$data121['starttime'];
          $endtime=$data121['endtime'];
          ?>
          const currentTime = new Date();
          var starttime="<?php echo $starttime ?>";
          var endtime="<?php echo $endtime ?>";
          const startDate = new Date(starttime);
          const endDate = new Date(endtime);   
          if (currentTime >= startDate && currentTime <= endDate) {
              document.getElementById('examstart').style.display = 'none';
          }if(currentTime < startDate){
              document.getElementById('examstart').style.display = 'block';
          }else{
              document.getElementById('examstart').style.display = 'none';
          }
          if(currentTime > endTime){
              document.getElementById('mcg').style.display = 'block';
          }else{
              document.getElementById('mcg').style.display = 'none';
          }
      }
      window.onload = function() {
          showHideContent();
      };

      setInterval(showHideContent, 0);
  </script>


  <script>
      <?php
      $sql12="SELECT * FROM exam";
      $query12=mysqli_query($conn,$sql12);
      $data12=mysqli_fetch_array($query12);
      $endtime=$data12['endtime'];
      ?>
      
      var time="<?php echo $endtime?>";
      var endTime = new Date(time).getTime(); 

      function updateCountdown() {
          var currentTime = new Date().getTime();
          var timeDifference = endTime - currentTime;

          var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

          var countdownDisplay = document.getElementById("countdown");
          countdownDisplay.innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

          if (timeDifference <= 0) {
              countdownDisplay.innerHTML = "Countdown expired";
              clearInterval(countdownInterval);
              setTimeout(function() {
              }, 1000); 
          }
      }

      var countdownInterval = setInterval(updateCountdown, 1000);
      window.onload = function() {
          updateCountdown(endTime);
      }
  </script>
<br>
  <br>
  <br>
  <label id="mcg" style="float: ; font-size: 18px; padding:10px;font-weight:bold;margin-left: 550px">
      Wait for the next exam
  </label> <br><br>
  <label id="examstart" style="float: ; font-size: 18px; padding:10px;font-weight:bold;margin-left: 450px">
      <?php

      $sql4="SELECT * from exam";
      $query4=mysqli_query($conn,$sql4);
      $row1=mysqli_fetch_array($query4);
      echo "Exam will be started at: ".$row1['starttime'];
      ?>
  </label> <br><br>
  <label style="float: left;font-size: 20px; font-weight: bold;margin-left: 500px; padding: 10px">Current Time</label>
  <div id="current-time" style="width: 100px;font-weight: bold; float:left;text-align: center;padding: 10px; margin-left: 10px; margin-top: 0px; background-color: yellow; color:black">
      <?php
      date_default_timezone_set('Your/Timezone');
      $current_time = date('H:i:s');
      echo $current_time;
      ?>
  </div>

  <script>
      function updateTime() {
          const currentTimeElement = document.getElementById('current-time');
          const now = new Date();
          const hours = String(now.getHours()).padStart(2, '0');
          const minutes = String(now.getMinutes()).padStart(2, '0');
          const seconds = String(now.getSeconds()).padStart(2, '0');
          const currentTime = hours + ':' + minutes + ':' + seconds;
          currentTimeElement.textContent = currentTime;
      }
      updateTime();
      setInterval(updateTime, 1000); 
  </script>


<div id="category">
<?php



$conn=mysqli_connect("localhost:3306","root","180238","online_examination_system");

if (isset($_SESSION['chapterid'])){
    $chapterid=$_SESSION['chapterid'];
    $class=$_SESSION['class3'];
    $subject=$_SESSION['subject3'];
    $chapter=$_SESSION['chapter'];
   

    $sql11="SELECT DATE_FORMAT(starttime, '%h:%i:%s') AS srttime FROM exam";

    $query11=mysqli_query($conn,$sql11);
    $data1=mysqli_fetch_array($query11);

    $start=$data1['srttime'];

$sql12="SELECT TIMEDIFF(endtime, starttime) AS time_diff FROM exam";
$query12=mysqli_query($conn,$sql12);
$data13=mysqli_fetch_array($query12);
$tot_time=$data13['time_diff'];

    echo "<p style='text-align: center; font-size: 20px; font-weight: bold;'>Exam: $subject</p>";
    echo "<p style='text-align: center'>Chapter: $chapter</p>";
    echo "<p style='text-align: center'>Class: $class</p>";
    echo "<p style='text-align: center'>Total Time: $tot_time</p>";
    echo "<label style='float: left; font-weight: bold'>Exam Started At:</label> <label style='float: right; font-weight: bold; margin-left: 30px'> Time Remaining:<?php echo $start; ?></label><br>";
    echo "<label style='background-color: darkblue; color: white; font-weight: bold; padding: 10px' id='countdown'>Remaining Time</label>";
    echo "<label><?php echo $start; ?></label>";
    echo "$start";
    $sql="SELECT * from question where class='$class' AND subject='$subject' AND chapter='$chapter'";
    $query=mysqli_query($conn,$sql);
    ?>
        <br><br><br>
    <hr style="width: 700px; margin-left: 50px"><br><br>
    <form id="examForm1" method="post" action="process_exam.php">
        <?php
         $number=0;
        while ($row=mysqli_fetch_array($query)){
            $number++;
            $question_id=$row['questionid'];
            echo $number.". ".$row['question']."<br>";
            echo "<input type='radio' name='q$question_id' value='{$row['option1']}'> {$row['option1']}<br>";
            echo "<input type='radio' name='q$question_id' value='{$row['option2']}'> {$row['option2']}<br>";
            echo "<input type='radio' name='q$question_id' value='{$row['option3']}'> {$row['option3']}<br>";
            echo "<input type='radio' name='q$question_id' value='{$row['option4']}'> {$row['option4']}<br>";
            echo "<br>";
        }
        ?>
        <button id="myButton" name="submit">Submit</button>
    </form>
    <?php
}

?>
</div>

</body>

</html>