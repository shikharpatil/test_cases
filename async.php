<?php
// array of curl handles
$multiCurl = array();
// data to be returned
$result = array();
$arrayUrl2=array(0=>'https://www.google.com',1=>'https://www.php.net',2=>'https://www.wikipedia.org',
);
// print_r($arrayUrl);
// die;
// multi handle
$mh = curl_multi_init();
for ($i=0;$i<3;$i++) 
{
  // URL from which data will be fetched
  $multiCurl[$i] = curl_init();
  curl_setopt($multiCurl[$i], CURLOPT_URL,$arrayUrl2[$i]);
  curl_setopt($multiCurl[$i], CURLOPT_HEADER,0);
  curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,1);
  curl_multi_add_handle($mh, $multiCurl[$i]);
}
$index=null;
do 
{
  curl_multi_exec($mh,$index);
}
while($index > 0);

print_r("hello");
// get content and remove handles
foreach($multiCurl as $k => $ch) 
{
  $result[$k] = curl_multi_getcontent($ch);
  // print_r($k);
  curl_multi_remove_handle($mh, $ch);
}
// close
curl_multi_close($mh);
// echo "<pre>";
print_r($result);
print_r("hello");
?>