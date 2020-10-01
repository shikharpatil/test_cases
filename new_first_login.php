<?php
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities,100 * 1000,100 * 1000);

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

//  for ($i=2; $i < 10; $i++) 
//  { 
//  	$web_driver->findElement(WebDriverBy::id("userName"))
//             ->sendKeys("user990".$i."@teeme.net");
//  $web_driver->findElement(WebDriverBy::id("userPassword"))
//             ->sendKeys("user990".$i."") ;
//  $web_driver->findElement(WebDriverBy::id("remember"))
//             ->click();           
//  $web_driver->findElement(WebDriverBy::id("Submit"))
//             ->click();
//             $web_driver->manage()->timeouts()->implicitlyWait(10);
//             // http://dev.teeme.net/terms_and_conditions
//             // http://dev.teeme.net/dashboard/password_reset/0/type/1

//             $web_driver->wait(60,1000)->until(
//    WebDriverExpectedCondition::urlIs("http://dev.teeme.net/terms_and_conditions"));
//             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div[3]/input[1]"))->click();
//             $web_driver->wait(60,1000)->until(
//    WebDriverExpectedCondition::urlIs("http://dev.teeme.net/dashboard/password_reset/0/type/1"));
//             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[3]/div[2]/input"))->sendKeys("user990".$i);
//             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[4]/div[2]/input"))->sendKeys("user990".$i);
//             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[5]/div[2]/input"))->sendKeys("user990".$i);
//             $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[6]/div[2]/input"))->click();

//  $web_driver->wait(60,1000)->until(
//    WebDriverExpectedCondition::titleIs("Home > Dashboard")
// );  
 
//  $web_driver->findElement(WebDriverBy::xpath("/html/body/div[4]/div/div/div/div[2]/ul/li[3]/a/img"))->click();
 
//  $web_driver->wait(60,1000)->until(
//    WebDriverExpectedCondition::urlIs("http://dev.teeme.net/xyz2")
// );
//  $web_driver->manage()->timeouts()->implicitlyWait(10);
//  }

 // after ten
 for ($i=16; $i < 100; $i++) 
 { 

 	$web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("user99".$i."@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("user99".$i."") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
            $web_driver->manage()->timeouts()->implicitlyWait(10);
            // http://dev.teeme.net/terms_and_conditions
            // http://dev.teeme.net/dashboard/password_reset/0/type/1
            $url=$web_driver->getCurrentURL();
    if($url=="http://dev.teeme.net/")
 	{
 		
   $web_driver->findElement(WebDriverBy::id("place_name1"))
            ->sendKeys("xyz2");
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div/div[2]/div/button"))->click();
$web_driver->manage()->timeouts()->implicitlyWait(10);
$web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("user99".$i."@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("user99".$i."") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
            $web_driver->manage()->timeouts()->implicitlyWait(10);
 	}

            $web_driver->wait(60,1000)->until(
   WebDriverExpectedCondition::urlIs("http://dev.teeme.net/terms_and_conditions"));
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div/form/div[3]/input[1]"))->click();
            $web_driver->wait(60,1000)->until(
   WebDriverExpectedCondition::urlIs("http://dev.teeme.net/dashboard/password_reset/0/type/1"));
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[3]/div[2]/input"))->sendKeys("user99".$i);
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[4]/div[2]/input"))->sendKeys("user99".$i);
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[5]/div[2]/input"))->sendKeys("user99".$i);
            $web_driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[2]/form/div/div[6]/div[2]/input"))->click();

 $web_driver->wait(60,1000)->until(
   WebDriverExpectedCondition::titleIs("Home > Dashboard")
);  
 
 $web_driver->findElement(WebDriverBy::xpath("/html/body/div[4]/div/div/div/div[2]/ul/li[3]/a/img"))->click();
 
 $web_driver->wait(60,1000)->until(
   WebDriverExpectedCondition::urlIs("http://dev.teeme.net/xyz2")
);
 $web_driver->manage()->timeouts()->implicitlyWait(10);
 echo "<br>";
 print($i);
 }

 echo "done";
 die();
?>