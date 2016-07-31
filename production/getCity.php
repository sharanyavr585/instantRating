<?php

$con=mysqli_connect("localhost","minoura","minoura","instantRating");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$state= $_GET['state'];

//do the db query here

$query  = "select distinct locality from restaurant where state='$state';";

$result = $con->query($query);



if ($result->num_rows > 0) {


    $temp = array();
    while($row = $result->fetch_assoc()) {

        if (empty($temp)) {
            $temp = array($row['locality']);
        } else {
            array_push($temp, $row['locality']);
        }

    }


    echo(json_encode($temp));

} else {
    var_dump($result);
}
?>


