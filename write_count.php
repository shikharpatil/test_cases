<?php
echo "hello";
$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
$count=fread($myfile,filesize("newfile.txt"));
if($count==500)
{
	$post_count=$count;
	$post_count=(int)$post_count;
	if(is_int($post_count))
	{
		echo "yes";
	}
	// echo "no";
}
else
{
	$post_count=$count;
	if(is_int($post_count))
	{
		echo "no";
	}
}
// $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
// $txt = 400;
// fwrite($myfile, $txt);
// fclose($myfile);
// $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
// $txt = 500;
// fwrite($myfile, $txt);

?>