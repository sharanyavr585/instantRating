<?php

$con=mysqli_connect("localhost","root","root","instantRating");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userName=$_POST['userName'];
$password=$_POST['password'];
$email=$_POST['email'];


$sql="SELECT username,email from user where username='$userName';";

if ($result=mysqli_query($con,$sql))
{
    // Return the number of rows in result set
    $rowcount= $result->num_rows;
    

    if($rowcount>0){

//need to get the alert in the same page
        echo '<script language="javascript">';
        echo 'alert("The username or email id already exists")';
        echo '</script>';

    }

    else
    {

        $sql1 = "INSERT INTO `user` VALUES ('$userName','$password','$email');";

        if($result1=mysqli_query($con,$sql1)){
            header('Location: login.html');
        }
        else{
            var_dump($result1);
        }

    }

}

mysqli_close($con);








