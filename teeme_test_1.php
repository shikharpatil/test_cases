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

$web_driver->get("http://dev.teeme.net/demo");
 $web_driver->findElement(WebDriverBy::id("userName"))
 ->sendKeys("john@teeme.net");
 $web_driver->findElement(WebDriverBy::id("userPassword"))
 ->sendKeys("johntbb");
 $web_driver->findElement(WebDriverBy::id("Submit"))
 ->click();
// $password = $web_driver->findElement(WebDriverBy::name("userPassword"));
// if($email) {
//      $email->sendKeys("john@teeme.net");
//      if($password){
//      	$password->sendKeys("johntbb");
//      }
//      //$email->submit();
// }
print $web_driver->getTitle();
$web_driver->quit();
?>