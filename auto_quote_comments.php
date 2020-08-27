<?php
// script for adding comments
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);

$web_driver->get("http://dev.teeme.net");
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Teeme"));
   $web_driver->findElement(WebDriverBy::id("place_name1"))
            ->sendKeys("xyz2");
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->wait()->until(
   WebDriverExpectedCondition::urlIs("http://dev.teeme.net/xyz2"));
 $web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("user100@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("user100") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
 $web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Home > Dashboard")
);  
 $web_driver->manage()->timeouts()->implicitlyWait(10);

 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->click();
 // $web_driver->manage()->timeouts()->implicitlyWait(10);
 $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->getAttribute('href');
 $web_driver->get($currentURL);

 $web_driver->manage()->timeouts()->implicitlyWait(10);
 $web_driver->findElement(WebDriverBy::id("leftMenuToggleIcon"))->click();
$web_driver->manage()->timeouts()->implicitlyWait(10);
$element=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]"));
if ($element!==null) 
{
	$number=0;
	check_posts($web_driver,$number);
}
function check_posts($web_driver,$number)
 {
 	$number=$number+2;
	if($number<25)
	{
		$web_driver->manage()->timeouts()->implicitlyWait(10);
		$web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]")));
		$element=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]"));
	 	if($element==!null)
	 	{
	 		$nodes=get_present_comments($web_driver);
	 		if($nodes==0)
	 		{
	 			echo "no more posts loaded";
	 			$web_driver->quit();
	 		}
	 		else
	 		{
	 			$done=make_comments($web_driver,$number,$nodes);
	 		}
	 	}
	 	else
	 	{
	 		echo "talkformchat not found";
	 		$web_driver->quit();
	 	}
	}
	else
	{
		echo "exceeds limit";
		$web_driver->quit();
	}
 }
// $web_driver->quit();
function  get_present_comments($WebDriver)
{
	// $all=$web_driver->findElements(WebDriverBy::className("postWebChatBoxSelf"));
	// $i=0;
	//
	$all_ids=array();
	$data=array(); 
	$j=0;
	for ($i=1; $i <= 5; $i++) 
	{ 
		$is_present=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[".$i."]/div/div[2]/div[2]/div[8]/div/div[2]/div[2]"));
		if($is_present!==null)
		{
			foreach ($all as $key => $value) 
			{
				$comment_id=$value->getAttribute("id");
			}
			 $all_ids[$i]=$comment_id;
			 $j=$j+1;
		}
		else
		{
			$all_ids[$i]=0;
		}
	}
	$data["ids"]=$all_ids;
	$data["count"]=$j;
	return $data;
	
}
//*[@id="comment692"]
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[8]/div/div[2]/div[2]
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[8]/div/div[2]/div[2]
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[2]/div/div[2]/div[2]/div[8]/div/div[2]/div[2]
?>