<?php
session_start();
$con=mysqli_connect("localhost","minoura","minoura","instantRating");
// Check connection

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userName=$_POST['userName'];
$password=$_POST['password'];

$sql= "SELECT username, password FROM `user` where username='$userName' and password='$password';";

if ($result=mysqli_query($con,$sql))
{
    // Return the number of rows in result set
    $rowcount=mysqli_num_rows($result);
    if($rowcount>0){

        //$_SESSION['userName']=$userName;
        header('Location: newFilter.php');
    } else {

        echo '<script language="javascript">';
        echo 'alert("The username or Password does not exist")';
        echo '</script>';
    }
}

mysqli_close($con);
?>
