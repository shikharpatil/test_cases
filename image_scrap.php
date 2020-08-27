<?php
// script for adding image in posts
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
// $web_driver->get("https://www.bing.com/images/trending?FORM=ILPTRD");
$web_driver->get("https://www.bing.com/images/trending?FORM=ILPTRD");

$element = $web_driver->findElement(WebDriverBy::name("q"));
 if($element)
 {
 	$element->sendKeys("the godfather poster");
    $element->submit();
 }
 $web_driver->wait()->until(
   WebDriverExpectedCondition::titleContains("the godfather poster"));
 
//  $web_driver->findElement(WebDriverBy::id("fltIdtTit"))
//             ->click();
//  $web_driver->findElement(WebDriverBy::className("ftrLi "))
//             ->click();      
// $web_driver->findElement(WebDriverBy::className("ftrP12"))
//             ->click();      
            
            // $web_driver->findElement(WebDriverBy::className("mimg"))
            // ->click(); 
$src=$web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("mimg")))->getAttribute("src");

   // $url=$web_driver->getCurrentURL();

// $curl = curl_init($src);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// $result = curl_exec($curl);
// curl_close($curl);

//    // $html = file_get_contents($url);

// // /*preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?|i',$html, $matches );
// preg_match('!<img class="rg_i Q4LuWd tx8vtf" src=(.*?)!',$result,$matches);
print_r($src);

echo '<img src= '.$src. '/>';

$web_driver->get("http://localhost/development_2020/test_place1");
 $web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("jerry@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("jerrytbb") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
 $web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Home > Dashboard")
);  
 $web_driver->manage()->timeouts()->implicitlyWait(10);

 $currentURL= $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div[2]/ul[1]/li[6]/span/h1/a"))->getAttribute('href');
 $web_driver->get($currentURL);

 $web_driver->findElement(WebDriverBy::id("add"))->click();

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("TimelinePost")));

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("formTimeline")));


// $web_driver->manage()->timeouts()->implicitlyWait(10);

 // $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[3]/div/p")));

 $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[3]/div/p"))->sendKeys("iufwivbilwegfiw8465964862495gfgf8370123");

$web_driver->findElement(WebDriverBy::id("insertImage-1"))
            ->click();

 $web_driver->manage()->timeouts()->implicitlyWait(10);

$web_driver->findElement(WebDriverBy::id("imageByURL-1"))
            ->click();

 

$web_driver->findElement(WebDriverBy::id("fr-image-by-url-layer-text-1"))
            ->sendKeys($src);

$web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/div[2]/div[5]/div[1]/form/div[1]/div[1]/div[8]/div[3]/div[2]/button"))->click();
$web_driver->manage()->timeouts()->implicitlyWait(10);

 $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className("replyCancelButtons")));

 $web_driver->findElement(WebDriverBy::name("Replybutton"))->click();

  $web_driver->manage()->timeouts()->implicitlyWait(10);
  
  $web_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("timelinePostContents")));


// $web_driver->quit();

?>