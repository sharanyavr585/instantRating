<?php

$con=mysqli_connect("localhost","minoura","minoura","instantRating");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$city= $_GET['city'];

//do the db query here

$query  = "select distinct restaurantName from restaurant where locality='$city';";

$result = $con->query($query);



if ($result->num_rows > 0) {


    $temp = array();
    while($row = $result->fetch_assoc()) {

        if (empty($temp)) {
            $temp = array($row['restaurantName']);
        } else {
            array_push($temp, $row['restaurantName']);
        }

    }


    echo(json_encode($temp));

} else {
    var_dump($result);
}
?>


