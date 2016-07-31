<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <script type="application/javascript">window.location.replace("http://instantrating.co/Boots4_HTML/index.html");</script>
 <?php

/*
    error_reporting(E_ERROR | E_PARSE);
    $servername = "localhost";
    $username = "minoura" ;
    $password = "minoura" ;
    $dbname = "instantRating";
	global $servername, $username , $password , $dbname;
	
	//create connection
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	
	//check connection
	if(!$conn){
     	die("connection failed:" .mysqli_connect_error());
     	}
   
   //$key = "AIzaSyAs5uUsFp_-XtVL35nST3lb0UL8cdj_wuM";
   $key = "AIzaSyAcn4M8aTETHMqQPaWIkhKFjWeMg0K04oc";
   $lattitude="28.538336";
   $longitude="-81.379234";
   $radius="5000";
   $type="restaurant";
   //$url= "https://maps.googleapis.com/maps/api/place/radarsearch/json?location=" . $lattitude . "," . $longitude . "&radius=" .$radius ."&type=" .$type. "&key=" .$key;
   $url="https://maps.googleapis.com/maps/api/place/radarsearch/json?location=" . $lattitude . "," . $longitude . "&radius=5000&type=".$type ."&key=".$key;

   	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl); 
	$resp = json_decode($resp, true);
	$results = $resp['results'];
	
	foreach ($results as $place) {

		$placeId=$place['place_id'];
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
		$restaurantName= $result1['name'];
		$restaurantId = $result1['place_id'];
        $locality=$result1['address_components'][2]['long_name'];
        $address=$result1['formatted_address'];
        $priceLevel = $result1['price_level'];
        $overallRating = $result1['rating'];
        $website=$result1['website'];
        $reviews = $result1['reviews'];
        $user_ratings_total=$result1['user_ratings_total'];

        $sql = "insert into restaurant values(\"".$restaurantId."\",\"".$restaurantName."\",\"".$address."\",\"".$locality."\",\"".$priceLevel."\",\"".$overallRating."\",\"".$user_ratings_total."\",\"".$website."\");";
     	 
        if ($conn->query($sql) === TRUE) {

        	foreach ($reviews as $review){
            	$userRating= $review['rating']."<br>";
        		//$userReview=$review['text']."<br>";
        		$timeOfRating= $review['time']."<br>";
        		$sql1 = "insert into review values(\"".$restaurantId."\",\"".$timeOfRating."\",\"".$userRating."\");";

        		 if ($conn->query($sql1) === TRUE) {
        		 	echo "Done ";
        		 } else {
		    		echo "Error: " . $sql1 . "<br>" . $conn->error;
				}
			}
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}		

   
    }
    $conn->close();

*/
?>
 </body>
</html>
