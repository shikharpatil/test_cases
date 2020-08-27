<?php
$data = array ("Firstname,Lastname,Email,User Tag Name Preference");
$name="user";
$number=1;

    $fp = fopen('usernames.csv', 'w');
    foreach($data as $line){
             $val = explode(",",$line);
             fputcsv($fp, $val);
    }

    for ($i=1; $i <= 10000 ; $i++) 
    { 
    	$userData=array($name.$i.",".$i.",".$name.$i."@teeme.net,f_l");
    	foreach($userData as $line)
    	{
             $val = explode(",",$line);
             fputcsv($fp, $val);
        }
        echo "<pre>";
    	print_r($val);
    }
    fclose($fp);

?>