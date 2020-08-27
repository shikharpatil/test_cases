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
if($element!==null)
{
	$number=0;
$number=check_posts($web_driver,$number);
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
	 		$nodes=check_comment_icon($web_driver,$number);
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

function check_comment_icon($web_driver,$number)
{
	$j=0;
	// print_r("j=>".$j);
	for ($i=1; $i <=5 ; $i++) 
	{ 
		$SubElement=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div"));
 		if($SubElement!==null)
 		{
 			$j=$j+1;
 		}
	}
	echo "<br>";
	print_r("j=>".$j);
	return $j;
}

function make_comments($web_driver,$number,$nodes)
{
   for($i=1;$i<=$nodes;$i++) 
   {
   	$web_driver->manage()->timeouts()->implicitlyWait(10);
       $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div")));

       $web_driver->manage()->timeouts()->implicitlyWait(10);

       $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div")));

       $comment_add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div"))->getAttribute("id");
       echo "<br>";
       print_r($comment_add);
       $web_driver->manage()->timeouts()->implicitlyWait(10);
       // $web_driver->executeScript('location.href = "#";location.href = "#'.$comment_add.'";');
       $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id($comment_add)));

       $clicked=$web_driver->findElements(WebDriverBy::id($comment_add));
       if($clicked == null || empty($clicked))
       {
           $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div")));

       $web_driver->manage()->timeouts()->implicitlyWait(10);

       $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div")));
       $comment_add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div"))->getAttribute("id");
       $web_driver->findElement(WebDriverBy::id($comment_add))->click();
       }
       else
       {
       	    $web_driver->findElement(WebDriverBy::id($comment_add))->click();
       }
       // $web_driver->executeScript("document.getElementById(".$comment_add.").click();");

       // $node = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
       $web_driver->manage()->timeouts()->implicitlyWait(10);
       $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]")));
       
       $comment_box=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]"))->getAttribute("id");
       $web_driver->manage()->timeouts()->implicitlyWait(10);

       	    // $element=$web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id($comment_box)));
       	    $find=$web_driver->findElements(WebDriverBy::id($comment_box));
       if($find==null || $find ==0 || $find==false ||$find=='' || empty($find))
       {
       	   $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div")));

       $web_driver->manage()->timeouts()->implicitlyWait(10);

       $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div")));

       $comment_add=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[5]/div[1]/span/div"))->getAttribute("id");
       $web_driver->manage()->timeouts()->implicitlyWait(10);
       // $web_driver->executeScript('location.href = "#";location.href = "#'.$comment_add.'";');
       $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id($comment_add)));

       $web_driver->findElement(WebDriverBy::id($comment_add))->click();
       // $web_driver->executeScript("document.getElementById(".$comment_add.").click();");

       // $node = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
       $web_driver->manage()->timeouts()->implicitlyWait(10);
       $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]")));
       
       $comment_box=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]"))->getAttribute("id");
       }
       
       

       // $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]")));
      //*[@id="CommentTextBox310"]
      //*[@id="CommentTextBox313"]/div[1]/div/div[3]/div/p
       $web_driver->manage()->timeouts()->implicitlyWait(10);
       // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p")));
       // $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p")));
      $editor=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p"));
      if(empty($editor) || $editor==null)
      {
      	echo "<br>isme<br>";
      	$web_driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
   $web_driver->executeScript('window.scrollTo(0, 400);');
   $web_driver->manage()->timeouts()->implicitlyWait(10);
   check_posts($web_driver,$number);

      }
      else
      {
      	$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p"))->sendKeys("commenting12365371652");
      }
      //*[@id="CommentTextBox310"]/div[1]/div/div[3]/div/p
      $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[2]/input[1]")));
      $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[2]/input[1]"))->click();
      $web_driver->manage()->timeouts()->implicitlyWait(10);
   }
   $web_driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
   $web_driver->executeScript('window.scrollTo(0, 400);');
   $web_driver->manage()->timeouts()->implicitlyWait(10);
   check_posts($web_driver,$number);
   // return true; 
}
// /html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p
// /html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p
?>