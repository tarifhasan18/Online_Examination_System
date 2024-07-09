<?php
   use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

session_start();
include 'conn.php';

if (isset($_SESSION['userid']))
{
    $userid=$_SESSION['userid'];
    $email=$_SESSION['email'];
    $username=$_SESSION['username'];
}else{
    header("Location:login.php");
}

$userid=$_SESSION['userid'];
$sql3="SELECT * from users where userid='$userid'";
$query3=mysqli_query($conn,$sql3);
$data=mysqli_fetch_array($query3);

// Connect to the database
//$db = new mysqli("localhost:3306", "root", "180238", "quiz_system_trial");
if (isset($_SESSION['chapterid'])){
    $chapterid=$_SESSION['chapterid'];
    $class=$_SESSION['class3'];
    $subject=$_SESSION['subject3'];
    $chapter=$_SESSION['chapter'];
    $number=0;
}

// Initialize the user's score
$score = 0;
$wrong = 0;
$total = 0;
// Loop through the submitted answers and compare with correct answers in the database
$sql="SELECT * from question where class='$class' AND subject='$subject' AND chapter='$chapter'";
$result = mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		$total++;
        $question_id = $row['questionid'];
        $selected_option = $_POST["q$question_id"];
        $correct_option = $row['correct'];

        if ($selected_option === $correct_option) {
            $score++;
        }else{
            $wrong++;
        }
    }
}

//$examid=$_SESSION['examid'];
$examname=$_SESSION['examname'];
$examtime=$_SESSION['starttime'];

$sql6="Insert into result(examname,email,username,class,subject,chapter,total,marks,date) values('$examname','$email','$username','$class','$subject','$chapter','$total','$score','$examtime')";

$query6=mysqli_query($conn,$sql6);
$hostname="Online Examination System";
$hostemail="mdtarifhasan1997@gmail.com";

$emailsubject="Exam Marks";
$message="$username your Recent Result is here. Check it out <br><br>Exam Name: $examname<br>Class: $class <br> Subject: $subject <br> Chapter: $chapter<br><br>Yo've got $score out of $total. <br> Correct: $score and Wrong: $wrong<br> <br> Click here to see your All Results and Ranks: <br>http://localhost/Online%20Examination%20System/profileresult.php <br><br> Regards <br> Online Exam System<br>Thank You";

$email=$data['email'];
//$receiveremail="tarifhasan725@gmail.com";
//$receiverName="Tarif Hasan";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mdtarifhasan1997@gmail.com'; //Host Email
    $mail->Password = 'kssnpkgsmqnjoock'; // Host email App Password
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($hostemail, $hostname); // Sender's Email and Name
    $mail->addAddress("$email");
    $mail->Subject = ("$emailsubject");
    $mail->Body = $message;


    //header("Location: ./index.php?=email_sent!");
    if ($mail->send()) {
    echo "<br>Your result has been sent to $email.";
}else {
    echo "Email sending failed: " . $mail->ErrorInfo;
}
// Store the user's score in the session
$_SESSION['score'] = $score;
$_SESSION['wrong'] =$wrong;
$_SESSION['total']=$total;


//$sql="INSERT into result(marks) values('$score')";
//$query=mysqli_query($conn,$sql);
// Close the database connection
$conn->close();

// Redirect to a result page or display the score
header("Location: result1.php");
?>
