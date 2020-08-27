<?php
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
// $desiredCapabilities->setCapability('acceptSslCerts', true);
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);

$web_driver->get("http://localhost/development_2020/test_place1");
 $web_driver->findElement(WebDriverBy::id("userName"))
            ->sendKeys("mary@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
            ->sendKeys("marytbb") ;
 $web_driver->findElement(WebDriverBy::id("remember"))
            ->click();           
 $web_driver->findElement(WebDriverBy::id("Submit"))
            ->click();
 $web_driver->wait()->until(
   WebDriverExpectedCondition::titleIs("Home > Dashboard")
);  
         //below code for logout 
 // $web_driver->findElement(WebDriverBy::xpath("/html/body/div[4]/div/div/div/div[2]/ul/li[3]/a"))
 //            ->click();

// $password = $web_driver->findElement(WebDriverBy::name("userPassword"));
// if($email) {
//      $email->sendKeys("john@teeme.net");
//      if($password){
//      	$password->sendKeys("johntbb");
//      }
//      //$email->submit();
// }
print $web_driver->getTitle();
//$web_driver->quit();
?>