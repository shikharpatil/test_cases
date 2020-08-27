<?php
namespace Facebook\WebDriver;

require_once('/Applications/XAMPP/htdocs/test_script/vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:4444/wd/hub';
$desiredCapabilities = DesiredCapabilities::chrome();
$web_driver = RemoteWebDriver::create($host, $desiredCapabilities);
// navigate to the url below
$web_driver->get("http://dev.teeme.net/demo");
// navigate to the forgot password
$web_driver->findElement(WebDriverBy::linkText("Forgot password?"))
           ->click();
//check if the control is on the forgot password page 
$web_driver->wait()->until(
   WebDriverExpectedCondition::urlContains("forgot_password")
);
// enter the email to get forgot password link through mail
$web_driver->findElement(WebDriverBy::id("username"))
           ->sendKeys("shikhar.patil@teambeyondborders.com");
// $web_driver->findElement(WebDriverBy::id("userName"))           
$web_driver->findElement(WebDriverBy::id("submit"))  ->click();
print $web_driver->getTitle();
?>           