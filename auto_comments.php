<?php
// script for adding comments
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
session_start(0);
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
            ->sendKeys("user1@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("user1") ;
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

 // $web_driver->wait()->until(
 //         WebDriverExpectedCondition::titleIs("Home > Post")
 //      ); 
function get_all_elements($web_driver)
{
   $elements=$web_driver->findElements(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[5]/div[1]/span/div"));
   $num=0;
   $count=count($elements);
   foreach ($elements as $key => $value) 
   {
   
      $ids=$value->getAttribute("id");
      // echo "<br>";
      // print_r($ids);
      // $node[$num] = (int) filter_var($ids, FILTER_SANITIZE_NUMBER_INT);
      $node[$num]=$ids;
      $num++;
   }
   return $node;
}

function make_comments($web_driver,$commentIconIds)
{
   foreach ($commentIconIds as $key => $value) 
   {
       $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id($value))); 
       $web_driver->findElement(WebDriverBy::id($value))->click();

       $node = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
       $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('//*[@id="CommentTextBox'.$node.'"]')));
      //*[@id="CommentTextBox310"]
      //*[@id="CommentTextBox313"]/div[1]/div/div[3]/div/p
      $web_driver->findElement(WebDriverBy::xpath('//*[@id="CommentTextBox'.$node.'"]/div[1]/div/div[3]/div/p'))->sendKeys("comment 2121");
      //*[@id="CommentTextBox310"]/div[1]/div/div[3]/div/p
      $web_driver->findElement(WebDriverBy::xpath('//*[@id="CommentTextBox'.$node.'"]/div[2]/input[1]'))->click();
      $web_driver->manage()->timeouts()->implicitlyWait(10);
   }
   return true; 
}
function new_load($web_driver)
{
   $web_driver->executeScript('window.scrollTo(0,document.body.scrollHeight);')
      $web_driver->manage()->timeouts()->implicitlyWait(10);
   $elements=$web_driver->findElements(WebDriverBy::className("talkformchat"));
   if($_SESSION["batch"]==1)
   {
      $_SESSION["batch"]=count($elements);
      if($_SESSION["batch"]>1)
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   else
   {
      $loaded=count($elements);
      if($loaded<$_SESSION["batch"])
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   
}

function load_posts($web_driver,$commentsMade)
{
   if($commentsMade==true)
   {
      // check if posts are loaded or not
      $loaded=new_load($web_driver);
      if($loaded==true)
      {
         $web_driver->findElements(WebDriverBy::xpath)
      }
      else
      {

      }
   }
}
// $parent=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]"));
// $children=$web_driver->findElements(WebDriverBy::className("offset"));
$_SESSION["batch"]=1;
$commentIconIds=get_all_elements($web_driver);
$commentsMade=make_comments($web_driver,$commentIconIds);
$loaded=load_posts($web_driver,$commentsMade);

// $foundid=$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[5]/div[1]/span/div"))->getAttribute("id");
// print($foundid);

$int = (int) filter_var($foundid, FILTER_SANITIZE_NUMBER_INT);
print($int);
$limit=$int;
while () 
{ 
   $web_driver->manage()->timeouts()->implicitlyWait(10);
   for ($i=$int; $i >$int-5 ; $i--) 
   { 
      $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("commentButtonPost".$i)));
      $web_driver->findElement(WebDriverBy::id("commentButtonPost".$i))->click();

      $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath('//*[@id="CommentTextBox'.$i.'"]')));
      //*[@id="CommentTextBox310"]
      //*[@id="CommentTextBox313"]/div[1]/div/div[3]/div/p
      $web_driver->findElement(WebDriverBy::xpath('//*[@id="CommentTextBox'.$i.'"]/div[1]/div/div[3]/div/p'))->sendKeys("comment 2121");
      //*[@id="CommentTextBox310"]/div[1]/div/div[3]/div/p
      $web_driver->findElement(WebDriverBy::xpath('//*[@id="CommentTextBox'.$i.'"]/div[2]/input[1]'))->click();
      $web_driver->manage()->timeouts()->implicitlyWait(10);
   }
   $int=$int-5;
   $web_driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
   $web_driver->manage()->timeouts()->implicitlyWait(10);
}
echo "<br>";
print($int);
// $web_driver->quit();
// /html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]
// /html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[4]
// /html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[6]
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[5]/div[1]/span/div
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[4]/form[1]/div/div[2]/div[2]/div[5]/div[1]/span/div
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[4]/form[2]/div/div[2]/div[2]/div[5]/div[1]/span/div

/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[1]/div/div[2]/div[2]/div[10]
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[2]/div/div[2]/div[2]/div[10]
/html/body/div[5]/div[2]/div[2]/div[5]/div[5]/div[2]/form[2]/div/div[2]/div[2]/div[10]
 ?>