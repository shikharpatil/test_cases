<?php
//include 'posts_class.php';
class send_mail 
{

    public function mail()
    {
    	$to = "patilshikhar@gmail.com";
		// $to = "shikhar.patil@teambeyondborders.com";
		$subject = "Mail from php script";
		$txt = "check 3";
		$headers = "From: shikhar.patil@teambeyondborders.com" ;
		// "CC: somebodyelse@example.com";

		$delivered=mail($to,$subject,$txt,$headers);
		print_r($delivered);
    }
    function connectToDatabase()
    {
        $sql=mysqli_connect("localhost","root","root","post_count");
        if(!$sql)
        {
	        die("connection not established");
        }
        else
        {
            return $sql;
        }
    } 
}

?>