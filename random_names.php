<?php
// $data = array ("Firstname,Lastname,Email,User Tag Name Preference");
$Name="User";
$name="user";
$number=1;

    $fp = fopen('10kusernames1.csv', 'w');
    // foreach($data as $line){
    //          $val = explode(",",$line);
    //          fputcsv($fp, $val);
    // }844951

    for ($i=1; $i <= 10000 ; $i++) 
    { 
        if($i<10)
        {
            $firstname=$Name."0".$i."Firstname";
            $lastname=$Name."0".$i."Lastname";
            $email=$name."0".$i."@teeme.net";
            $password=$name."0".$i;
            $tagNamePreference="f_l";
        }
        else
        {
            $firstname=$Name.$i."Firstname";
            $lastname=$Name.$i."Lastname";
            $email=$name.$i."@teeme.net";
            $password=$name.$i;
            $tagNamePreference="f_l";
        }
        $final=$firstname.','.$lastname.','.$email.','.$password.','.$tagNamePreference;
        // print_r($final);
        // echo "<br>";
    	$userData=array($final);
    	foreach($userData as $line)
    	{
             $val = explode(",",$line);
             fputcsv($fp, $val);
        }
     //    echo "<pre>";
    	// print_r($val);
    }
    fclose($fp);

?>