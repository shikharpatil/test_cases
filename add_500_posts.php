<?php
// script for gettin movie data
$movie_name=file("movies.txt");
$file_count=count($movie_name);
$post=array();
// $info="";
print_r($file_count);
for ($i=0; $i < 5; $i++) 
{ 
	echo $movie_name[$i];
	echo "<br>";

	$str=str_replace(" ","%20",$movie_name[$i]);
	$str=rtrim($str);
	echo $str;
	$url = "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=".$str."&format=json";
	echo "<br>";
	echo $url;
	// $url = "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=The%20Godfather&format=json";
		// $url = 'http://localhost/ci-rest-api/api/student/';
		// $data=array("token"=>$token);
        // initializing a new curl session 
        $curl = curl_init($url);
    
        // curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);

        // check for result is true or false
        if(!$result)
        {
            die("Connection Failure");
        }
        // closing a curl session
        curl_close($curl);
        // print_r($result);
        // die();

        // decoding the json data into array
        $response = json_decode($result, true);
        echo "<br>";
        // echo "<pre>";
        // print_r($response["query"]["search"]);
        $info=null;
        foreach ($response["query"]["search"] as $value) 
        {
        	
        	// echo "<br>";
        	// print_r($value);
        	foreach ($value as $data) 
        	{
        		$info=$info.$data;
        	}
        	// $post[$i]=$post[$i].$info;
        }
        $post[$i]=$info;
}
echo "<pre>";
print_r($post);
        // return $response;
?>