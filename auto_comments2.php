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
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities,100 * 1000,100 * 1000);

$web_driver->get("http://localhost/teeme");
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Teeme"));
   $web_driver->findElement(WebDriverBy::id("place_name1"))
            ->sendKeys("new_place");
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->wait()->until(
   WebDriverExpectedCondition::urlIs("http://localhost/teeme/new_place"));
 $web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("jerry@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("jerrytbb") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
            $web_driver->manage()->timeouts()->implicitlyWait(10);

 $web_driver->wait(60,1000)->until(
   WebDriverExpectedCondition::titleIs("Home > Dashboard")
);  
//  $web_driver->manage()->timeouts()->implicitlyWait(10);

//  $web_driver->get("http://dev.teeme.net/dashboard/index/13/type/1/1");

//  $web_driver->wait()->until(
//    WebDriverExpectedCondition::titleIs("Home > Dashboard")
// );

 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->click();
 // $web_driver->manage()->timeouts()->implicitlyWait(10);
 $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->getAttribute('href');
 $web_driver->get($currentURL);

 $web_driver->wait(60,1000)->until(
   WebDriverExpectedCondition::titleIs("Teeme > Post")
);

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
	if($number<=4)
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
		// $web_driver->quit();
  //   die();
    $web_driver->executeScript('window.scrollTo(0,0);');
    // require 'auto_quote_comments.php';
    $number=0;
  check_posts_quote($web_driver,$number);
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
      	$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[10]/div[1]/div/div[3]/div/p"))->sendKeys("get quoted");
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

function check_posts_quote($web_driver,$number)
 {
  $number=$number+2;
  if($number<=4)
  {
    $web_driver->manage()->timeouts()->implicitlyWait(10);
    $web_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]")));
    $element=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]"));
    if($element==!null)
    {
      $nodes=get_present_comments($web_driver,$number);
      // echo "<pre>";
      // print_r($nodes);
      // die();
      if(!empty($nodes))
      {
        // make quote comments here
        $done=make_quote_comments($web_driver,$nodes,$number);
        if($done=="done")
        {
          die("complete");
        }
      }
      else
      {
        echo "comments can not be made";
        $web_driver->quit();
        die();
      }
    }
    else
    {
      echo "talkformchat not found";
      $web_driver->quit();
      die();
    }
  }
  else
  {
    echo "exceeds limit";
    // $web_driver->quit();
    die();
  }
 }
// $web_driver->quit();
function  get_present_comments($web_driver,$number)
{
  // $all=$web_driver->findElements(WebDriverBy::className("postWebChatBoxSelf"));
  // $i=0;
  //
  $all_ids=array();
  $data=array(); 
  $j=0;
  $comment_id=0;
  for ($i=1; $i <=5 ; $i++)
  { 
  
    $more=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[8]/div/div[2]/a"));
    echo "<br>";
    print_r($more);
    if(!empty($more))
    {
      
        $is_present=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[8]/div/div[3]/div[3]"));
        echo "<br>";
        print_r($is_present);
        if($is_present!==null)
        {
          foreach ($is_present as $key => $value) 
          {
            $comment_id=$value->getAttribute("id");
          }
          echo "<br>";
          print_r($comment_id);
          if($comment_id!==0)
          {
            $all_ids[$i]=$comment_id;
            $comment_id=0;
          }
           
           $j=$j+1;
           $is_present='';
        }
        else
        {
          $all_ids[$i]=0;
          // also see "view more comments" issue can change the xpath.
        }
      
      $more='';
      // return $data;
    }
    else
    {
      echo "in else";
      
        $is_present=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[".$number."]/form[".$i."]/div/div[2]/div[2]/div[8]/div/div[2]/div[2]"));
        if($is_present!==null)
        {
          foreach ($is_present as $key => $value) 
          {
            $comment_id=$value->getAttribute("id");
          }
          echo "<br>";
          print_r($comment_id);
          if($comment_id!==0)
          {
            $all_ids[$i]=$comment_id;
            $comment_id=0;
          }
           $j=$j+1;
           $is_present='';
        }
        else
        {
          $all_ids[$i]=0;
          // also see "view more comments" issue can change the xpath.
        }
      //  $data["ids"]=$all_ids;
      // $data["count"]=$j;
      
    }
  }
  $data["ids"]=$all_ids;
      $data["count"]=$j;
      return $data;
}
function make_quote_comments($web_driver,$nodes,$number)
{
  $ids=$nodes["ids"];
  foreach ($ids as $key => $value) 
  {
    if($value!=='0'||$value!==0)
    {
      $found=$web_driver->findelements(WebDriverBy::id($value));
    if(!empty($found))
    {
      $web_driver->manage()->timeouts()->implicitlyWait(10);
      $id_number = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);

      $web_driver->findElement(WebDriverBy::id("nestedCommentLeafIcon".$id_number))->click();
      
      $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("nestedCommentTextBox".$id_number)));
      //*[@id="nestedCommentTextBox694"]/div[1]/div/div[3]/div/p

      $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('//*[@id="nestedCommentTextBox'.$id_number.'"]/div[1]/div/div[3]/div/p')));
      $web_driver->findElement(WebDriverBy::xpath('//*[@id="nestedCommentTextBox'.$id_number.'"]/div[1]/div/div[3]/div/p'))->sendkeys("quoted comment");
      

      $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('//*[@id="nestedCommentTextBox'.$id_number.'"]/div[2]/input[1]')));

      $web_driver->findElement(WebDriverBy::xpath('//*[@id="nestedCommentTextBox'.$id_number.'"]/div[2]/input[1]'))->click();
      $web_driver->manage()->timeouts()->implicitlyWait(10);
    }
    }
  }
  $web_driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
   $web_driver->executeScript('window.scrollTo(0, 400);');
   $web_driver->manage()->timeouts()->implicitlyWait(10);
   check_posts_quote($web_driver,$number);
  // return "done";
}
?>