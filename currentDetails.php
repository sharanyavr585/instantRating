<html>
<head>
    <title>Current Details</title>
</head>
<body>
<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root" ;
$password = "root" ;
$dbname = "instantRating";
global $servername, $username , $password , $dbname;

//create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);

//check connection
if(!$conn){
    die("connection failed:" .mysqli_connect_error());
}
$sql="select restaurantId from restaurant;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $placeId=$row["restaurantId"];
        $key = "AIzaSyAcn4M8aTETHMqQPaWIkhKFjWeMg0K04oc";
        //code to fetch rating and reviewTime for each placeId that has been fetched from the database.
        $url1 = "https://maps.googleapis.com/maps/api/place/details/json?placeid=" . $placeId . "&key=" .$key;
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url1,
        ));
        $response = curl_exec($curl1);
        curl_close($curl1);
        $response = json_decode($response, true);
        $result1= $response['result'];
        $reviews = $result1['reviews'];

            foreach ($reviews as $review){
                $userRating= $review['rating']."<br>";
                //$userReview=$review['text']."<br>";
                $timeOfRating= $review['time']."<br>";
                $sql3 ="select max(reviewTime) from review where restaurantId=\"$placeId\";";
                $result2 = $conn->query($sql3);
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while ($row = $result2->fetch_assoc()) {
                        $reviewTime=$row["reviewTime"];

                        if($timeOfRating>$reviewTime){

                            $sql1 = "insert into review values(\"".$placeId."\",\"".$timeOfRating."\",\"".$userRating."\");";
                            if ($conn->query($sql1) === TRUE) {
                                echo "Done ";
                            }

                            else {
                                echo "Error: " . $sql1 . "<br>" . $conn->error;
                            }


                        } else {
                            echo "Nothing to insert.";
                        }

                    }

                }



            }


   }

}
 else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>
